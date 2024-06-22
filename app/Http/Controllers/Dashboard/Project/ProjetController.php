<?php

namespace App\Http\Controllers\Dashboard\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Student;
use App\Models\ProjectImage;
use App\Models\Commission;
class ProjetController extends Controller
{
    private $commission;
    public function index()
    {
        $projects = Project::with(['commission', 'student', 'supervisingTeachers'])->paginate(10);
        return view('dashboard.project.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $student = Student::where('id',$project->id_student)->get();
        $projectImages = ProjectImage::where('id_project',$project->id)->get(); 
        //dd($projectImages);   
       // return view('dashboard.project.show', compact('project'));
        return view('dashboard.project.show', compact('student','project','projectImages'));
    }

    public function updateProjectStatus(Request $request)
    {
        $project = Project::find($request->project_id);
        if ($project) {
            $project->status = $request->status;
            $project->save();

            return response()->json([
                'message' => 'Project status updated successfully',
                'status' => $project->status
            ]);
        } else {
            return response()->json([
                'message' => 'Project not found'
            ], 404);
        }
    }

    public function addCommissionForm(Project $project)
    {
        $commissions = Commission::all();
        return view('dashboard.project.add_commission', compact('project', 'commissions'));
    }

    public function storeCommission(Request $request, Project $project){
    $request->validate([
        'commission_id' => 'required|exists:commissions,id',
    ]);

    $project->id_commission = $request->commission_id;
    $project->save();

    return redirect()->route('dashboard.project.index')->with('success', 'Commission added successfully');
}


    
}


