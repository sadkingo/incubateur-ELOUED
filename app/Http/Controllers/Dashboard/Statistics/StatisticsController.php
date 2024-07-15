<?php

namespace App\Http\Controllers\Dashboard\Statistics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Project;
use App\Models\Student;
use App\Models\StudentGroup;
use App\Models\Test;
use App\Models\Faculty;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Student\StudentRepository;
use App\Repositories\Subject\SubjectRepository;
use App\Repositories\Teacher\TeacherRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    private $admins;
    private $teachers;
    private $students;
    private $subjects;

    /**
     * DashboardController constructor.
     * @param AdminRepository $admins
     * @param TeacherRepository $teachers
     * @param StudentRepository $students
     * @param SubjectRepository $subjects
     */
    public function __construct(AdminRepository $admins,TeacherRepository $teachers,StudentRepository $students , SubjectRepository $subjects)
    {
        $this->admins = $admins;
        $this->teachers = $teachers;
        $this->students = $students;
        $this->subjects = $subjects;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
       
        $today = now();
        $selectedYear = $request->input('year', $today->year);      
        $years = [];
        $admins = $this->admins->all();
        $teachers = $this->teachers->all();
        $students = $this->students->all();
        $subjects = $this->subjects->all();
        $reviews = Test::all()->count();
        $evaluationsGold = Evaluation::whereGoldenPassport(1)->count();
        $studentFirst = Evaluation::whereRank(1)->count();
        $studentSecond = Evaluation::whereRank(2)->count();
        $studentThird = Evaluation::whereRank(3)->count();
        $studentGroups = StudentGroup::all()->count();
    
        $projects = Project::all()->count();
        $acceptedProject = Project::where('status', 2)->count();
        $RejectedProjects = Project::where('status', 0)->count();
        $projectsUnderStudy = Project::where('status', 1)->count();
        $compledProject = Project::where('status', 3)->count();
        $newProjects = Project::where('new', 1)->count();
    
        $allStudents = $studentGroups + $students->count();
    
        $projectsByYear = Project::select(DB::raw('YEAR(academic_year) as year'), DB::raw('COUNT(*) as count'))
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->pluck('count', 'year');
        $projectsByYearData = $projectsByYear->toArray();
    
        $projectsBySelectedYear = Project::whereYear('academic_year', $selectedYear)
            ->select(DB::raw('COUNT(*) as count'))
            ->pluck('count')
            ->first();
        
        $miniProjectCount = Project::where('project_classification', 1)->count();
        $startupProjectCount = Project::where('project_classification', 2)->count();
        $patentProjectCount = Project::where('project_classification', 3)->count();
    
        $startupLabelStudentsCount = Project::where('project_classification', 2)
                  ->where('project_tracking', 5)
                  ->where('status_project_tracking', 2)
                  ->count();
    
        $patentLabelStudentsCount = Project::where('project_classification', 3)
                  ->where('project_tracking', 7)
                  ->where('status_project_tracking', 2)
                  ->count();
        $uniqueYears = array_unique(array_map(function ($date) {
            return $date->year;
        }, $years));
        arsort($uniqueYears);
        $chartData = [
            'labels' => ['Admins', 'Teachers', 'Students', 'Student Groups', 'All Students', 'Projects', 'Schools'],
            'datasets' => [
                [
                    'label' => trans('dashboard.general_statistics'),
                    'data' => [$admins->count(), $teachers->count(), $students->count(), $studentGroups, $allStudents, $projects, 0],
                    'backgroundColor' => ['#4caf50', '#2196f3', '#ff9800', '#e91e63', '#9c27b0', '#3f51b5', '#00bcd4'],
                    'borderColor' => ['#388e3c', '#1976d2', '#f57c00', '#c2185b', '#7b1fa2', '#303f9f', '#0097a7'],
                    'borderWidth' => 1
                ]
            ]
        ];
    
        $chartGenderData = [
            'labels' => ['Male Students', 'Female Students'],
            'datasets' => [
                [
                    'label' => trans('dashboard.gender_distribution'),
                    'data' => [
                        Student::where('gender', 'male')->count(),
                        Student::where('gender', 'female')->count()
                    ],
                    'backgroundColor' => ['#ff6384', '#36a2eb'],
                    'borderColor' => ['#ff6384', '#36a2eb'],
                    'borderWidth' => 1
                ]
            ]
        ];
    
        $projectsByYearData = $projectsByYear->toArray();
    
        $chartProjectsByYearData = [
            'labels' => array_keys($projectsByYearData),
            'datasets' => [
                [
                    'label' => trans('dashboard.Projects by Year'),
                    'data' => array_values($projectsByYearData),
                    'backgroundColor' => '#007bff',
                    'borderColor' => '#0056b3',
                    'borderWidth' => 1
                ]
            ]
        ];
    
        $chartProjectClassificationData = [
            'labels' => [
                trans('dashboard.Mini Project'),
                trans('dashboard.Startup Project'),
                trans('dashboard.Patent Project')
            ],
            'datasets' => [
                [
                    'label' => trans('dashboard.Project Classification'),
                    'data' => [$miniProjectCount, $startupProjectCount, $patentProjectCount],
                    'backgroundColor' => ['#ff6384', '#36a2eb', '#cc65fe'],
                    'borderColor' => ['#ff6384', '#36a2eb', '#cc65fe'],
                    'borderWidth' => 1
                ]
            ],
            'options' => [
                'plugins' => [
                    'tooltip' => [
                        'callbacks' => [
                            'label' => function($context) {
                                $label = $context->label;
                                $value = $context->raw;
                                return "$label: $value " . trans('dashboard.Projects');
                            }
                        ]
                    ]
                ],
                'scales' => [
                    'x' => [
                        'stacked' => true,
                    ],
                    'y' => [
                        'stacked' => true,
                    ]
                ]
            ]
        ];

        $miniProjectsInTraining = Project::where('project_classification', 1)
            ->where('project_tracking', 1)
            ->where('status_project_tracking', 1)
            ->count();

        $miniProjectsUnderTraining = Project::where('project_classification', 1)
            ->where('project_tracking', 1)
            ->where('status_project_tracking', 2)
            ->count();

        $miniProjectsCompleted = Project::where('project_classification', 1)
            ->where('project_tracking', 1)
            ->where('status_project_tracking', 3)
            ->count();

        $miniProjectStatsByFaculty = Student::join('projects', 'students.id', '=', 'projects.id_student')
            ->join('faculties', 'students.id_faculty', '=', 'faculties.id') 
            ->where('projects.project_classification', 1)
            ->where('projects.bmc_status', 2)
            ->whereNotNull('projects.bmc')
            ->whereNotNull('projects.administrative_file')
            ->where('projects.project_tracking', 5)
            ->where('projects.status_project_tracking', 2)
            ->where('projects.status', 2)
            ->select('students.id_faculty', 'faculties.name_ar', DB::raw('COUNT(*) as count'))
            ->groupBy('students.id_faculty', 'faculties.name_ar')
            ->pluck('count', 'faculties.name_ar');
   
        $startupProjectStatsByFaculty = Student::join('projects', 'students.id', '=', 'projects.id_student')
            ->join('faculties', 'students.id_faculty', '=', 'faculties.id') 
            ->where('projects.project_classification', 2)
            ->where('projects.bmc_status', 2)
            ->whereNotNull('projects.bmc')
            ->whereNotNull('projects.administrative_file')
            ->where('projects.project_tracking', 5)
            ->where('projects.status_project_tracking', 2)
            ->where('projects.status', 2)
            ->select('students.id_faculty', 'faculties.name_ar', DB::raw('COUNT(*) as count'))
            ->groupBy('students.id_faculty', 'faculties.name_ar')
            ->pluck('count', 'faculties.name_ar');
    
        $patentProjectStatsByFaculty = Student::join('projects', 'students.id', '=', 'projects.id_student')
            ->join('faculties', 'students.id_faculty', '=', 'faculties.id') 
            ->where('projects.project_classification', 3)
            ->where('projects.bmc_status', 0)
            ->whereNull('projects.bmc')
            ->whereNull('projects.administrative_file')
            ->where('projects.project_tracking', 7)
            ->where('projects.status_project_tracking', 2)
            ->where('projects.status', 2)
            ->select('students.id_faculty', 'faculties.name_ar', DB::raw('COUNT(*) as count'))
            ->groupBy('students.id_faculty', 'faculties.name_ar')
            ->pluck('count', 'faculties.name_ar');


            
        $miniProjectStages = [
                'training' => [
                    'in_training' => Project::where('project_classification', 1)
                        ->where('project_tracking', 1)
                        ->where('status_project_tracking', 1)
                        ->count(),
                    'completed_training' => Project::where('project_classification', 1)
                        ->where('project_tracking', 1)
                        ->where('status_project_tracking', 2)
                        ->count(),
                    'not_trained' => Project::where('project_classification', 1)
                        ->where('project_tracking', 1)
                        ->where('status_project_tracking', 3)
                        ->count(),
                ],
                'bmc_creation' => [
                    'in_progress' => Project::where('project_classification', 1)
                        ->where('project_tracking', 2)
                        ->where('status_project_tracking', 1)
                        ->count(),
                    'completed' => Project::where('project_classification', 1)
                        ->where('project_tracking', 2)
                        ->where('status_project_tracking', 2)
                        ->count(),
                    'not_completed' => Project::where('project_classification', 1)
                        ->where('project_tracking', 2)
                        ->where('status_project_tracking', 3)
                        ->count(),
                ],
                'prototype_preparation' => [
                    'in_progress' => Project::where('project_classification', 1)
                        ->where('project_tracking', 3)
                        ->where('status_project_tracking', 1)
                        ->count(),
                    'completed' => Project::where('project_classification', 1)
                        ->where('project_tracking', 3)
                        ->where('status_project_tracking', 2)
                        ->count(),
                    'not_completed' => Project::where('project_classification', 1)
                        ->where('project_tracking', 3)
                        ->where('status_project_tracking', 3)
                        ->count(),
                ],
                'discussion' => [
                    'not_discussed' => Project::where('project_classification', 1)
                        ->where('project_tracking', 4)
                        ->where('status_project_tracking', 1)
                        ->count(),
                    'discussed' => Project::where('project_classification', 1)
                        ->where('project_tracking', 4)
                        ->where('status_project_tracking', 2)
                        ->count(),
                ],
                'innovative_project_label' => [
                    'completed' => Project::where('project_classification', 1)
                        ->where('project_tracking', 5)
                        ->where('status_project_tracking', 2)
                        ->count(),
                    'not_completed' => Project::where('project_classification', 1)
                        ->where('project_tracking', 5)
                        ->where('status_project_tracking', 3)
                        ->count(),
                ],
                'final_discussion' => [
                    'not_received' => Project::where('project_classification', 1)
                        ->where('project_tracking', 6)
                        ->where('status_project_tracking', 1)
                        ->count(),
                    'received' => Project::where('project_classification', 1)
                        ->where('project_tracking', 6)
                        ->where('status_project_tracking', 2)
                        ->count(),
                    'withdrawn' => Project::where('project_classification', 1)
                        ->where('project_tracking', 6)
                        ->where('status_project_tracking', 3)
                        ->count(),
                ],
        ];
    
        $startupProjectStages = [
                'training' => [
                    'in_training' => Project::where('project_classification', 2)
                        ->where('project_tracking', 1)
                        ->where('status_project_tracking', 1)
                        ->count(),
                    'completed_training' => Project::where('project_classification', 2)
                        ->where('project_tracking', 1)
                        ->where('status_project_tracking', 2)
                        ->count(),
                    'not_trained' => Project::where('project_classification', 2)
                        ->where('project_tracking', 1)
                        ->where('status_project_tracking', 3)
                        ->count(),
                ],
                'bmc_creation' => [
                    'in_progress' => Project::where('project_classification', 2)
                        ->where('project_tracking', 2)
                        ->where('status_project_tracking', 1)
                        ->count(),
                    'completed' => Project::where('project_classification', 2)
                        ->where('project_tracking', 2)
                        ->where('status_project_tracking', 2)
                        ->count(),
                    'not_completed' => Project::where('project_classification', 2)
                        ->where('project_tracking', 2)
                        ->where('status_project_tracking', 3)
                        ->count(),
                ],
                'prototype_preparation' => [
                    'in_progress' => Project::where('project_classification', 2)
                        ->where('project_tracking', 3)
                        ->where('status_project_tracking', 1)
                        ->count(),
                'completed' => Project::where('project_classification', 2)
                        ->where('project_tracking', 3)
                        ->where('status_project_tracking', 2)
                        ->count(),
                'not_completed' => Project::where('project_classification', 2)
                        ->where('project_tracking', 3)
                        ->where('status_project_tracking', 3)
                        ->count(),
                ],
            'discussion' => [
                'not_discussed' => Project::where('project_classification', 2)
                    ->where('project_tracking', 4)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'discussed' => Project::where('project_classification', 2)
                    ->where('project_tracking', 4)
                    ->where('status_project_tracking', 2)
                    ->count(),
                ],
            'startup_project_label' => [
                'completed' => Project::where('project_classification', 2)
                    ->where('project_tracking', 5)
                    ->where('status_project_tracking', 2)
                    ->count(),
                'not_completed' => Project::where('project_classification', 2)
                    ->where('project_tracking', 5)
                    ->where('status_project_tracking', 3)
                    ->count(),
                ],
            'final_discussion' => [
                'not_received' => Project::where('project_classification', 2)
                    ->where('project_tracking', 6)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'received' => Project::where('project_classification', 2)
                    ->where('project_tracking', 6)
                    ->where('status_project_tracking', 2)
                    ->count(),
                'withdrawn' => Project::where('project_classification', 2)
                    ->where('project_tracking', 6)
                    ->where('status_project_tracking', 3)
                    ->count(),
            ],
        ];
    
        $patentStages = [
            'initial_model_preparation' => [
                'in_progress' => Project::where('project_classification', 3)
                    ->where('project_tracking', 1)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'completed' => Project::where('project_classification', 3)
                    ->where('project_tracking', 1)
                    ->where('status_project_tracking', 2)
                    ->count(),
                'not_completed' => Project::where('project_classification', 3)
                    ->where('project_tracking', 1)
                    ->where('status_project_tracking', 3)
                    ->count(),
            ],
            'descriptive_model_writing' => [
                'no' => Project::where('project_classification', 3)
                    ->where('project_tracking', 2)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'yes' => Project::where('project_classification', 3)
                    ->where('project_tracking', 2)
                    ->where('status_project_tracking', 2)
                    ->count(),
            ],
            'patent_application' => [
                'applied' => Project::where('project_classification', 3)
                    ->where('project_tracking', 3)
                    ->where('status_project_tracking', 0)
                    ->count(),
            ],
            'patent_registration_certificate' => [
                'not_received' => Project::where('project_classification', 3)
                    ->where('project_tracking', 4)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'received' => Project::where('project_classification', 3)
                    ->where('project_tracking', 4)
                    ->where('status_project_tracking', 2)
                    ->count(),
            ],
            'INAPI_comments' => [
                'not_received' => Project::where('project_classification', 3)
                    ->where('project_tracking', 5)
                    ->where('status_project_tracking', 0)
                    ->count(),
            ],
            'resubmit_amended_model' => [
                'not_resubmitted' => Project::where('project_classification', 3)
                    ->where('project_tracking', 6)
                    ->where('status_project_tracking', 0)
                    ->count(),
            ],
            'patent_grant' => [
                'not_granted' => Project::where('project_classification', 3)
                    ->where('project_tracking', 7)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'granted' => Project::where('project_classification', 3)
                    ->where('project_tracking', 7)
                    ->where('status_project_tracking', 2)
                    ->count(),
            ],
        ];

        return view('dashboard.statistics.index',
            compact(
                'acceptedProject',
                'uniqueYears',
                'admins',
                'teachers',
                'students',
                'subjects',
                'reviews',
                'evaluationsGold',
                'studentFirst',
                'studentSecond',
                'studentThird',
                'studentGroups',
                'allStudents',
                'projects',
                'chartData',
                'chartGenderData',
                'chartProjectsByYearData', 
                'newProjects',
                'RejectedProjects',
                'projectsUnderStudy',
                'compledProject',
                'projectsBySelectedYear', 
                'selectedYear',
                'chartProjectClassificationData',  
                'startupLabelStudentsCount',       
                'patentLabelStudentsCount',
                'miniProjectsInTraining',
                'miniProjectsUnderTraining',
                'miniProjectsCompleted',
                'miniProjectStages',
                'startupProjectStages',
                'patentStages',
                'miniProjectStatsByFaculty',
                'startupProjectStatsByFaculty',
                'patentProjectStatsByFaculty', 
            )
        );
    }



    public function printMembre(){
        $admins = $this->admins->all();
        $teachers = $this->teachers->all();
        $students = $this->students->all();
        $studentGroups = StudentGroup::all()->count();
        $projects = Project::all()->count();
        $allStudents = $studentGroups + $students->count();
        
        $acceptedProject = Project::where('status', 2)->count();
        $RejectedProjects = Project::where('status', 0)->count();
        $projectsUnderStudy = Project::where('status', 1)->count();
        $compledProject = Project::where('status', 3)->count();
        $newProjects = Project::where('new', 1)->count();

        return view('dashboard.statistics.print_statistic_membres', 
                        compact(
                                'admins',
                                'teachers',
                                'students',
                                'studentGroups',
                                'projects',
                                'allStudents',
                                'acceptedProject',
                                'RejectedProjects',
                                'projectsUnderStudy',
                                'compledProject',
                                'newProjects'
                            ));
    }

    public function printProjectStatistic(Request $request){
        $today = now();
        $selectedYear = $request->input('year', $today->year);    
        $projects = Project::all()->count();        
        $acceptedProject = Project::where('status', 2)->count();
        $RejectedProjects = Project::where('status', 0)->count();
        $projectsUnderStudy = Project::where('status', 1)->count();
        $compledProject = Project::where('status', 3)->count();
        $newProjects = Project::where('new', 1)->count();
        $projectsBySelectedYear = Project::whereYear('academic_year', $selectedYear)
            ->select(DB::raw('COUNT(*) as count'))
            ->pluck('count')
            ->first();
        return view('dashboard.statistics.print_statistice_project', 
                        compact(
                            'projects',
                            'acceptedProject',
                            'RejectedProjects',
                            'projectsUnderStudy',
                            'compledProject',
                            'newProjects',
                            'projectsBySelectedYear'
                        ));
    }


    public function printMiniProject(){
        $miniProjectStatsByFaculty = Student::join('projects', 'students.id', '=', 'projects.id_student')
        ->join('faculties', 'students.id_faculty', '=', 'faculties.id') 
        ->where('projects.project_classification', 1)
        ->where('projects.bmc_status', 2)
        ->whereNotNull('projects.bmc')
        ->whereNotNull('projects.administrative_file')
        ->where('projects.project_tracking', 5)
        ->where('projects.status_project_tracking', 2)
        ->where('projects.status', 2)
        ->select('students.id_faculty', 'faculties.name_ar', DB::raw('COUNT(*) as count'))
        ->groupBy('students.id_faculty', 'faculties.name_ar')
        ->pluck('count', 'faculties.name_ar');

        return view('dashboard.statistics.print_statistic_mini_project', compact('miniProjectStatsByFaculty'));

    }

    public function printStartupProject(){

        $startupProjectStatsByFaculty = Student::join('projects', 'students.id', '=', 'projects.id_student')
            ->join('faculties', 'students.id_faculty', '=', 'faculties.id') 
            ->where('projects.project_classification', 2)
            ->where('projects.bmc_status', 2)
            ->whereNotNull('projects.bmc')
            ->whereNotNull('projects.administrative_file')
            ->where('projects.project_tracking', 5)
            ->where('projects.status_project_tracking', 2)
            ->where('projects.status', 2)
            ->select('students.id_faculty', 'faculties.name_ar', DB::raw('COUNT(*) as count'))
            ->groupBy('students.id_faculty', 'faculties.name_ar')
            ->pluck('count', 'faculties.name_ar');

        return view('dashboard.statistics.print_statistic_startup_project', compact('startupProjectStatsByFaculty'));
    }


    public function printPatentProject(){

        $patentProjectStatsByFaculty = Student::join('projects', 'students.id', '=', 'projects.id_student')
            ->join('faculties', 'students.id_faculty', '=', 'faculties.id') 
            ->where('projects.project_classification', 3)
            ->where('projects.bmc_status', 0)
            ->whereNull('projects.bmc')
            ->whereNull('projects.administrative_file')
            ->where('projects.project_tracking', 7)
            ->where('projects.status_project_tracking', 2)
            ->where('projects.status', 2)
            ->select('students.id_faculty', 'faculties.name_ar', DB::raw('COUNT(*) as count'))
            ->groupBy('students.id_faculty', 'faculties.name_ar')
            ->pluck('count', 'faculties.name_ar');

        return view('dashboard.statistics.print_statistic_patent_project', compact('patentProjectStatsByFaculty'));
    }

    public function printStatisticProject(){

        $startupLabelStudentsCount = Project::where('project_classification', 2)
            ->where('project_tracking', 5)
            ->where('status_project_tracking', 2)
            ->count();

        $patentLabelStudentsCount = Project::where('project_classification', 3)
            ->where('project_tracking', 7)
            ->where('status_project_tracking', 2)
            ->count();

        return view('dashboard.statistics.print_statistic_project_classification',compact('startupLabelStudentsCount','patentLabelStudentsCount'));
    }

    public function printMiniProjectStages(){

        $miniProjectStages = [
            'training' => [
                'in_training' => Project::where('project_classification', 1)
                    ->where('project_tracking', 1)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'completed_training' => Project::where('project_classification', 1)
                    ->where('project_tracking', 1)
                    ->where('status_project_tracking', 2)
                    ->count(),
                'not_trained' => Project::where('project_classification', 1)
                    ->where('project_tracking', 1)
                    ->where('status_project_tracking', 3)
                    ->count(),
            ],
            'bmc_creation' => [
                'in_progress' => Project::where('project_classification', 1)
                    ->where('project_tracking', 2)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'completed' => Project::where('project_classification', 1)
                    ->where('project_tracking', 2)
                    ->where('status_project_tracking', 2)
                    ->count(),
                'not_completed' => Project::where('project_classification', 1)
                    ->where('project_tracking', 2)
                    ->where('status_project_tracking', 3)
                    ->count(),
            ],
            'prototype_preparation' => [
                'in_progress' => Project::where('project_classification', 1)
                    ->where('project_tracking', 3)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'completed' => Project::where('project_classification', 1)
                    ->where('project_tracking', 3)
                    ->where('status_project_tracking', 2)
                    ->count(),
                'not_completed' => Project::where('project_classification', 1)
                    ->where('project_tracking', 3)
                    ->where('status_project_tracking', 3)
                    ->count(),
            ],
            'discussion' => [
                'not_discussed' => Project::where('project_classification', 1)
                    ->where('project_tracking', 4)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'discussed' => Project::where('project_classification', 1)
                    ->where('project_tracking', 4)
                    ->where('status_project_tracking', 2)
                    ->count(),
            ],
            'innovative_project_label' => [
                'completed' => Project::where('project_classification', 1)
                    ->where('project_tracking', 5)
                    ->where('status_project_tracking', 2)
                    ->count(),
                'not_completed' => Project::where('project_classification', 1)
                    ->where('project_tracking', 5)
                    ->where('status_project_tracking', 3)
                    ->count(),
            ],
            'final_discussion' => [
                'not_received' => Project::where('project_classification', 1)
                    ->where('project_tracking', 6)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'received' => Project::where('project_classification', 1)
                    ->where('project_tracking', 6)
                    ->where('status_project_tracking', 2)
                    ->count(),
                'withdrawn' => Project::where('project_classification', 1)
                    ->where('project_tracking', 6)
                    ->where('status_project_tracking', 3)
                    ->count(),
            ],
        ];

        return view('dashboard.statistics.print_statistic_mini_project_stage', compact('miniProjectStages'));
    }

    public function printStartupProjectStages(){
        $startupProjectStages = [
            'training' => [
                'in_training' => Project::where('project_classification', 2)
                    ->where('project_tracking', 1)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'completed_training' => Project::where('project_classification', 2)
                    ->where('project_tracking', 1)
                    ->where('status_project_tracking', 2)
                    ->count(),
                'not_trained' => Project::where('project_classification', 2)
                    ->where('project_tracking', 1)
                    ->where('status_project_tracking', 3)
                    ->count(),
            ],
            'bmc_creation' => [
                'in_progress' => Project::where('project_classification', 2)
                    ->where('project_tracking', 2)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'completed' => Project::where('project_classification', 2)
                    ->where('project_tracking', 2)
                    ->where('status_project_tracking', 2)
                    ->count(),
                'not_completed' => Project::where('project_classification', 2)
                    ->where('project_tracking', 2)
                    ->where('status_project_tracking', 3)
                    ->count(),
            ],
            'prototype_preparation' => [
                'in_progress' => Project::where('project_classification', 2)
                    ->where('project_tracking', 3)
                    ->where('status_project_tracking', 1)
                    ->count(),
            'completed' => Project::where('project_classification', 2)
                    ->where('project_tracking', 3)
                    ->where('status_project_tracking', 2)
                    ->count(),
            'not_completed' => Project::where('project_classification', 2)
                    ->where('project_tracking', 3)
                    ->where('status_project_tracking', 3)
                    ->count(),
            ],
        'discussion' => [
            'not_discussed' => Project::where('project_classification', 2)
                ->where('project_tracking', 4)
                ->where('status_project_tracking', 1)
                ->count(),
            'discussed' => Project::where('project_classification', 2)
                ->where('project_tracking', 4)
                ->where('status_project_tracking', 2)
                ->count(),
            ],
        'startup_project_label' => [
            'completed' => Project::where('project_classification', 2)
                ->where('project_tracking', 5)
                ->where('status_project_tracking', 2)
                ->count(),
            'not_completed' => Project::where('project_classification', 2)
                ->where('project_tracking', 5)
                ->where('status_project_tracking', 3)
                ->count(),
            ],
        'final_discussion' => [
            'not_received' => Project::where('project_classification', 2)
                ->where('project_tracking', 6)
                ->where('status_project_tracking', 1)
                ->count(),
            'received' => Project::where('project_classification', 2)
                ->where('project_tracking', 6)
                ->where('status_project_tracking', 2)
                ->count(),
            'withdrawn' => Project::where('project_classification', 2)
                ->where('project_tracking', 6)
                ->where('status_project_tracking', 3)
                ->count(),
            ],
        ];
        return view('dashboard.statistics.print_statistic_startup_project_stage' ,compact('startupProjectStages'));
    }

    public function printPatentProjectStages(){
        $patentStages = [
            'initial_model_preparation' => [
                'in_progress' => Project::where('project_classification', 3)
                    ->where('project_tracking', 1)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'completed' => Project::where('project_classification', 3)
                    ->where('project_tracking', 1)
                    ->where('status_project_tracking', 2)
                    ->count(),
                'not_completed' => Project::where('project_classification', 3)
                    ->where('project_tracking', 1)
                    ->where('status_project_tracking', 3)
                    ->count(),
            ],
            'descriptive_model_writing' => [
                'no' => Project::where('project_classification', 3)
                    ->where('project_tracking', 2)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'yes' => Project::where('project_classification', 3)
                    ->where('project_tracking', 2)
                    ->where('status_project_tracking', 2)
                    ->count(),
            ],
            'patent_application' => [
                'applied' => Project::where('project_classification', 3)
                    ->where('project_tracking', 3)
                    ->where('status_project_tracking', 0)
                    ->count(),
            ],
            'patent_registration_certificate' => [
                'not_received' => Project::where('project_classification', 3)
                    ->where('project_tracking', 4)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'received' => Project::where('project_classification', 3)
                    ->where('project_tracking', 4)
                    ->where('status_project_tracking', 2)
                    ->count(),
            ],
            'INAPI_comments' => [
                'not_received' => Project::where('project_classification', 3)
                    ->where('project_tracking', 5)
                    ->where('status_project_tracking', 0)
                    ->count(),
            ],
            'resubmit_amended_model' => [
                'not_resubmitted' => Project::where('project_classification', 3)
                    ->where('project_tracking', 6)
                    ->where('status_project_tracking', 0)
                    ->count(),
            ],
            'patent_grant' => [
                'not_granted' => Project::where('project_classification', 3)
                    ->where('project_tracking', 7)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'granted' => Project::where('project_classification', 3)
                    ->where('project_tracking', 7)
                    ->where('status_project_tracking', 2)
                    ->count(),
            ],
        ];
        return view('dashboard.statistics.print_statistic_patent_project_stage', compact('patentStages'));
    }
}
