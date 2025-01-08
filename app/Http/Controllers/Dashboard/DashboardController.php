<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
class DashboardController extends Controller
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

        if (!auth('admin')->check()) {
            return redirect()->route('dashboard.projects');
        }

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
        $patentStartupProjectCount = Project::where('project_classification', 4)->count();

        $mimiLbaleStudentsCount = Project::where('project_classification', 1)
                  ->where('project_tracking', 5)
                  ->where('status_project_tracking', 2)
                  ->count();

        $startupLabelStudentsCount = Project::where('project_classification', 2)
                  ->where('project_tracking', 5)
                  ->where('status_project_tracking', 2)
                  ->count();

        $patentLabelStudentsCount = Project::where('project_classification', 3)
                  ->where('project_tracking', 7)
                  ->where('status_project_tracking', 2)
                  ->count();

        $patentStartupLabelStudentCount = Project::where('project_classification', 4)
                  ->where('project_tracking', 10)
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
                trans('dashboard.Patent Project'),
                trans('dashboard.Patent Startup Project'),
            ],
            'datasets' => [
                [
                    'label' => trans('dashboard.Project Classification'),
                    'data' => [$miniProjectCount, $startupProjectCount, $patentProjectCount,$patentStartupProjectCount],
                    'backgroundColor' => ['#ff6384', '#36a2eb', '#cc65fe', '#FFFF00'],
                    'borderColor' => ['#ff6384', '#36a2eb', '#cc65fe', '#FFFF00'],
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

        $miniProjectStatsByFaculty = Student::join('student_groups', 'students.id', '=', 'student_groups.student_id')
        ->join('projects', 'student_groups.project_id', '=', 'projects.id')
        ->join('faculties', 'students.id_faculty', '=', 'faculties.id')
        ->where('projects.project_classification', 1)
        ->where('projects.bmc_status', 2)
        ->whereNotNull('projects.bmc')
        ->where('projects.project_tracking', 5)
        ->where('projects.status_project_tracking', 2)
        ->where('projects.status', 2)
        ->select('students.id_faculty', 'faculties.name_ar', DB::raw('COUNT(DISTINCT projects.id) as count'))
        ->groupBy('students.id_faculty', 'faculties.name_ar')
        ->pluck('count', 'faculties.name_ar');

        $startupProjectStatsByFaculty = Student::join('student_groups', 'students.id', '=', 'student_groups.student_id')
        ->join('projects', 'student_groups.project_id', '=', 'projects.id')
        ->join('faculties', 'students.id_faculty', '=', 'faculties.id')
        ->where('projects.project_classification', 2)
        ->where('projects.bmc_status', 2)
        ->whereNotNull('projects.bmc')
        ->where('projects.project_tracking', 5)
        ->where('projects.status_project_tracking', 2)
        ->where('projects.status', 2)
        ->select('students.id_faculty', 'faculties.name_ar', DB::raw('COUNT(DISTINCT projects.id) as count'))
        ->groupBy('students.id_faculty', 'faculties.name_ar')
        ->pluck('count', 'faculties.name_ar');


        $patentProjectStatsByFaculty = Student::join('student_groups', 'students.id', '=', 'student_groups.student_id')
        ->join('projects', 'student_groups.project_id', '=', 'projects.id')
        ->join('faculties', 'students.id_faculty', '=', 'faculties.id')
        ->where('projects.project_classification', 3)
        ->where('projects.bmc_status', 0)
        ->whereNotNull('projects.bmc')
        ->where('projects.project_tracking', 7)
        ->where('projects.status_project_tracking', 2)
        ->where('projects.status', 2)
        ->select('students.id_faculty', 'faculties.name_ar', DB::raw('COUNT(DISTINCT projects.id) as count'))
        ->groupBy('students.id_faculty', 'faculties.name_ar')
        ->pluck('count', 'faculties.name_ar');

        $patentStartupProjectStatsByFaculty = Student::join('student_groups', 'students.id', '=', 'student_groups.student_id')
        ->join('projects', 'student_groups.project_id', '=', 'projects.id')
        ->join('faculties', 'students.id_faculty', '=', 'faculties.id')
        ->where('projects.project_classification', 4)
        ->where('projects.bmc_status', 2)
        ->whereNotNull('projects.bmc')
        ->where('projects.project_tracking', 10)
        ->where('projects.status_project_tracking', 2)
        ->where('projects.status', 2)
        ->select('students.id_faculty', 'faculties.name_ar', DB::raw('COUNT(DISTINCT projects.id) as count'))
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

        $patentStartupStages = [
            'training' => [
                'in_training' => Project::where('project_classification', 4)
                    ->where('project_tracking', 1)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'completed_training' => Project::where('project_classification', 4)
                    ->where('project_tracking', 1)
                    ->where('status_project_tracking', 2)
                    ->count(),
                'not_trained' => Project::where('project_classification', 1)
                    ->where('project_tracking', 1)
                    ->where('status_project_tracking', 3)
                    ->count(),
            ],
            'bmc_creation' => [
                'in_progress' => Project::where('project_classification', 4)
                    ->where('project_tracking', 2)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'completed' => Project::where('project_classification', 4)
                    ->where('project_tracking', 2)
                    ->where('status_project_tracking', 2)
                    ->count(),
                'not_completed' => Project::where('project_classification', 4)
                    ->where('project_tracking', 2)
                    ->where('status_project_tracking', 3)
                    ->count(),
            ],
            'prototype_preparation' => [
                'in_progress' => Project::where('project_classification', 4)
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
            'descriptive_model_writing' => [
                'no' => Project::where('project_classification', 4)
                    ->where('project_tracking', 4)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'yes' => Project::where('project_classification', 3)
                    ->where('project_tracking', 4)
                    ->where('status_project_tracking', 2)
                    ->count(),
            ],
            'patent_application' => [
                'applied' => Project::where('project_classification', 4)
                    ->where('project_tracking', 5)
                    ->where('status_project_tracking', 2)
                    ->count(),
            ],
            'patent_registration_certificate' => [
                'not_received' => Project::where('project_classification', 4)
                    ->where('project_tracking', 6)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'received' => Project::where('project_classification', 4)
                    ->where('project_tracking', 6)
                    ->where('status_project_tracking', 2)
                    ->count(),
            ],
            'INAPI_comments' => [
                'not_received' => Project::where('project_classification', 4)
                    ->where('project_tracking', 7)
                    ->where('status_project_tracking', 1)
                    ->count(),
            ],
            'resubmit_amended_model' => [
                'not_resubmitted' => Project::where('project_classification', 4)
                    ->where('project_tracking', 8)
                    ->where('status_project_tracking', 1)
                    ->count(),
            ],
            'discussion' => [
                'not_discussed' => Project::where('project_classification', 4)
                    ->where('project_tracking', 9)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'discussed' => Project::where('project_classification', 1)
                    ->where('project_tracking', 9)
                    ->where('status_project_tracking', 2)
                    ->count(),
            ],
            'patent_grant' => [
                'not_granted' => Project::where('project_classification', 3)
                    ->where('project_tracking', 10)
                    ->where('status_project_tracking', 1)
                    ->count(),
                'granted' => Project::where('project_classification', 3)
                    ->where('project_tracking', 10)
                    ->where('status_project_tracking', 2)
                    ->count(),
            ],
        ];


        return view('content.dashboard.dashboards-analytics',
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
                'mimiLbaleStudentsCount',
                'startupLabelStudentsCount',
                'patentLabelStudentsCount',
                'patentStartupLabelStudentCount',
                'miniProjectsInTraining',
                'miniProjectsUnderTraining',
                'miniProjectsCompleted',
                'miniProjectStages',
                'startupProjectStages',
                'patentStages',
                'patentStartupStages',
                'miniProjectStatsByFaculty',
                'startupProjectStatsByFaculty',
                'patentProjectStatsByFaculty',
                'patentStartupProjectStatsByFaculty',
            )
        );
    }

    /*
        public function index() {
             $evaluationsGold = Evaluation::whereGoldenPassport(1)->count();
            $studentFirst  = Evaluation::whereRank(1)->count();
            $studentSecond = Evaluation::whereRank(2)->count();
            $studentThird  = Evaluation::whereRank(3)->count();
            $studentGroups = StudentGroup::all()->count();
            $projects      = Project::all()->count();
            $allStudents = $studentGroups + $students->count();
            $acceptedProject = Project::where('status',2)->count();

            foreach ($students as $student) {
                $years[] = $student->created_at;
            }
            $uniqueYears = array_unique(array_map(function ($date) {
            return $date->year;
            }, $years));
            arsort($uniqueYears);

            return view('content.dashboard.dashboards-analytics',
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
                            )
                    );
        }
    */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function analyseGetStudentByYear(Request $request)
    {
      $yearNow = Carbon::now()->year;
      if ($request->has('year')){
          $students = Student::select('created_at')->whereYear('created_at', $request->year)->get();
          foreach ($students as $student) {
            $studentJan = $student->whereMonth('created_at', '1')->count();
            $studentFev = $student->whereMonth('created_at', '2')->count();
            $studentMar = $student->whereMonth('created_at', '3')->count();
            $studentApr = $student->whereMonth('created_at', '4')->count();
            $studentMai = $student->whereMonth('created_at', '5')->count();
            $studentJun = $student->whereMonth('created_at', '6')->count();
            $studentJui = $student->whereMonth('created_at', '7')->count();
            $studentAot = $student->whereMonth('created_at', '8')->count();
            $studentSep = $student->whereMonth('created_at', '9')->count();
            $studentOct = $student->whereMonth('created_at', '10')->count();
            $studentNov = $student->whereMonth('created_at', '11')->count();
            $studentDec = $student->whereMonth('created_at', '12')->count();
          }
          return response()->json([
            'success' => true,
            'student' => $students,
            'studentJan' => $studentJan,
            'studentFev' => $studentFev,
            'studentMar' => $studentMar,
            'studentApr' => $studentApr,
            'studentMai' => $studentMai,
            'studentJun' => $studentJun,
            'studentJui' => $studentJui,
            'studentAot' => $studentAot,
            'studentSep' => $studentSep,
            'studentOct' => $studentOct,
            'studentNov' => $studentNov,
            'studentDec' => $studentDec,
          ]);

      }
      else {
          $students = Student::select('created_at')->whereYear('created_at', $yearNow)->get();
          foreach ($students as $student) {
            $studentJan = $student->whereMonth('created_at', '1')->count();
            $studentFev = $student->whereMonth('created_at', '2')->count();
            $studentMar = $student->whereMonth('created_at', '3')->count();
            $studentApr = $student->whereMonth('created_at', '4')->count();
            $studentMai = $student->whereMonth('created_at', '5')->count();
            $studentJun = $student->whereMonth('created_at', '6')->count();
            $studentJui = $student->whereMonth('created_at', '7')->count();
            $studentAot = $student->whereMonth('created_at', '8')->count();
            $studentSep = $student->whereMonth('created_at', '9')->count();
            $studentOct = $student->whereMonth('created_at', '10')->count();
            $studentNov = $student->whereMonth('created_at', '11')->count();
            $studentDec = $student->whereMonth('created_at', '12')->count();

          }
          return response()->json([
            'success' => true,
            'student' => $students,
            'studentJan' => $studentJan,
            'studentFev' => $studentFev,
            'studentMar' => $studentMar,
            'studentApr' => $studentApr,
            'studentMai' => $studentMai,
            'studentJun' => $studentJun,
            'studentJui' => $studentJui,
            'studentAot' => $studentAot,
            'studentSep' => $studentSep,
            'studentOct' => $studentOct,
            'studentNov' => $studentNov,
            'studentDec' => $studentDec,
          ]);
      }

    }

    public function analyseGetStudentByGender(Request $request)
    {

        if ($request->has('year')) {
            $year = $request->year;
        } else {
            $year = Carbon::now()->year;
        }

        $men   = Student::whereGender(1)->whereYear('created_at', $year)->count();
        $women = Student::whereGender(0)->whereYear('created_at', $year)->count();

        return response()->json([
            'success' => true,
            'men'    => $men,
            'women' => $women,
        ]);
    }

    public function analyseGetStudentByPoint()
    {
        $max   = Student::where('moyenFinal','>=',15)->count();
        $moyen = Student::whereBetween('moyenFinal',[10, 15])->count();
        $min   = Student::where('moyenFinal','<' ,10)->count();

        return response()->json([
            'status' => true,
            'max'   => $max,
            'moyen' => $moyen,
            'min'   => $min,
        ]);
    }
}
