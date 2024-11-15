<?php

namespace App\Http\Controllers;

use App\Models\AdministrativeFiles;
use App\Models\Faculty;
use App\Models\Manager;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ManagerController extends Controller {

  public function projects() {
    return redirect()->route('dashboard.projects');
  }

  public function get($id) {
    $manager = Manager::find($id);
    return response()->json([
      'manager' => $manager
    ]);
  }

  public function create(Request $request) {
    $validator = Validator::make($request->all(), [
        'firstname_ar' => 'required|string',
        'lastname_ar' => 'required|string',
        'phone'        => 'required|numeric|unique:supervising_teachers,phone|unique:teachers,phone|unique:managers,phone|unique:admins,phone|unique:students,phone',
        'email'        => 'required|email|unique:supervising_teachers,email|unique:teachers,email|unique:managers,email|unique:admins,email|unique:students,email',
        'password' => 'required|min:6',
        'faculty' => 'required|exists:faculties,id',
      ]);

    if ($validator->fails()) {
        return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
        ], 422);
    }

    try{

      $manager = new Manager();
      $manager->firstname_ar = $request->firstname_ar;
      $manager->lastname_ar = $request->lastname_ar;
      $manager->email = $request->email;
      $manager->phone = $request->phone;
      $manager->faculty_id = $request->faculty;
      $manager->password = $request->password;
      $manager->save();

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Manager Created successfully")
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
    $manager = Manager::find($request->manager_id);
    $validator = Validator::make($request->all(), [
      'firstname_ar' => 'required|string',
      'lastname_ar' => 'required|string',
      'phone'        => 'required|numeric|unique:managers,phone,' . $manager->id . '|unique:teachers,phone|unique:admins,phone|unique:supervising_teachers,phone|unique:students,phone',
      'email'        => 'required|email|unique:managers,email,' . $manager->id . '|unique:teachers,email|unique:admins,email|unique:supervising_teachers,email|unique:students,email',
      'faculty_id' => [
        'required',
        Rule::exists('faculties', 'id')->where(function ($query) {
          return $query->whereNotIn('id', function ($query) {
            return $query->select('faculty_id')->from('managers')->where('id', '!=', request()->manager_id);
          });
        }),
      ],
      'password' => 'sometimes|nullable|min:6',
    ]);

    if ($validator->fails()) {
        return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
        ], 422);
    }

    try{

      $manager->firstname_ar = $request->firstname_ar;
      $manager->lastname_ar = $request->lastname_ar;
      $manager->email = $request->email;
      $manager->phone = $request->phone;
      $manager->faculty_id = $request->faculty_id;
      if($request->password){
        $manager->password = $request->password;
      }
      $manager->save();

        return response()->json([
          'icon' => 'success',
          'state' => __("Success"),
          'message' => __("Manager Updated Successfully.")
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'icon' => 'error',
          'state' => __("Error"),
          'message' => $e->getMessage()
        ]);
      }

  }

  public function delete($id) {
    $manager = Manager::find($id);
    if($manager) {
      $manager->delete();
    }

    return response()->json([
      'icon' => 'success',
      'state' => __("Success"),
      'message' => __("Manager Deleted Successfully.")
    ]);
  }
}
