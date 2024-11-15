<?php
namespace App\Http\Controllers\Dashboard\Project;
use App\Http\Controllers\Controller;
use App\Models\AdministrativeFiles;
use App\Models\Certificate;
use App\Models\Commission;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Student;
use App\Models\StudentGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjetController extends Controller
{
    private $commission;
    public function index(){
        $projects = Project::with(['commission', 'student', 'supervisingTeachers'])
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
        return view('dashboard.project.index', compact('projects'));
    }
    public function show(Project $project){
        $student = Student::where('id',$project->id_student)->get();
        $projectImages = ProjectImage::where('id_project',$project->id)->get();
        return view('dashboard.project.show', compact('student','project','projectImages'));
    }
    public function updateProjectStatus(Request $request){
        $project = Project::find($request->project_id);
        if ($project) {
            $project->status = $request->status;
            $project->new = 2;
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
    // public function addCommissionForm(Project $project){

    //     return view('dashboard.project.add_commission', compact('project', 'commissions'));
    // }

    public function storeCommission(Request $request){
        $validator = Validator::make($request->all(), [
            'commission_id' => 'required|exists:commissions,id',
            'id' => 'required|exists:projects,id',
        ]);


        if ($validator->fails()) {
            return response()->json([
            'icon' => 'error',
            'state' => __("Error"),
            'message' => $validator->errors()->first()
            ], 422);
        }
        try {
            $project = Project::find($request->id);
            $project->commission_id = $request->commission_id;
            $project->save();

            return response()->json([
                'icon' => 'success',
                'state' => __("Success"),
                'message' => __("Commission Add Successfully.")
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'state' => __("Error"),
                'message' => $e->getMessage()
            ]);
        }
    }

    // public function editAllDatesForm(){
    //     return view('dashboard.project.edit_all_dates');
    // }

    public function updateAllDates(Request $request){

        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);


        if ($validator->fails()) {
            return response()->json([
            'icon' => 'error',
            'state' => __("Error"),
            'message' => $validator->errors()->first()
            ], 422);
        }
        try {

            $projects = Project::all();
            foreach ($projects as $project) {
                $project->start_date = $request->start_date;
                $project->end_date = $request->end_date;
                $project->save();
            }

            return response()->json([
                'icon' => 'success',
                'state' => __("Success"),
                'message' => __("Dead Line Add Successfully.")
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'state' => __("Error"),
                'message' => $e->getMessage()
            ]);
        }
    }

   // DashboardController.php

   public function studentReports(){
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

   public function printStudentReport(){
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

    // public function addProjectType($id){
    //     $project = Project::findOrFail($id);
    //     return view('dashboard.project.add_type', compact('project'));
    // }

    public function storeProjectType(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'type_project' => 'required|in:commercial,industrial,agricultural,service',
            'id' => 'required|exists:projects,id',
        ]);


        if ($validator->fails()) {
            return response()->json([
            'icon' => 'error',
            'state' => __("Error"),
            'message' => $validator->errors()->first()
            ], 422);
        }
        try {
            $project = Project::find($request->id);

            $project->type_project = $request->type_project;

            $project->save();
            return response()->json([
                'icon' => 'success',
                'state' => __("Success"),
                'message' => __("Type Add Successfully.")

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'state' => __("Error"),
                'message' => $e->getMessage()
            ]);
        }
    }

    // public function editProjectType($id){
    //     $project = Project::findOrFail($id);
    //     return view('dashboard.project.edit_type', compact('project',));
    // }

    public function updateProjectType(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'type_project' => 'required|in:commercial,industrial,agricultural,service',
            'id' => 'required|exists:projects,id',
        ]);


        if ($validator->fails()) {
            return response()->json([
            'icon' => 'error',
            'state' => __("Error"),
            'message' => $validator->errors()->first()
            ], 422);
        }
        try {
            $project = Project::find($request->id);

            $project->type_project = $request->type_project;

            $project->save();
            return response()->json([
                'icon' => 'success',
                'state' => __("Success"),
                'message' => __("Type Edit Successfully.")

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'state' => __("Error"),
                'message' => $e->getMessage()
            ]);
        }

    }

    // public function addProjectClassification($id){
    //     $project = Project::findOrFail($id);
    //     return view('dashboard.project.add_classification', compact('project'));
    // }

    public function storeProjectClassification(Request $request){

        $validator = Validator::make($request->all(), [
            'project_classification' => 'required|in:1,2,3,4',
            'id' => 'required|exists:projects,id',
        ]);


        if ($validator->fails()) {
            return response()->json([
            'icon' => 'error',
            'state' => __("Error"),
            'message' => $validator->errors()->first()
            ], 422);
        }
        try {
            $project = Project::find($request->id);

            $project->project_classification = $request->project_classification;

            if($request->project_classification == '1' || $request->project_classification == '2' || $request->project_classification == '4'){
                $project->bmc_status = 0;
            }

            $project->save();
            return response()->json([
                'icon' => 'success',
                'state' => __("Success"),
                'message' => __("Classification Add Successfully.")

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'state' => __("Error"),
                'message' => $e->getMessage()
            ]);
        }
    }

    // public function editProjectClassification($id){
    //     $project = Project::findOrFail($id);
    //     return view('dashboard.project.edit_classification', compact('project',));
    // }

    public function updateProjectClassification(Request $request){

        $validator = Validator::make($request->all(), [
            'project_classification' => 'required|in:1,2,3,4',
            'id' => 'required|exists:projects,id',
        ]);


        if ($validator->fails()) {
            return response()->json([
            'icon' => 'error',
            'state' => __("Error"),
            'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            $project = Project::find($request->id);

            $project->project_classification = $request->project_classification;

            if($request->project_classification == '1' || $request->project_classification == '2' || $request->project_classification == '4'){
                $project->bmc_status = 0;
            }

            $project->save();
            return response()->json([
                'icon' => 'success',
                'state' => __("Success"),
                'message' => __("Classification Edit Successfully.")

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'state' => __("Error"),
                'message' => $e->getMessage()
            ]);
        }
    }


    public function addProjectTracking($id){
        $project = Project::findOrFail($id);
        return view('dashboard.project.project_tracking', compact('project'));
    }

    // public function storeProjectTracking(Request $request, $id){
    //     $validator = Validator::make($request->all(), [
    //         'project_tracking' => 'required',
    //         'id' => 'required|exists:projects,id',
    //     ]);


    //     if ($validator->fails()) {
    //         return response()->json([
    //         'icon' => 'error',
    //         'state' => __("Error"),
    //         'message' => $validator->errors()->first()
    //         ], 422);
    //     }
    //     try {

    //         $project = Project::find($request->id);
    //         $project->project_tracking = $request->project_tracking;
    //         $project->status_project_tracking = 1;
    //         $project->save();

    //         return response()->json([
    //             'icon' => 'success',
    //             'state' => __("Success"),
    //             'message' => __("Tracking Add Successfully.")
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'icon' => 'error',
    //             'state' => __("Error"),
    //             'message' => $e->getMessage()
    //         ]);
    //     }

    // }


    // public function editProjectTracking($id){
    //     $project = Project::findOrFail($id);
    //     return view('dashboard.project.edit_project_tracking', compact('project'));
    // }

    public function updateProjectTracking(Request $request){
        $validator = Validator::make($request->all(), [
            'project_tracking' => 'required',
            'id' => 'required|exists:projects,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
            'icon' => 'error',
            'state' => __("Error"),
            'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            $project = Project::findOrFail($request->id);
            $project->project_tracking = $request->project_tracking;
            if($project->project_classification == 3){
                if($request->project_tracking == 3 || $request->project_tracking == 5 || $request->project_tracking == 6){
                    $project->status_project_tracking = 0;
                    $project->save();
    
                    return response()->json(['success' => true, 'message' => 'Tracking updated successfully.']);
                }else{
                    $project->status_project_tracking = 1;
                    $project->save();
                    return response()->json(['success' => true, 'message' => 'Tracking updated successfully.']);
                }
            }                
            $project->status_project_tracking = 1;
            $project->save();

            return response()->json(['success' => true, 'message' => 'Tracking updated successfully.']);

            return response()->json([
                'icon' => 'success',
                'state' => __("Success"),
                'message' => __("Tracking Add Successfully.")

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'state' => __("Error"),
                'message' => $e->getMessage()
            ]);
        }
    }


    // public function editStatusProjectTracking($id){
    //     $project = Project::findOrFail($id);
    //     return view('dashboard.project.status_project_tracking', compact('project'));
    // }

    public function updateStatusProjectTracking(Request $request, $id){
        $validatedData = $request->validate([
            'status_project_tracking' => 'required',
        ]);

        $project = Project::findOrFail($request->id);
        $project->status_project_tracking  = $request->status_project_tracking;
        $project->save();

        $studentGroups = StudentGroup::where('project_id',$project->id)->get();

        if($request->status_project_tracking == 2){
            if($project->project_classification == 1 || $project->project_classification == 2){
                if($project->project_tracking == 1){
                    // if(count($studentGroups)){
                    //    foreach($studentGroups as $student){
                            $certifecate =  new Certificate;
                            $certifecate->file_name = 'Étape de formation';
                            $certifecate->project_id = $project->id;
                            $certifecate->save();
                        // }
                    // }
                    // else{
                    //     $certifecate =  new Certificate;
                    //         $certifecate->file_name = 'Étape de formation';
                    //         $certifecate->project_id = 0;
                    //         $certifecate->student_id = $student->id;
                    //         $certifecate->save();
                    // }
                }elseif($project->project_tracking == 2){
                    // if(count($studentGroups)){
                        // foreach($studentGroups as $student){
                             $certifecate =  new Certificate;
                             $certifecate->file_name = 'Créer un BMC';
                             $certifecate->project_id = $project->id;
                             $certifecate->save();
                        //  }
                    //  }
                    //  else{
                    //      $certifecate =  new Certificate;
                    //          $certifecate->file_name = 'Créer un BMC';
                    //          $certifecate->project_id = 0;
                    //          
                    //          $certifecate->save();
                    //  }
                }elseif($project->project_tracking == 3){
                    // if(count($studentGroups)){
                        // foreach($studentGroups as $student){
                             $certifecate =  new Certificate;
                             $certifecate->file_name = 'Étape de préparation du prototype';
                             $certifecate->project_id = $project->id;
                             $certifecate->save();
                        //  }
                    //  }
                    //  else{
                    //      $certifecate =  new Certificate;
                    //          $certifecate->file_name = 'Étape de préparation du prototype';
                    //          $certifecate->project_id = 0;
                    //          $certifecate->student_id = $student->id;
                    //          $certifecate->save();
                    //  }
                }elseif($project->project_tracking == 4){
                    // if(count($studentGroups)){
                        // foreach($studentGroups as $student){
                             $certifecate =  new Certificate;
                             $certifecate->file_name = 'Étape de discussion';
                             $certifecate->project_id = $project->id;
                             $certifecate->save();
                        //  }
                    // }
                    // else{
                    //      $certifecate =  new Certificate;
                    //          $certifecate->file_name = 'Étape de discussion';
                    //          $certifecate->project_id = 0;
                    //          
                    //          $certifecate->save();
                    // }
                }else{
                    // if(count($studentGroups)){
                        // foreach($studentGroups as $student){
                             $certifecate =  new Certificate;
                             $certifecate->file_name = 'Label est un projet innovant';
                             $certifecate->project_id = $project->id;
                             $certifecate->save();
                        //  }
                    // }
                    // else{
                    //      $certifecate =  new Certificate;
                    //          $certifecate->file_name = 'Label est un projet innovant';
                    //          $certifecate->project_id = 0;
                    //          $certifecate->student_id = $student->id;
                    //          $certifecate->save();
                    // }
                }
            }else{
                if($project->project_tracking == 1){
                    // if(count($studentGroups)){
                    //    foreach($studentGroups as $student){
                            $certifecate =  new Certificate;
                            $certifecate->file_name = 'Étape de préparation du prototype';
                            $certifecate->project_id = $project->id;
                            $certifecate->save();
                        // }
                    // }
                    // else{
                    //     $certifecate =  new Certificate;
                    //         $certifecate->file_name = 'Étape de préparation du prototype';
                    //         $certifecate->project_id = 0;
                    //         $certifecate->student_id = $student->id;
                    //         $certifecate->save();
                    // }
                }elseif($project->project_tracking == 2){
                    // if(count($studentGroups)){
                        // foreach($studentGroups as $student){
                             $certifecate =  new Certificate;
                             $certifecate->file_name = 'Ecrire un modèle descriptif';
                             $certifecate->project_id = $project->id;
                             $certifecate->save();
                        //  }
                    //  }
                    //  else{
                    //      $certifecate =  new Certificate;
                    //          $certifecate->file_name = 'Ecrire un modèle descriptif';
                    //          $certifecate->project_id = 0;
                    //          $certifecate->student_id = $student->id;
                    //          $certifecate->save();
                    //  }
                }elseif($project->project_tracking == 4){
                    // if(count($studentGroups)){
                        // foreach($studentGroups as $student){
                             $certifecate =  new Certificate;
                             $certifecate->file_name = 'Obtention d\'un certificat d\'enregistrement d\'une demande de brevet';
                             $certifecate->project_id = $project->id;
                             $certifecate->save();
                        //  }
                    //  }
                    //  else{
                    //      $certifecate =  new Certificate;
                    //          $certifecate->file_name = 'Obtention d\'un certificat d\'enregistrement d\'une demande de brevet';
                    //          $certifecate->project_id = 0;
                    //          $certifecate->student_id = $student->id;
                    //          $certifecate->save();
                    //  }
                }elseif($project->project_tracking == 7){
                    // if(count($studentGroups)){
                        // foreach($studentGroups as $student){
                             $certifecate =  new Certificate;
                             $certifecate->file_name = 'Obtention d\'un brevet';
                             $certifecate->project_id = $project->id;
                             $certifecate->save();
                        //  }
                    // }
                    // else{

                    //     $certifecate =  new Certificate;
                    //     $certifecate->file_name = 'Obtention d\'un brevet';
                    //     $certifecate->project_id = 0;
                    //     $certifecate->student_id = $student->id;
                    //     $certifecate->save();
                    // }
                }
            }
        }
        return response()->json(['success' => true, 'message' => 'Tracking updated successfully.']);
    }


    public function administartiveShow($id){
        $project = Project::find($id);

        $administrativeFiles = AdministrativeFiles::where('project_id', $project->id)->get();

        return view('dashboard.project.administrative_tracking', compact('administrativeFiles','project'));
    }

    public function updateStatus(Request $request) {
        $file = AdministrativeFiles::find($request->id);
        $file->status = $request->status;
        $file->save();
        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }


    public function updateSelectedStatus(Request $request){
        $projectIds = $request->input('project_ids', []);
        $status = $request->input('status', 0);

        Project::whereIn('id', $projectIds)->update(['status' => $status]);

        return response()->json(['status' => 'success']);
    }
}


