<?php

namespace App\Http\Controllers\Dashboard\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Student\StudentRepository;
use App\Http\Requests\Student\StoreStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Models\Faculty;
use App\Models\Project;
use App\Models\Student;
use App\Models\StudentGroup;
use App\Models\SupervisingTeacher;

use function PHPUnit\Framework\isEmpty;

class StudentController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $students = $this->students->paginate($request->perPage ? $request->perPage : 100, $request->year,$request->start_date,$request->end_date, $request->search, $request->registration_number,$request->batch, $request->group,$request->rank,$request->passport);
        return view('dashboard.student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $this->students->create($request->all());
        toastr()->success(trans('message.success.create'));
        return redirect()->route('students.index');
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
    public function edit($id){
        $student = $this->students->find($id);
        return view('dashboard.student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request) {
        $this->students->update($request->id, $request->all());
        toastr()->success(trans('message.success.update'));
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {
        $this->students->delete($request->id);
        toastr()->success(trans('message.success.delete'));
        return redirect()->route('students.index');
    }

    // StudentController.php

    private function getProjectStageInfo($projectStage){
        $stages = [
            1 => ['key' => 'business_model_preparation', 'percentage' => 25],
            2 => ['key' => 'prototype_development', 'percentage' => 50],
            3 => ['key' => 'startup_dz_registration', 'percentage' => 75],
            4 => ['key' => 'discussion', 'percentage' => 100],
        ];

        $stage = $stages[$projectStage] ?? ['key' => 'unknown', 'percentage' => 0];
        $stage['name'] = trans('student.' . $stage['key']);

        return $stage;
    }

    public function showProfile($id){
        $student = Student::find($id);
        $project = Project::whereHas('supervisingTeacherProjects', function($query) use ($student) {
            $query->where('id_student', $student->id);
        })->first();
        $studentGroups = null;
        if($project) {
          $studentGroups = StudentGroup::where('project_id', $project->id)->get();
        }
        $supervisors = SupervisingTeacher::whereHas('supervisingTeacherProjects', function($query) use ($student) {
            $query->where('id_student', $student->id);
        })->get();
        $stageInfo = $this->getProjectStageInfo($student->project_stage);
        $faculty = Faculty::where('id', $student->id_faculty)->get()->first();
        return view('dashboard.student.profile', compact('student','project','studentGroups','supervisors', 'stageInfo', 'faculty'));
    }
    public function editStage($id)
    {
        $student = $this->students->find($id);

        return view('dashboard.student.edit_stage', compact('student'));
    }

    public function updateStage(Request $request, $id){
        $student = $this->students->find($id);
        if ($student) {
            $student->project_stage = $request->input('stage');
            $student->save();
            toastr()->success(trans('message.success.update'));
            return redirect('/dashboard/students/'.$student->id.'/profile');
        }

        return response()->json(['success' => false, 'message' => 'Student not found']);
    }

    // public function certificates($project_id){

    //     $project = Project::find($project_id);

    //     if (!$project) {
    //         return redirect()->back()->withErrors(['message' => 'Project not found.']);
    //     }

    //     return view('student-dashboard.certificates')
    //     ->with('project',$project);
    // }

}
