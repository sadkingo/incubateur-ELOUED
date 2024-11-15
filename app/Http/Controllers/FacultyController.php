<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FacultyController extends Controller {
    
    public function get($id) {
        $faculty = Faculty::find($id);
        return response()->json([
        'faculty' => $faculty
        ]);
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|string',
            'name_fr' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
            'icon' => 'error',
            'state' => __("Error"),
            'message' => $validator->errors()->first()
            ], 422);
        }

        try{

            Faculty::create($request->all());

        return response()->json([
            'icon' => 'success',
            'state' => __("Success"),
            'message' => __("Faculty Created successfully")
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
            'name_ar' => 'required|string',
            'name_fr' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
            'icon' => 'error',
            'state' => __("Error"),
            'message' => $validator->errors()->first()
            ], 422);
        }

        try{

            $faculty = Faculty::find($request->faculty_id);
            $faculty->update($request->all());

            return response()->json([
            'icon' => 'success',
            'state' => __("Success"),
            'message' => __("Faculty Updated Successfully.")
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
        $faculty = Faculty::find($id);

        if($faculty) {
            $faculty->delete();
        }

        return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Faculty Deleted Successfully.")
        ]);
    }
}
