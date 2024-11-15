<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Student;
use App\Models\StudentGroup;
use App\Models\Teacher;
use App\Repositories\Student\StudentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class TeacherController extends Controller {

    public function index(){
        $student = Teacher::findNotes(auth('student')->id());
        $allStudents = Student::all();
        return view('teacher-dashboard.index',compact('allStudents'));
    }

    public function projects(){

        $projects = Project::all();

        return view('teacher-dashboard.projects',compact('projects'));
    }

    public function showProject(Project $project) {
        $student = Student::where('id',$project->id_student)->get();
        $projectImages = ProjectImage::where('id_project',$project->id)->get();
        return view('teacher-dashboard.project-show', compact('student','project','projectImages'));
    }

    public function updateProjectStatus(Request $request) {
        $project = Project::find($request->project_id);
        $project->status = $request->status;
        $project->save();

        return response()->json([
            'message' => 'Project status updated successfully',
            'status' => $project->status
        ]);
    }

    public function create() {
        $commissions = Commission::all();
        return view('dashboard.teacher.create')
        ->with('commissions', $commissions);
    }

    public function store(Request $request) {
      $validator = Validator::make($request->all(), [
        'firstname_ar' => ['required', 'regex:/^[\p{Arabic}\s]+$/u'],
        'lastname_ar'  => ['required', 'regex:/^[\p{Arabic}\s]+$/u'],
        'firstname_fr' => 'required',
        'lastname_fr'  => 'required',
        'phone'        => 'required|numeric|unique:supervising_teachers,phone|unique:teachers,phone|unique:managers,phone|unique:admins,phone|unique:students,phone',
        'email'        => 'required|email|unique:supervising_teachers,email|unique:teachers,email|unique:managers,email|unique:admins,email|unique:students,email',
        'gender'       => 'required|in:1,2',
        'birthday'       => 'required',
        'address'       => 'required',
        'commission_id'       => 'required',
        'grade'       => 'required',
        'password' => 'required|min:6',
      ],[
          'firstname_ar.required' => 'First name arabic is required',
          'firstname_ar.regex' => 'First name arabic must be in Arabic letters only',
          'lastname_ar.required'  => 'Last name arabic is required',
          'lastname_ar.regex' => 'Last name arabic must be in Arabic letters only',
          'firstname_fr.required' => 'First name fr is required',
          'lastname_fr.required' => 'Last name fr is required',
          'phone.required' => 'Phone is required',
          'phone.numeric' => 'Phone must be a number',
          'phone.unique' => 'Phone must be unique',
          'email.required' => 'Email is required',
          'email.email' => 'Email must be a valid email address',
          'email.unique' => 'Email must be unique',
          'gender.required' => 'Gender is required',
          'gender.in' => 'Gender must be 1 or 2',
          'birthday.required' => 'Birthday is required',
          'address.required' => 'Address is required',
          'commission_id.required' => 'Commission is required',
          'grade.required' => 'Grade is required',
      ]);

      if ($validator->fails()) {
          return back()->withErrors($validator)->withInput();
      }

      Teacher::create($request->all());

      toastr()->success(trans('message.success.create'));
      return redirect()->route('teachers');
    }

    public function show($id) {
      $teacher = Teacher::find($id);
      $commissions = Commission::all();
      return view('dashboard.teacher.edit')
      ->with('teacher', $teacher)
      ->with('commissions', $commissions);
    }

    public function update(Request $request, $id) {
        $teacher = Teacher::find($request->id);
        $validator = Validator::make($request->all(), [
          'firstname_ar' => ['required', 'regex:/^[\p{Arabic}\s]+$/u'],
          'lastname_ar'  => ['required', 'regex:/^[\p{Arabic}\s]+$/u'],
          'firstname_fr' => 'required',
          'lastname_fr'  => 'required',
          'phone'        => 'required|numeric|unique:teachers,phone,' . $teacher->id . '|unique:supervising_teachers,phone|unique:managers,phone|unique:admins,phone|unique:students,phone',
          'email'        => 'required|email|unique:teachers,email,' . $teacher->id . '|unique:supervising_teachers,email|unique:managers,email|unique:admins,email|unique:students,email',
          'gender'       => 'required|in:1,2',
          'birthday'       => 'required',
          'address'       => 'nullable',
          'commission_id'       => 'required',
          'grade'       => 'required',
          'password' => 'sometimes|nullable|min:6',
        ],[
            'firstname_ar.required' => 'First name arabic is required',
            'firstname_ar.regex' => 'First name arabic must be in Arabic letters only',
            'lastname_ar.required'  => 'Last name arabic is required',
            'lastname_ar.regex' => 'Last name arabic must be in Arabic letters only',
            'firstname_fr.required' => 'First name fr is required',
            'lastname_fr.required' => 'Last name fr is required',
            'phone.required' => 'Phone is required',
            'phone.numeric' => 'Phone must be a number',
            'phone.unique' => 'Phone must be unique',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.unique' => 'Email must be unique',
            'gender.required' => 'Gender is required',
            'gender.in' => 'Gender must be 1 or 2',
            'birthday.required' => 'Birthday is required',
            'commission_id.required' => 'Commission is required',
            'grade.required' => 'Grade is required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        $teacher->update($request->all());


        toastr()->success(trans('message.success.update'));
        return redirect()->route('teachers');
    }

    public function destroy(Request $request) {
        $teacher = Teacher::find($request->id);

        if ($teacher) {
          $teacher->delete($request->id);
        }

        return response()->json([
          'icon' => 'success',
          'state' => __("Success"),
          'message' => __("Teacher Deleted Successfully.")
        ]);

    }

}
