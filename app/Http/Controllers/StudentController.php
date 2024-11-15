<?php

namespace App\Http\Controllers;

use App\Imports\StudentsImport;
use App\Models\Faculty;
use App\Models\Manager;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller {

  public function getNumber($number) {
    $student = Student::where('number', $number)->first();
    return response()->json($student);
  }

  public function import(Request $request) {
      $validator = Validator::make($request->all(), [
        'file' => 'required|mimes:xlsx,csv,xls',
      ]);

      if ($validator->fails()) {
          return response()->json([
          'icon' => 'error',
          'state' => __("Error"),
          'message' => $validator->errors()->first()
          ], 422);
      }

      try {
        $fileName = $request->file('file')->getClientOriginalName();
        $facultyId = pathinfo($fileName, PATHINFO_FILENAME); // Assuming filename is the faculty ID

        $import = new StudentsImport($facultyId);
        // Import the file with the faculty ID
        Excel::import($import, $request->file('file'));

        return response()->json([
            'icon' => 'success',
            'state' => __("Success"),
            'message' => __("Students imported successfully.") // Return the IDs of created students
        ], 200);

    } catch (\Exception $e) {
      return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $e->getMessage()
      ]);
    }
  }

  public function upload_photo(Request $request) {
    $validator = Validator::make($request->all(), [
      'image' => 'required|image|mimes:jpeg,png,jpg,gif',
      'student_id' => 'required|string',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
      ], 422);
    }

    try {
      $student = Student::find($request->student_id);

        if ($student && $request->hasFile('image')) {
          $image = $request->file('image');
          $imageName = time() . '_' . $image->getClientOriginalName();
          $image->move(public_path('assets/img/photos/users/'), $imageName);
          $student->photo = $imageName;
          $student->save();
        }

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Photo uploaded successfully."),
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $e->getMessage()
      ]);
    }
  }

  public function get($id) {
    $student = Student::find($id);
    $facultys = Faculty::all();
    return view('dashboard.student.index')
    ->with('facultys',$facultys)
    ->with('student',$student);
  }

  public function create(Request $request) {
    $validator = Validator::make($request->all(), [
      'firstname_fr' => 'required|string',
      'lastname_fr' => 'required|string',
      'firstname_ar' => 'required|string',
      'lastname_ar' => 'required|string',
      'birthday' => 'required|date',
      'gender' => 'required|numeric|between:1,2',
      'state_of_birth' => 'required|string',
      'place_of_birth' => 'required|string',
      'photo' => 'required',
      'status' => 'nullable|numeric|between:1,2',
      'registration_number' => 'required|numeric|unique:students,registration_number',
      'group' => 'required|numeric',
      'residence' => 'required|string',
      'batch' => 'required|string',
      'start_date' => 'required|date',
      'end_date' => 'required|date|after:start_date',
      'phone'        => 'required|numeric|unique:supervising_teachers,phone|unique:teachers,phone|unique:managers,phone|unique:admins,phone|unique:students,phone',
      'email'        => 'required|email|unique:supervising_teachers,email|unique:teachers,email|unique:managers,email|unique:admins,email|unique:students,email',
      'password' => 'required|min:8|max:255',
      'password_confirmation' => 'required_with:password|same:password|min:8|max:255'
    ]);

    if ($validator->fails()) {
        return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
        ], 422);
    }

    try{

      Student::create($request->all());

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Student Created successfully")
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $e->getMessage()
      ]);
    }

  }

  public function update(Request $request) {
    $student = Student::find($request->id);
    $validator = Validator::make($request->all(), [
      'firstname_fr' => 'string',
      'lastname_fr' => 'string',
      'firstname_ar' => 'string',
      'lastname_ar' => 'string',
      'birthday' => 'date',
      'gender' => 'numeric|between:1,2',
      'state_of_birth' => 'string',
      'place_of_birth' => 'string',
      'photo' => 'nullable|mimes:jpeg,png,jpg',
      'status' => 'nullable|numeric|between:1,2',
      'registration_number' => [
        'required',
        'numeric',
        Rule::unique('students', 'phone')->ignore($student->id),
      ],
      'group' => 'numeric',
      'residence' => 'string',
      'batch' => 'string',
      'start_date' => 'date',
      'end_date' => 'date|after:start_date',
      'phone'        => 'required|numeric|unique:students,phone,' . $student->id . '|unique:teachers,phone|unique:admins,phone|unique:supervising_teachers,phone|unique:managers,phone',
      'email'        => 'required|email|unique:students,email,' . $student->id . '|unique:teachers,email|unique:admins,email|unique:supervising_teachers,email|unique:managers,email',
      'password' => 'sometimes|string|nullable|min:8|max:255',
      'password_confirmation' => 'sometimes|string|nullable|same:password|min:8|max:255'
    ]);

    if ($validator->fails()) {
        return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
        ], 422);
    }

    try{

      $student = Student::find($request->id);
      $student->update($request->all());

        return response()->json([
          'icon' => 'success',
          'state' => __("Success"),
          'message' => __("Student Updated Successfully.")
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'icon' => 'error',
          'state' => __("Error"),
          'message' => $e->getMessage()
        ]);
      }

  }

  public function getUserDetailsFromRegisterdId(Request $request) {
    $student = Student::where('id_faculty', auth('manager')->user()->faculty_id)->where('registration_number', $request->registerd_id)->first();
    if($student) {
      return response()->json([
        'success' => true,
        'firstname_ar' => $student->firstname_ar,
        'lastname_ar' => $student->lastname_ar,
      ]);
    } else {
      return response()->json([
        'message' => "Student not found."
      ]);
    }
  }

  public function delete($id) {
    $student = Student::find($id);
    if($student) {
      $student->delete();
    }

    return response()->json([
      'icon' => 'success',
      'state' => __("Success"),
      'message' => __("Student Deleted Successfully.")
    ]);
  }
}
