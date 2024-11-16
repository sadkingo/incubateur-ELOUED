<?php

namespace App\Http\Controllers;

use App\Models\AdministrativeFiles;
use App\Models\Faculty;
use App\Models\Commission;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CommissionController extends Controller {

  public function get($id) {
    $commission = Commission::find($id);
    return response()->json($commission);
  }

  public function create(Request $request) {
    $validator = Validator::make($request->all(), [
      'name_ar' => 'required',
      'name_fr' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
        ], 422);
    }

    try{

      Commission::create($request->all());

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Commission Created successfully")
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
    $validator = Validator::make($request->all(), [
      'name_ar' => 'required',
      'name_fr' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
        ], 422);
      }

      try{

        $commission = Commission::find($request->id);
        $commission->update($request->all());

        return response()->json([
          'icon' => 'success',
          'state' => __("Success"),
          'message' => __("Commission Updated Successfully.")
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'icon' => 'error',
          'state' => __("Error"),
          'message' => $e->getMessage()
        ]);
      }

  }

  public function getStudentsInCommission($commissionId){

    $commission = Commission::findOrFail($commissionId);
    // $students = $commission->students();
    $projects = $commission->projects;
    return view('dashboard.commission.students')
    ->with('projects',$projects)
    // ->with('students',$students)
    ->with('commission',$commission);
  }

  public function delete($id) {
    $commission = Commission::find($id);

    if($commission) {
      $commission->delete();
    }

    return response()->json([
      'icon' => 'success',
      'state' => __("Success"),
      'message' => __("Commission Deleted Successfully.")
    ]);
  }
}
