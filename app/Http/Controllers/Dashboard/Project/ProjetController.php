<?php
namespace App\Http\Controllers\Dashboard\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Student;
use App\Models\ProjectImage;
use App\Models\Commission;
use Illuminate\Support\Facades\Storage;

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
        toastr()->success(trans('message.success.update'));
        return redirect()->route('dashboard.project.index');
    }

    public function editAllDatesForm(){
        return view('dashboard.project.edit_all_dates');
    }
 
    public function updateAllDates(Request $request){
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
 
        $projects = Project::all();
        foreach ($projects as $project) {
            $project->start_date = $request->input('start_date');
            $project->end_date = $request->input('end_date');
            $project->save();
        }
         
        toastr()->success(trans('message.success.update'));
        return redirect('/dashboard/projet');
    }
    
   // DashboardController.php

   public function studentReports()
   {
       $acceptedProjectsCount = Project::where('status', 2)->count();
       $rejectedProjectsCount = Project::where('status', 0)->count();
       $underStudyingProjectsCount = Project::where('status', 1)->count();
       $completeProjectsCount = Project::where('status', 3)->count();
       $totalProjectsCount = Project::count();

       return view('dashboard.student.reports', [
           'acceptedProjectsCount' => $acceptedProjectsCount,
           'rejectedProjectsCount' => $rejectedProjectsCount,
           'underStudyingProjectsCount' => $underStudyingProjectsCount,
           'completeProjectsCount' => $completeProjectsCount,
           'totalProjectsCount' => $totalProjectsCount,
       ]);
   }

   public function printStudentReport()
   {
       $acceptedProjectsCount = Project::where('status', 2)->count();
       $rejectedProjectsCount = Project::where('status', 0)->count();
       $underStudyingProjectsCount = Project::where('status', 1)->count();
       $completeProjectsCount = Project::where('status', 3)->count();
       $totalProjectsCount = Project::count();

       return view('dashboard.printer.project_report', [
           'acceptedProjectsCount' => $acceptedProjectsCount,
           'rejectedProjectsCount' => $rejectedProjectsCount,
           'underStudyingProjectsCount' => $underStudyingProjectsCount,
           'completeProjectsCount' => $completeProjectsCount,
           'totalProjectsCount' => $totalProjectsCount,
       ]);
   }
    
}


