<?php

namespace App\Http\Controllers\Dashboard\Print;

use Carbon\Carbon;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Project;
use App\Models\SupervisingTeacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\StudentGroup;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Storage;

use App\Repositories\Student\StudentRepository;

class PrintController extends Controller
{
    private $students;

    /**
     * StudentController constructor.
     * @param StudentRepository $students
     */
    public function __construct(StudentRepository $students)
    {
        $this->students = $students;
    }

    public function attendence(Request $request)
    {
        // dd($request->all());
        $now = Carbon::parse(now());
        $year  = $now->year;
        $month = $request->month == null ? $now->month  : $request->month;
        $week  = $request->week;
        $registration_number = $request->registration_number;
        $search = $request->search;
        $batch  = $request->batch;
        $rank   = $request->rank;
        $passport = $request->passport;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        // $month = 3;
        $group = $request->group == null ? null : $request->group;
        // dd($group);
        $students = $this->students->paginate($request->perPage ? $request->perPage : PAGINATE_COUNT, $year,$request->start_date,$request->end_date, $request->search, $request->registration_number,$request->batch, $request->group,$request->rank,$request->passport);
        return view('dashboard.printer.attendence', compact('students', 'group', 'year', 'month'));

        // dd($students);
        // $students = Student::with('attendences')->orWhere('group' ,$group)->get();
        // dd($group);
        // if ($group != null) {
        //     $students = Student::with('attendences')
        //         ->where('group', $group)
        //         ->get();
        // } else {
        //     $students = Student::with('attendences')->get();
        // }

    }


    public function trainee_notebook($student_id)
    {
    }

    public function students(Request $request)
    {
        $group = $request->group;
        $batch = $request->batch;

        $students = $this->students->paginate($request->perPage ? $request->perPage : PAGINATE_COUNT, $request->year,$request->start_date,$request->end_date, $request->search, $request->registration_number,$request->batch, $request->group,$request->rank,$request->passport);

        // $students = $this->students->listPrintStudent($request->search, $request->registration_number, $batch, $group);

        return view('dashboard.printer.students', compact('students', 'group', 'batch'));
    }

    public function teachers()
    {
        $teachers = Teacher::get();
        return view('dashboard.printer.teachers', compact('teachers'));
    }

    public function raport(){
        $acceptedProjectsCount = Project::where('status', 2)->count();
        $rejectedProjectsCount = Project::where('status', 0)->count();
        $underStudyingProjectsCount = Project::where('status',1)->count();
        $completeProjectsCount = Project::where('status',3)->count();
        $totalProjectsCount = Project::count();
       // $progressPercentage = ($totalProjectsCount > 0) ? (($acceptedProjectsCount / $totalProjectsCount) * 100) : 0;

        return view('dashboard.student.reports', [
            'acceptedProjectsCount'      => $acceptedProjectsCount,
            'rejectedProjectsCount'      => $rejectedProjectsCount,
            'underStudyingProjectsCount' => $underStudyingProjectsCount,
            'completeProjectsCount'      => $completeProjectsCount,
            //'progressPercentage'         => $progressPercentage,
        ]);
    }


    public function review(Request $request)
    {
        $group = $request->group;
        $batch = $request->batch;
        $students = $this->students->paginate($request->perPage ? $request->perPage : PAGINATE_COUNT, $request->year,$request->start_date,$request->end_date, $request->search, $request->registration_number,$request->batch, $request->group,$request->rank,$request->passport);

        return view('dashboard.printer.reviews-list', compact('students', 'group', 'batch'));
    }
    public function certificate(Request $request)
    {
      $group = $request->group;
      $batch = $request->batch;
      $students = $this->students->paginate($request->perPage ? $request->perPage : PAGINATE_COUNT, $request->year,$request->start_date,$request->end_date, $request->search, $request->registration_number,$request->batch, $request->group,$request->rank,$request->passport);
        // return view('dashboard.printer.certificate', compact('account'));
        return view('dashboard.printer.certificate-list', compact('students', 'group', 'batch'));

        // return redirect()->back();
    }


    public function studentModel()
    {
        $filePath = storage_path('app/public/student-model-file.xlsx');
        $newFilename = 'إستمارة معلومات المتربصين.xlsx';
        return Response::download($filePath, $newFilename);
    }

    public function printSupervisors($student_id){
        
        $student = Student::find($student_id);
        if (!$student) {
            return redirect()->back()->with('error', 'Student not found');
        }
        $studentGroups = StudentGroup::where('id_student',$student->id)->get();
        $project = Project::whereHas('supervisingTeacherProjects', function($query) use ($student) {
            $query->where('id_student', $student->id);
        })->first();
        $studentGroups = StudentGroup::where('id_student', $student->id)->get();
        $supervisors = SupervisingTeacher::whereHas('supervisingTeacherProjects', function($query) use ($student) {
            $query->where('id_student', $student->id);
        })->get();
        $faculty = Faculty::where('id',$student->id_faculty)->get()->first();

        return view('dashboard.printer.supervisor_raport', compact('student','faculty', 'supervisors', 'studentGroups','project'));
    }

    public function label($project_id){
        $project = Project::find($project_id);
        $student = Student::where('id', '=', $project->id_student)->first();
        //dd($student);
        return view('dashboard.printer.certificat', compact('student'));
    }

    public function generateCertificate($project_id, $student_id = null) {
        $project = Project::find($project_id);
    
        if (!$project) {
            return redirect()->back()->with('error', 'Project not found');
        }
    
        $student = $student_id ? Student::find($student_id) : Student::where('id', $project->id_student)->first();
    
        if (!$student) {
            return redirect()->back()->with('error', 'Student not found');
        }
    
        $teamMembers = StudentGroup::where('id_student', $student->id)->get();
    
        $stages = [
            1 => 'Étape de configuration',
            2 => 'Créer BMC',
            3 => 'L\'étape de préparation du prototype',
            4 => 'Étape de discussion',
            5 => 'Projet innovant label',
        ];
    
        $currentStage = $stages[$project->project_tracking] ?? 'Unknown Stage';
    
        return view('student-dashboard.certificate', compact('student', 'project', 'currentStage', 'teamMembers'));
    }
    public function generateStudentCertificate($project_id, $student_id = null) {
        $project = Project::find($project_id);
    
        if (!$project) {
            return redirect()->back()->with('error', 'Project not found');
        }
    
        //$student = $student_id ? Student::find($student_id) : Student::where('id', $project->id_student)->first();
        $student = StudentGroup::find($student_id);
        //dd($student);
        if (!$student) {
            return redirect()->back()->with('error', 'Student not found');
        }
    
        $stages = [
            1 => 'Étape de configuration',
            2 => 'Créer BMC',
            3 => 'L\'étape de préparation du prototype',
            4 => 'Étape de discussion',
            5 => 'Projet innovant label',
        ];
    
        $currentStage = $stages[$project->project_tracking] ?? 'Unknown Stage';
    
        return view('student-dashboard.certificate_students', compact('student', 'project', 'currentStage'));
    }
    

    public function printCommission($id){
        $project = Project::with(['student', 'commission'])->find($id);

        if (!$project) {
            abort(404);
        }
    
        $allStudents = StudentGroup::where('id_student', $project->student->id)->get();
    

        return view('dashboard.printer.commission', compact('project', 'allStudents'));
    }
    

}
