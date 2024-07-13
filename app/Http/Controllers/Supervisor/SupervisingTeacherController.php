<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use App\Models\Faculty;
use App\Models\Project;
use App\Models\SupervisingTeacher;
use App\Models\SupervisingTeacherProject;
use Illuminate\Http\Request;
use App\Repositories\Student\StudentRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class SupervisingTeacherController extends Controller
{
    private $students;

    
    /**
     * StudentDashboardController constructor.
     * @param StudentRepository $students
    */

    public function __construct(StudentRepository $students)
    {
        $this->students = $students;
    }
    public function create(){

        $student = $this->students->find(auth('student')->id());
        $supervisors = SupervisingTeacher::where('departement', $student->department)->paginate(2); 
        $faculties = Faculty::all();
        $departments = Departement::all();
        return view('supervisor.create', compact('supervisors','faculties','departments'));
    }
    


    public function store(Request $request){
        $student = $this->students->find(auth('student')->id());   
        $validator = Validator::make($request->all(), [
            'firstname_ar' => ['required', 'regex:/^[\p{Arabic}\s]+$/u'],
            'lastname_ar'  => ['required', 'regex:/^[\p{Arabic}\s]+$/u'],
            'firstname_fr' => 'required',
            'lastname_fr'  => 'required',
            'gender'       => 'required',
            'speciality'   => 'required',
            'faculty'      => 'required',
            'department'  => 'required',
            'grade'        => 'required',
            'phone'        => 'required',
            'email'        => 'required|email',
            'supervisor_role' => 'required',
        ], [
            'firstname_ar.required' => 'First name arabic is required',
            'firstname_ar.regex' => 'First name arabic must be in Arabic letters only',
            'lastname_ar.required'  => 'Last name arabic is required',
            'lastname_ar.regex' => 'Last name arabic must be in Arabic letters only',
            'firstname_fr.required' => 'First name fr is required',
            'lastname_fr.required' => 'Last name fr is required',
            'gender.required' => 'Gender is required',
            'speciality.required' => 'Speciality is required',
            'faculty.required' => 'Faculty is required',
            'department.required' => 'Department is required',
            'grade.required' => 'Grade is required',
            'phone.required' => 'Phone is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'supervisor_role.required' => 'Supervisor role is required',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $existingPhone = SupervisingTeacher::where('phone', $request->input('phone'))->first();
        if ($existingPhone) {
            return back()->withErrors(['phone' => 'رقم الهاتف موجود بالفعل.'])->withInput();
        }
    
        $existingEmail = SupervisingTeacher::where('email', $request->input('email'))->first();
        if ($existingEmail) {
            return back()->withErrors(['email' => 'البريد الإلكتروني موجود بالفعل.'])->withInput();
        }
    
        $supervisor = new SupervisingTeacher;
        $supervisor->phone = $request->input('phone');
        $supervisor->email = $request->input('email');
        $supervisor->lastname_ar = $request->input('lastname_ar');
        $supervisor->firstname_ar = $request->input('firstname_ar');
        $supervisor->firstname_fr = $request->input('firstname_fr');
        $supervisor->lastname_fr = $request->input('lastname_fr');
        $supervisor->gender = $request->input('gender');
        $supervisor->speciality = $request->input('speciality');
        $supervisor->faculty = $request->input('faculty');
        $supervisor->departement = $request->input('department');
        $supervisor->grade = $request->input('grade');
        $supervisor->role = $request->input('supervisor_role');
        $supervisor->id_student = $student->id;
        $supervisor->save();
    
        $project = Project::where('id_student', $student->id)->first();
        if ($project) {
            $supervisorProject = new SupervisingTeacherProject;
            $supervisorProject->id_student = $student->id;
            $supervisorProject->id_project = $project->id;
            $supervisorProject->id_supervisor = $supervisor->id;
            $supervisorProject->save();
        } else {
            toastr()->success(trans('message.success.create'));
            toastr()->warning(trans('message.warning.supervisor'));
            return redirect()->route('student.index');
        }
    
        toastr()->success(trans('message.success.create'));
        return redirect()->route('student.index');
    }
    
    
    
public function assign(Request $request, $id)
{
    $supervisingTeacher = SupervisingTeacher::findOrFail($id);
    
    
    $student = auth('student')->user();
    $project = Project::where('id_student', $student->id)->first();

    if ($project) {
        $supervisorProject = SupervisingTeacherProject::where('id_student', $student->id)
                                                      ->where('id_project', $project->id)
                                                      ->first();
        if ($supervisorProject) {
            $supervisorProject->id_supervisor = $supervisingTeacher->id;
            $supervisorProject->save();
        } else {
            $supervisorProject = new SupervisingTeacherProject;
            $supervisorProject->id_student = $student->id;
           // $supervisorProject->id_project = $project->id;
            $supervisorProject->id_supervisor = $supervisingTeacher->id;
            $supervisorProject->save();
        }
    }

    toastr()->success(trans('message.success.assign'));
    return redirect()->route('student.index');
}

}
