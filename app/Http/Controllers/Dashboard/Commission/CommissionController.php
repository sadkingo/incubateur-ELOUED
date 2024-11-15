<?php

namespace App\Http\Controllers\Dashboard\Commission;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\Project;
use App\Models\StudentGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommissionController extends Controller{


    // public function index(Request $request)
    // {
    //     $perPage = 10;

    //     $commissions = Commission::withCount(['teachers', 'projects'])->paginate($perPage);

    //     return view('dashboard.commission.index', compact('commissions'));
    // }

    // public function create(){
    //     return view('dashboard.commission.create');
    // }

    // public function store(Request $request){

    //     $validator = Validator::make($request->all(), [
    //         'name_ar' => 'required',
    //         'name_fr' => 'required',

    //     ], [
    //         'name_ar.required' => 'The name in arabic is required.',
    //         'name_fr.required' => 'The name in franche is required.',
    //     ]);

    //     if ($validator->fails()) {
    //         return back()->withErrors($validator)->withInput();
    //     }

    //     $commission = new Commission;
    //     $commission->name_ar = $request->input('name_ar');
    //     $commission->name_fr = $request->input('name_fr');
    //     $commission->status = 1;
    //     $commission->save();
    //     toastr()->success(trans('message.success.create'));
    //     return redirect()->route('commission.index');
    // }

    // public function edit($id)
    // {
    //     $commission = Commission::find($id);
    //     if (!$commission) {
    //         return redirect()->route('commission.index')->with('error', 'Commission not found.');
    //     }
    //     return view('dashboard.commission.edit', compact('commission'));
    // }

    // public function update(Request $request, $id){
    //     $request->validate([
    //         'name_ar' => 'required|string|max:255',
    //         'name_fr' => 'required|string|max:255',
    //     ]);

    //     $commission = Commission::find($id);
    //     if (!$commission) {
    //         return redirect()->back()->with('error', 'Commission not found.');
    //     }

    //     $commission->name_ar = $request->input('name_ar');
    //     $commission->name_fr = $request->input('name_fr');
    //     $commission->save();

    //     return redirect()->route('commission.index')->with('success', trans('message.success.update'));
    // }

    // public function destroy($id){
    //     $commission = Commission::find($id);
    //     if (!$commission) {
    //         return redirect()->route('commission.index')->with('error', 'Commission not found.');
    //     }

    //     $commission->delete();

    //     return redirect()->route('commission.index')->with('success', trans('message.success.delete'));
    // }

    // public function stat($id){

    //     $commission       = Commission::find($id);
    //     $projectsAccepted = Project::where('commission_id', $id)
    //                                 ->where('status',2)
    //                                 ->count();
    //     $projectsRejected =  Project::where('commission_id', $id)
    //                                 ->where('status',0)
    //                                 ->count();

    //     return view('dashboard.commission.stat',compact('commission','projectsAccepted','projectsRejected'));

    // }

    // public function getStudentsInCommission($commissionId){

    //     $commission = Commission::findOrFail($commissionId);
    //     $students = $commission->students();
    //     return view('dashboard.commission.students', compact('students','commission'));
    // }
}
