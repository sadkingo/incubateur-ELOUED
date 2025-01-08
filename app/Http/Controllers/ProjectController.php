<?php

namespace App\Http\Controllers;

use App\Exports\ProjectsExport;
use App\Http\Controllers\Controller;
use App\Models\AdministrativeFiles;
use App\Models\Departement;
use App\Models\Manager;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Student;
use App\Models\StudentGroup;
use App\Models\SupervisingTeacher;
use App\Models\SupervisingTeacherGroups;
use App\Models\SupervisingTeacherProject;
use App\Repositories\Student\StudentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;


class ProjectController extends Controller {

    public function index() {
        $student = Student::find(auth('student')->id());
        $projects = Project::where('id_student', $student->id)->get();
        $administrative = AdministrativeFiles::where('student_id', $student->id)->get();

        if ($administrative->isEmpty()) {
            $statusAdministrative = null;
            $multipleRecords = false;
        } else {
            if ($administrative->count() == 1) {
                $statusAdministrative = $administrative->first();

                $multipleRecords = false;
            } else {
                $statusAdministrative = $administrative;

                $multipleRecords = true;
            }
        }

        return view('student-project.index', compact('projects', 'student', 'statusAdministrative', 'multipleRecords'));
    }

    public function create() {
        $supervisors = SupervisingTeacher::all();
        return view('dashboard.project.create')
        ->with('supervisors',$supervisors);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name_project' => 'required',
            'description' => 'required|max:500',
            'pitch_deck' => 'required|mimes:pptx',
            // 'video' => 'nullable|mimes:mp4,mov,avi',
            'group-a' => 'required|array|min:1',
            'group-a.*.registerd_id' => 'required', 
            'group-b' => 'required|array|min:1',
            'group-b.*.supervisor_id' => 'required',
            'group-b.*.supervisor_role' => 'required|string',
        ], [
            'name_project.required' => "The name is required",
            'pitch_deck.required' => "The Pitch Deck File is required",
            'pitch_deck.mimes' => 'The pitch deck must be a .pptx file.',
            'description.required' => 'The description is required',
            // 'video.max' => 'The video file must be less than 10MB.',
            'description.max' => 'The description may not be greater than 500 characters.',
            'group-a.required' => 'You must include at least one student in group-a.',
            'group-a.min' => 'Group-a must contain at least one student.',
            'group-a.*.registerd_id.required' => 'Each student in group-a must have a registered ID.',
            'group-b.required' => 'You must include at least one supervisor in group-b.',
            'group-b.min' => 'Group-b must contain at least one supervisor.',
            'group-b.*.supervisor_id.required' => 'Each supervisor in group-b must have an ID.',
            'group-b.*.supervisor_role.required' => 'Each supervisor in group-b must have a role.',    
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $manager = Manager::find(auth('manager')->id());

        // Extract and count unique registered IDs in 'group-a'
        $registeredIds = array_column($request->input('group-a'), 'registerd_id');
        $uniqueRegisteredIds = array_unique($registeredIds);
        $uniqueCount = count($uniqueRegisteredIds);

        $project = new Project;
        $project->name = $request->input('name_project');
        $project->description = $request->input('description');
        $project->video = $request->input('video');

        $currentYear = now()->format('Y');

        $count = $this->getProjectsCount();

        // Set the full code with the year and formatted count
        $project->password = $currentYear . $uniqueCount . $count;
        $project->code = $currentYear . $uniqueCount . $count;

        $project->faculty_id = $manager->faculty_id;

        foreach ($request->input('group-a') as $studentData) {
            $registrationNumber = $studentData['registerd_id'];

            // $isStudent = Student::where('id_faculty', auth('manager')->user()->faculty_id)->where('registration_number', $registrationNumber)->first();
            $isStudent = Student::where('registration_number', $registrationNumber)->first();

            if ($isStudent) {
                $isExist = StudentGroup::where('project_id', $project->id)->where('student_id', $isStudent->id)->first();
                if ($isExist) {
                    continue;
                }

                $newStudentGroupItem = new StudentGroup();
                $newStudentGroupItem->project_id = $project->id;
                $newStudentGroupItem->student_id = $isStudent->id;
                $newStudentGroupItem->save();
            }
        }

        foreach ($request->input('group-b') as $supervisorData) {
            $supervisorId = $supervisorData['supervisor_id'];

            $isSupervisingTeacher = SupervisingTeacher::find($supervisorId);

            if ($isSupervisingTeacher) {
                $isExist = SupervisingTeacherGroups::where('project_id', $project->id)->where('supervising_teacher_id', $isSupervisingTeacher->id)->first();
                if ($isExist) {
                    continue;
                }

                $newSupervisingGroupItem = new SupervisingTeacherGroups();
                $newSupervisingGroupItem->project_id = $project->id;
                $newSupervisingGroupItem->supervising_teacher_id = $isSupervisingTeacher->id;
                $newSupervisingGroupItem->role = $supervisorData['supervisor_role'];
                $newSupervisingGroupItem->save();
            }
        }

        if ($request->hasFile('pitch_deck')) {
            $pitchDeckName = time() . '_pitch_deck.' . $request->file('pitch_deck')->getClientOriginalExtension();
            $request->file('pitch_deck')->storeAs('public/public/projects/pitch_deck', $pitchDeckName);
            $project->pitch_deck = $pitchDeckName;
        }

        $project->save();

        // if ($request->hasFile('project_image')) {
        //     foreach ($request->file('project_image') as $img) {
        //         $validator = Validator::make(['image' => $img], [
        //             'image' => 'required|max:1000|mimes:png,jpeg,jpg'
        //         ]);

        //         if ($validator->fails()) {
        //             return back()->withErrors($validator)->withInput();
        //         }

        //         $image = new ProjectImage;
        //         $imageName = time() . '_image.' . $img->getClientOriginalExtension();
        //         $img->storeAs('public/public/projects/images', $imageName);
        //         $image->image = $imageName;
        //         $image->id_project = $project->id;
        //         $image->save();
        //     }
        // }

        toastr()->success(trans('message.success.create'));
        return redirect()->route('dashboard.projects');
        // return redirect()->route('student.index');
    }

    public function edit($id){
        $project = Project::findOrFail($id);
        $images = ProjectImage::where('id_project', $project->id)->get();
        $students = StudentGroup::where('project_id', $project->id)->get();
        $allSupervisors = SupervisingTeacherGroups::where('project_id', $project->id)->get();
        $supervisors = SupervisingTeacher::all();
        return view('dashboard.project.index')
        ->with('project', $project)
        ->with('students', $students)
        ->with('allSupervisors', $allSupervisors)
        ->with('supervisors', $supervisors)
        ->with('images', $images);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name_project' => 'required',
            'description' => 'required|max:500',
            // 'project_image.*' => 'mimes:png,jpeg,jpg',
            'pitch_deck' => 'nullable|mimes:pptx',
            // 'video' => 'nullable|mimes:mp4,mov,avi',
            'group-a' => 'required|array|min:1',
            'group-a.*.registerd_id' => 'required', 
            'group-b' => 'required|array|min:1',
            'group-b.*.supervisor_id' => 'required',
            'group-b.*.supervisor_role' => 'required|string',

            
        ], [
            'name_project.required' => "The name is required",
            'description.required' => 'The description is required',
            'description.max' => 'The description may not be greater than 500 characters.',
            'pitch_deck.mimes' => 'The pitch deck must be a .pptx file.',
            'group-a.required' => 'You must include at least one student in group-a.',
            'group-a.min' => 'Group-a must contain at least one student.',
            'group-a.*.registerd_id.required' => 'Each student in group-a must have a registered ID.',
            'group-b.required' => 'You must include at least one supervisor in group-b.',
            'group-b.min' => 'Group-b must contain at least one supervisor.',
            'group-b.*.supervisor_id.required' => 'Each supervisor in group-b must have an ID.',
            'group-b.*.supervisor_role.required' => 'Each supervisor in group-b must have a role.',    
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $project = Project::findOrFail($id);
        $project->name = $request->input('name_project');
        $project->description = $request->input('description');
        $project->video = $request->input('video');

        // if ($request->hasFile('video')) {
        //     $video = $request->file('video');
        //     if ($video->getSize() > 10240000) {
        //         return back()->withErrors(['video' => 'The video file must be less than 10MB.'])->withInput();
        //     }
        //     $videoName = time() . '_video.' . $video->getClientOriginalExtension();
        //     $video->storeAs("public/public/projects/videos", $videoName);
        //     $project->video = $videoName;
        // }

        // if ($request->hasFile('bmc')) {
        //     $bmc = $request->file('bmc');
        //     if ($bmc->getSize() > 10000000) {
        //         return back()->withErrors(['bmc' => 'The BMC file must be less than 10MB.'])->withInput();
        //     }
        //     $bmcName = time() . '_bmc.' . $bmc->getClientOriginalExtension();
        //     $bmc->storeAs('public/public/projects/bmc/', $bmcName);
        //     $project->bmc = $bmcName;
        // }

        $project->studentGroups()->delete();
        $project->supervisingGroups()->delete();

        foreach ($request->input('group-a') as $studentData) {
            $registrationNumber = $studentData['registerd_id'];

            $isStudent = Student::where('registration_number', $registrationNumber)->first();
            if ($isStudent) {
                $isExist = StudentGroup::where('project_id', $project->id)->where('student_id', $isStudent->id)->first();
                if ($isExist) {
                    continue;
                }
                $newStudentGroup = new StudentGroup();
                $newStudentGroup->project_id = $project->id;
                $newStudentGroup->student_id = $isStudent->id;
                $newStudentGroup->save();
            }
        }

        foreach ($request->input('group-b') as $supervisorData) {
            $registrationNumber = $supervisorData['supervisor_id'];

            $isSupervisingTeacher = SupervisingTeacher::find($registrationNumber);

            if ($isSupervisingTeacher) {
                $isExist = SupervisingTeacherGroups::where('project_id', $project->id)->where('supervising_teacher_id', $isSupervisingTeacher->id)->first();
                if ($isExist) {
                    continue;
                }
                // Create a new StudentGroup record
                $newStudentGroup = new SupervisingTeacherGroups();
                $newStudentGroup->project_id = $project->id;
                $newStudentGroup->supervising_teacher_id = $isSupervisingTeacher->id;
                $newStudentGroup->role = $supervisorData['supervisor_role'];
                $newStudentGroup->save();
            }
        }

        // if ($request->hasFile('project_image')) {
        //     foreach ($request->file('project_image') as $img) {
        //         $imageValidator = Validator::make(['image' => $img], [
        //             'image' => 'max:1000|mimes:png,jpeg,jpg'
        //         ]);

        //         if ($imageValidator->fails()) {
        //             return back()->withErrors($imageValidator)->withInput();
        //         }

        //         $image = new ProjectImage;
        //         $imageName = time() . '_image.' . $img->getClientOriginalExtension();
        //         $img->storeAs('public/public/projects/images', $imageName);
        //         $image->image = $imageName;
        //         $image->id_project = $project->id;
        //         $image->save();
        //     }
        // }

        if ($request->hasFile('pitch_deck')) {
            $pitchDeckName = time() . '_pitch_deck.' . $request->file('pitch_deck')->getClientOriginalExtension();
            $request->file('pitch_deck')->storeAs('public/public/projects/pitch_deck', $pitchDeckName);
            $project->pitch_deck = $pitchDeckName;
        }

        $project->save();

        toastr()->success(trans('message.success.update'));
        return redirect()->route('dashboard.projects');
    }

    public function destroy($id) {
        $project = Project::withTrashed()->findOrFail($id);

        if ($project->trashed()) {
            $project->forceDelete();
        } else {
            if ($project->video) {
                Storage::delete('public/projects/videos/' . $project->video);
            }
            
            if ($project->bmc) {
                Storage::delete('public/projects/bmc/' . $project->bmc);
            }
            
            $images = ProjectImage::where('id_project', $project->id)->get();
            foreach ($images as $img) {
                Storage::delete('public/projects/images/' . $img->image);
                $img->delete();
            }
            $project->delete();
        }


        return response()->json([
            'icon' => 'success',
            'state' => __("Success"),
            'message' => __("Project Deleted Successfully.")
        ]);
    }

    public function archive($id) {
        $project = Project::findOrFail($id);
        if ($project->archived == '0') {
            $project->archived = '1';
            $project->save();
            return response()->json([
                'icon' => 'success',
                'state' => __("Success"),
                'message' => __("Project Archived Successfully.")
            ]);
        } else {
            $project->archived = '0';
            $project->save();
            return response()->json([
                'icon' => 'success',
                'state' => __("Success"),
                'message' => __("Project Restored Successfully.")
            ]);
        }

        return response()->json([
            'icon' => 'success',
            'state' => __("Success"),
            'message' => __("Project Archived Successfully.")
        ]);
    }

    public function restore($id) {
        $project = Project::withTrashed()->findOrFail($id);
        $project->restore();

        return response()->json([
            'icon' => 'success',
            'state' => __("Success"),
            'message' => __("Project Restored Successfully.")
        ]);
    }

    // public function addBmcFile($id){
    //     $project = Project::findOrFail($id);
    //     return view('student-project.addBmc', compact('project'));
    // }

    public function storeBmcFile(Request $request){
        $validator = Validator::make($request->all(), [
            'bmc' => 'required|mimes:pdf,ppt,pptx',
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

            if ($request->hasFile('bmc')) {
                $bmc = $request->file('bmc');
                $bmcName = time() . '_bmc.' . $bmc->getClientOriginalExtension();
                $bmc->storeAs('public/public/projects/bmc/', $bmcName);
                $project->bmc = $bmcName;
                $project->bmc_status = 1;
                $project->save();
                return response()->json([
                    'icon' => 'success',
                    'state' => __("Success"),
                    'message' => __("Bmc File Uploaded Successfully.")
                ]);
    
            }
            return response()->json([
                'icon' => 'success',
                'state' => __("Success"),
                'message' => __("There Is No Bmc File.")
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'state' => __("Error"),
                'message' => $e->getMessage()
            ]);
        }

    }

    // public function reformatBmcFile($id){

    //     $project = Project::findOrFail($id);

    //     return view('student-project.reformatBmc', compact('project'));
    // }

    public function updateBmcFile(Request $request){
        $validator = Validator::make($request->all(), [
            'bmc' => 'required|mimes:pdf,ppt,pptx',
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
            if ($request->hasFile('bmc')) {

                if ($project->bmc && Storage::exists('public/projects/bmc/' . $project->bmc)) {
                    Storage::delete('public/projects/bmc/' . $project->bmc);
                }

                $bmc = $request->file('bmc');
                $bmcName = time() . '_bmc.' . $bmc->getClientOriginalExtension();
                $bmc->storeAs('public/public/projects/bmc/', $bmcName);

                $project->bmc = $bmcName;
                $project->bmc_status = 1;
                $project->save();

                return response()->json([
                    'icon' => 'success',
                    'state' => __("Success"),
                    'message' => __("Bmc File Uploaded Successfully.")
                ]);
            }

            return response()->json([
                'icon' => 'success',
                'state' => __("Success"),
                'message' => __("There Is No Bmc File.")
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'state' => __("Error"),
                'message' => $e->getMessage()
            ]);
        }
    }

    public function administrative($id){
        $project = Project::find($id);
        $group = StudentGroup::where('project_id',$project->id)->get();

        return view('dashboard.project.administrative')
        ->with('project',$project)
        ->with('group',$group);
    }

    public function storeAdministrative(Request $request, $id){
        $project =  Project::find($id);
        // $student = Student::find($id);
        if ($project) {
          // if ($student) {

            $studentGroups = StudentGroup::where('project_id', $project->id)->get();
            // $admineFile = AdministrativeFiles::where('project_id', $project->id)->get();
            // if ($admineFile->isNotEmpty()) {
            //     foreach ($admineFile as $file) {
            //         if (Storage::exists('public/public/projects/administrative/registrations_certificates/' . $file->registration_certificate)) {
            //             Storage::delete('public/public/projects/administrative/registrations_certificates/' . $file->registration_certificate);
            //         }
            //         if (Storage::exists('public/public/projects/administrative/identifications_cards/' . $file->identification_card)) {
            //             Storage::delete('public/public/projects/administrative/identifications_cards/' . $file->identification_card);
            //         }
            //         if (Storage::exists('public/public/projects/administrative/photos/' . $file->photo)) {
            //             Storage::delete('public/public/projects/administrative/photos/' . $file->photo);
            //         }
            //         $file->delete();
            //     }
            // }
            $validator = Validator::make($request->all(), [
                'registration_certificate.*' => 'required|file|mimes:pdf,jpg,png',
                'identification_card.*' => 'required|file|mimes:pdf,jpg,png',
                'photo.*' => 'required|file|mimes:jpg,png',
            ], [
                'registration_certificate.*.required' => 'The registration certificate is required.',
                'identification_card.*.required' => 'The identification card is required.',
                'photo.*.required' => 'The photo is required.',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // $adminstrative = new AdministrativeFiles;
            // $adminstrative->project_id = $project->id;
            // // $adminstrative->student_id = $student->id;

            // if ($request->hasFile('registration_certificate.0')) {
            //     $adminstrativeRgstCertificate = $request->file('registration_certificate.0');
            //     $adminstrativeRgstCertificateName = time() . '_registration_certificate_0.' . $adminstrativeRgstCertificate->getClientOriginalExtension();
            //     $adminstrativeRgstCertificate->storeAs('public/public/projects/administrative/registrations_certificates', $adminstrativeRgstCertificateName);
            //     $adminstrative->registration_certificate = $adminstrativeRgstCertificateName;
            // }
            // if ($request->hasFile('identification_card.0')) {
            //     $adminstrativeIdCart = $request->file('identification_card.0');
            //     $adminstrativeIdCartName = time() . '_identification_card_0.' . $adminstrativeIdCart->getClientOriginalExtension();
            //     $adminstrativeIdCart->storeAs('public/public/projects/administrative/identifications_cards', $adminstrativeIdCartName);
            //     $adminstrative->identification_card = $adminstrativeIdCartName;
            // }
            // if ($request->hasFile('photo.0')) {
            //     $adminstrativePhoto = $request->file('photo.0');
            //     $adminstrativePhotoName = time() . '_photo_0.' . $adminstrativePhoto->getClientOriginalExtension();
            //     $adminstrativePhoto->storeAs('public/public/projects/administrative/photos', $adminstrativePhotoName);
            //     $adminstrative->photo = $adminstrativePhotoName;
            // }
            // $adminstrative->save();

            foreach ($studentGroups as $index => $studentGroup) {
                $adminstrative = new AdministrativeFiles;
                if ($request->hasFile('registration_certificate.' . ($index))) {
                    $adminstrativeRgstCertificate = $request->file('registration_certificate.' . ($index));
                    $adminstrativeRgstCertificateName = time() . '_registration_certificate_' . ($index) . '.' . $adminstrativeRgstCertificate->getClientOriginalExtension();
                    $adminstrativeRgstCertificate->storeAs('public/public/projects/administrative/registrations_certificates', $adminstrativeRgstCertificateName);
                    $adminstrative->registration_certificate = $adminstrativeRgstCertificateName;
                }
                if ($request->hasFile('identification_card.' . ($index))) {
                    $adminstrativeIdCart = $request->file('identification_card.' . ($index));
                    $adminstrativeIdCartName = time() . '_identification_card_' . ($index) . '.' . $adminstrativeIdCart->getClientOriginalExtension();
                    $adminstrativeIdCart->storeAs('public/public/projects/administrative/identifications_cards', $adminstrativeIdCartName);
                    $adminstrative->identification_card = $adminstrativeIdCartName;
                }
                if ($request->hasFile('photo.' . ($index))) {
                    $adminstrativePhoto = $request->file('photo.' . ($index));
                    $adminstrativePhotoName = time() . '_photo_' . ($index) . '.' . $adminstrativePhoto->getClientOriginalExtension();
                    $adminstrativePhoto->storeAs('public/public/projects/administrative/photos', $adminstrativePhotoName);
                    $adminstrative->photo = $adminstrativePhotoName;
                }
                $adminstrative->student_id = $studentGroup->student->id;
                $adminstrative->project_id = $project->id;
                $adminstrative->save();
            }
            toastr()->success(trans('message.success.create'));
            // return redirect()->route('student.index');
            return redirect()->route('manager.index');

        }
        toastr()->warning(trans('message.warning.project'));

    }

    // public function editStatusBmc($id){

    //     $project = Project::find($id);

    //     return view('dashboard.project.edit_status_bmc',compact('project'));
    // }

    public function storeStatusBmc(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'bmc_status' => 'required|in:1,2,3',
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
            $project->bmc_status = $request->bmc_status;
            $project->save();

            return response()->json([
                'icon' => 'success',
                'state' => __("Success"),
                'message' => __("Bmc Status Successfully.")
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'state' => __("Error"),
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getDepartments($facultyId){
        $departments = Departement::where('id_faculty', $facultyId)->get();
        return response()->json($departments);
    }

    public function export(Request $request) {
        $status = $request->query('status');
        $archived = $request->query('archived');
        
        $query = Project::query();
        if ($status !== null) {
            $query->where('status', $status)
            ->where('archived', $archived);
        } else {
            $query->where('archived', $archived);
        }
        $projects = $query->get();

        return Excel::download(new ProjectsExport($projects), 'projects.xlsx');
    }

    

    public function archiveProjects(Request $request){
        $projectIds = $request->input('project_ids', []);
        foreach ($projectIds as $projectId) {
            $project = Project::find($projectId);
            if ($project->archived == '0') {
                $project->archived = '1';
                $project->save();
            } else {
                $project->archived = '0';
                $project->save();
            }
        }

        return response()->json(['status' => 'success']);
    }
}
