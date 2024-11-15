<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AdministrativeFiles;
use App\Models\Faculty;
use App\Repositories\Student\StudentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminController extends Controller {
  public function get($id) {
    $admin = Admin::find($id);

    return response()->json([
      'admin' => $admin,
    ]);
    // $facultys = Faculty::all();
    // return view('dashboard.admin.index')
    // ->with('facultys',$facultys)
    // ->with('admin',$admin);
  }

  public function create(Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'phone'        => 'required|numeric|unique:supervising_teachers,phone|unique:teachers,phone|unique:managers,phone|unique:admins,phone|unique:students,phone',
        'email'        => 'required|email|unique:supervising_teachers,email|unique:teachers,email|unique:managers,email|unique:admins,email|unique:students,email',
        'password' => 'required|min:6',
        'role' => 'required|in:admin,incubateur,cde,cati',
    ]);

    if ($validator->fails()) {
        return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
        ], 422);
    }

    try{

      Admin::create($request->all());

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Admin Created successfully")
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
    $admin = Admin::find($request->admin_id);
    $validator = Validator::make($request->all(), [
      'name' => 'required|string',
      'phone'        => 'required|numeric|unique:admins,phone,' . $admin->id . '|unique:teachers,phone|unique:managers,phone|unique:supervising_teachers,phone|unique:students,phone',
      'email'        => 'required|email|unique:admins,email,' . $admin->id . '|unique:teachers,email|unique:managers,email|unique:supervising_teachers,email|unique:students,email',
      'role' => 'required|in:admin,incubateur,cde,cati',
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

      $admin->update($request->all());

        return response()->json([
          'icon' => 'success',
          'state' => __("Success"),
          'message' => __("Admin Updated Successfully.")
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
    $admin = Admin::find($id);
    if($admin) {
      $admin->delete();
    }

    return response()->json([
      'icon' => 'success',
      'state' => __("Success"),
      'message' => __("Admin Deleted Successfully.")
    ]);
  }
}
