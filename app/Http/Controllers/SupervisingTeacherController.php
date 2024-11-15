<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use App\Models\Faculty;
use App\Models\Project;
use App\Models\Student;
use App\Models\SupervisingTeacher;
use App\Models\SupervisingTeacherProject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class SupervisingTeacherController extends Controller {

    public function create(){
        $faculties = Faculty::all();
        $departments = Departement::all();
        return view('dashboard.supervisors.create')
        ->with('faculties', $faculties)
        ->with('departments', $departments);
    }

    public function edit($id){

      $supervisor = SupervisingTeacher::find($id);
      $faculties = Faculty::all();
      $departments = Departement::all();
      return view('dashboard.supervisors.index')
      ->with('supervisor', $supervisor)
      ->with('faculties', $faculties)
      ->with('departments', $departments);
  }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'firstname_ar' => ['required', 'regex:/^[\p{Arabic}\s]+$/u'],
            'lastname_ar'  => ['required', 'regex:/^[\p{Arabic}\s]+$/u'],
            'firstname_fr' => 'required',
            'lastname_fr'  => 'required',
            'gender'       => 'required',
            'speciality'   => 'required',
            'faculty_id'      => 'required',
            'departement_id'  => 'required',
            'grade'        => 'required',
            // TODO: add unique email and phone for all account not just supervising_teachers table
            'phone'        => 'required|numeric|unique:supervising_teachers,phone|unique:teachers,phone|unique:managers,phone|unique:admins,phone|unique:students,phone',
            'email'        => 'required|email|unique:supervising_teachers,email|unique:teachers,email|unique:managers,email|unique:admins,email|unique:students,email',
        ], [
            'firstname_ar.required' => 'First name arabic is required',
            'firstname_ar.regex' => 'First name arabic must be in Arabic letters only',
            'lastname_ar.required'  => 'Last name arabic is required',
            'lastname_ar.regex' => 'Last name arabic must be in Arabic letters only',
            'firstname_fr.required' => 'First name fr is required',
            'lastname_fr.required' => 'Last name fr is required',
            'gender.required' => 'Gender is required',
            'speciality.required' => 'Speciality is required',
            'faculty_id.required' => 'Faculty is required',
            'departement_id.required' => 'Department is required',
            'grade.required' => 'Grade is required',
            'phone.required' => 'Phone is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'phone.numeric' => 'Phone must be a valid number',
            'phone.unique' => 'Phone must be unique',
            'email.unique' => 'Email must be unique',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
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
        $supervisor->faculty_id = $request->input('faculty_id');
        $supervisor->departement_id = $request->input('departement_id');
        $supervisor->grade = $request->input('grade');
        $supervisor->save();

        // $project = Project::where('id_student', $student->id)->first();
        // if ($project) {
        //     $supervisorProject = new SupervisingTeacherProject;
        //     $supervisorProject->id_student = $student->id;
        //     $supervisorProject->id_project = $project->id;
        //     $supervisorProject->id_supervisor = $supervisor->id;
        //     $supervisorProject->save();
        // } else {
        //     toastr()->success(trans('message.success.create'));
        //     toastr()->warning(trans('message.warning.supervisor'));
        //     return redirect()->route('supervisors');
        // }

        toastr()->success(trans('message.success.create'));
        return redirect()->route('supervisors');
    }

    public function assign(Request $request, $id) {
        $supervisingTeacher = SupervisingTeacher::findOrFail($id);


        // $student = auth('student')->user();
        // $project = Project::where('id_student', $student->id)->first();

        // if ($project) {
        //     $supervisorProject = SupervisingTeacherProject::where('id_student', $student->id)
        //                                                   ->where('id_project', $project->id)
        //                                                   ->first();
        //     if ($supervisorProject) {
        //         $supervisorProject->id_supervisor = $supervisingTeacher->id;
        //         $supervisorProject->save();
        //     } else {
        //         $supervisorProject = new SupervisingTeacherProject;
        //         $supervisorProject->id_student = $student->id;
        //        // $supervisorProject->id_project = $project->id;
        //         $supervisorProject->id_supervisor = $supervisingTeacher->id;
        //         $supervisorProject->save();
        //     }
        // }

        toastr()->success(trans('message.success.assign'));
        return redirect()->route('supervisors');
    }

  public function update(Request $request, $id) {
      $supervisingTeacher = SupervisingTeacher::find($request->id);
      $validator = Validator::make($request->all(), [
        'firstname_ar' => ['required', 'regex:/^[\p{Arabic}\s]+$/u'],
        'lastname_ar'  => ['required', 'regex:/^[\p{Arabic}\s]+$/u'],
        'firstname_fr' => 'required',
        'lastname_fr'  => 'required',
        'gender'       => 'required',
        'phone'        => 'required|numeric|unique:supervising_teachers,phone,' . $supervisingTeacher->id . '|unique:teachers,phone|unique:managers,phone|unique:admins,phone|unique:students,phone',
        'email'        => 'required|email|unique:supervising_teachers,email,' . $supervisingTeacher->id . '|unique:teachers,email|unique:managers,email|unique:admins,email|unique:students,email',
        'speciality'   => 'required',
        'faculty_id'   => 'required',
        'departement_id'   => 'required',
        'grade'   => 'required',
      ], [
          'firstname_ar.required' => 'First name arabic is required',
          'firstname_ar.regex' => 'First name arabic must be in Arabic letters only',
          'lastname_ar.required'  => 'Last name arabic is required',
          'lastname_ar.regex' => 'Last name arabic must be in Arabic letters only',
          'firstname_fr.required' => 'First name fr is required',
          'lastname_fr.required' => 'Last name fr is required',
          'phone.required' => 'Phone is required',
          'email.required' => 'Email is required',
          'email.email' => 'Email must be a valid email address',
          'gender.required' => 'Gender is required',
          'phone.numeric' => 'Phone must be a valid number',
          'email.unique' => 'Email must be unique',
          'phone.unique' => 'Phone must be unique',
      ]);

      if ($validator->fails()) {
          return back()->withErrors($validator)->withInput();
      }

      $supervisingTeacher->update($request->all());

      toastr()->success(trans('message.success.create'));
      return redirect()->route('supervisors');

    }


    public function destroy($id) {
    $supervisingTeacher = SupervisingTeacher::find($id);

    if($supervisingTeacher) {
      $supervisingTeacher->delete();
    }

    return response()->json([
      'icon' => 'success',
      'state' => __("Success"),
      'message' => __("supervisingTeacher Deleted Successfully.")
    ]);
  }
}
