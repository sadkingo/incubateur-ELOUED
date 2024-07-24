<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\AdministrativeFiles;
use App\Models\AdminstrativeFile;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Student;
use App\Models\StudentGroup;
use App\Models\SupervisingTeacher;
use App\Models\SupervisingTeacherProject;
use Illuminate\Http\Request;
use App\Repositories\Student\StudentRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class ProjectController extends Controller
{
    private $students;

    
    /**
     * StudentDashboardController constructor.
     * @param StudentRepository $students
    */

    public function __construct(StudentRepository $students){
        $this->students = $students;
    }

    public function index() {
        $student = $this->students->find(auth('student')->id());
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
    

    public function create()
    {
        //$student = $this->students->find(auth('student')->id());
        
        return view('student-project.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // StoreStudentRequest
    public function store(Request $request){
        $student = $this->students->find(auth('student')->id());
    
        $validator = Validator::make($request->all(), [
            'name_project' => 'required',
            'description' => 'required|max:5000', 
            'project_image.*' => 'required|mimes:png,jpeg,jpg',
            // 'bmc' => 'required|max:10000|mimes:pdf,ppt,pptx', 
            'video' => 'required',    
        ], [
            'name_project.required' => "The name is required",
            'description.required' => 'The description is required',
            'video.max' => 'The video file must be less than 10MB.',
            // 'bmc.max' => 'The BMC file must be less than 10MB.',
            'description.max' => 'The description may not be greater than 5000 characters.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $project = new Project;
        $project->name = $request->input('name_project');
        $project->description = $request->input('description');
        $project->video = $request->input('video');
        // $project->type_project = $request->input('project_type');

        // if ($request->hasFile('video')) {
        //     $video = $request->file('video');
        //     if ($video->getSize() > 10240000) {
        //         return back()->withErrors(['video' => 'The video file must be less than 10MB.'])->withInput();
        //     }
        //     $videoName = time() . '_video.' . $video->getClientOriginalExtension();
        //     $video->storeAs("public/public/projects/videos", $videoName);
        //     
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
        
        $project->id_student = $student->id;
        $project->save();
        if ($request->hasFile('project_image')) {
            foreach ($request->file('project_image') as $img) {
                $validator = Validator::make(['image' => $img], [
                    'image' => 'required|max:1000|mimes:png,jpeg,jpg'
                ]);
        
                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }
        
                $image = new ProjectImage;
                $imageName = time() . '_image.' . $img->getClientOriginalExtension();
                $img->storeAs('public/public/projects/images', $imageName);
                $image->image = $imageName;
                $image->id_project = $project->id;
                $image->save();
            }
        }
        $supervisor = SupervisingTeacher::where('id_student', $student->id)->first();
        if ($supervisor) {
            $supervisorProject = SupervisingTeacherProject::where('id_student', $student->id)
                                                        ->where('id_supervisor', $supervisor->id)
                                                        ->first();
            if ($supervisorProject) {
                $supervisorProject->id_project = $project->id;
                $supervisorProject->save();
            } else {
                $supervisorProject = new SupervisingTeacherProject;
                $supervisorProject->id_student = $student->id;
                $supervisorProject->id_project = $project->id;
               // $supervisorProject->id_supervisor = $supervisor->id;
                $supervisorProject->save();
            }
        } else {
            toastr()->success(trans('message.success.create'));
            toastr()->warning(trans('message.warning.project'));
            return redirect()->route('student.index');
        }
       
        toastr()->success(trans('message.success.create'));
        return redirect()->route('student.index');
    }

    public function edit($id){
        $project = Project::findOrFail($id);
        $images = ProjectImage::where('id_project', $project->id)->get();
       // dd($images);
        return view('student-project.edit', compact('project','images'));
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name_project' => 'required',
            'description' => 'required|max:5000',
            'project_image.*' => 'mimes:png,jpeg,jpg',
            // 'bmc' => 'max:10000|mimes:pdf,ppt,pptx',
            'video' => 'max:10240|mimes:mp4,mov,avi',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $project = Project::findOrFail($id);
        $project->name = $request->input('name_project');
        $project->description = $request->input('description');
        // $project->type_project = $request->input('project_type');


        if ($request->hasFile('video')) {
            $video = $request->file('video');
            if ($video->getSize() > 10240000) {
                return back()->withErrors(['video' => 'The video file must be less than 10MB.'])->withInput();
            }
            $videoName = time() . '_video.' . $video->getClientOriginalExtension();
            $video->storeAs("public/public/projects/videos", $videoName);
            $project->video = $videoName;
        }

        // if ($request->hasFile('bmc')) {
        //     $bmc = $request->file('bmc');
        //     if ($bmc->getSize() > 10000000) {
        //         return back()->withErrors(['bmc' => 'The BMC file must be less than 10MB.'])->withInput();
        //     }
        //     $bmcName = time() . '_bmc.' . $bmc->getClientOriginalExtension();
        //     $bmc->storeAs('public/public/projects/bmc/', $bmcName);
        //     $project->bmc = $bmcName;
        // }

        $project->save();

        if ($request->hasFile('project_image')) {
            foreach ($request->file('project_image') as $img) {
                $imageValidator = Validator::make(['image' => $img], [
                    'image' => 'max:1000|mimes:png,jpeg,jpg'
                ]);

                if ($imageValidator->fails()) {
                    return back()->withErrors($imageValidator)->withInput();
                }

                $image = new ProjectImage;
                $imageName = time() . '_image.' . $img->getClientOriginalExtension();
                $img->storeAs('public/public/projects/images', $imageName);
                $image->image = $imageName;
                $image->id_project = $project->id;
                $image->save();
            }
        }

        toastr()->success(trans('message.success.update'));
        return redirect()->route('student.index');
    }
    public function destroy($id) {
        $project = Project::findOrFail($id);
        
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
    
        toastr()->success(trans('message.success.delete'));
        return redirect()->route('student.index');
    } 
    
    public function addBmcFile($id){
        $project = Project::findOrFail($id);
        return view('student-project.addBmc', compact('project'));
    }
    public function storeBmcFile(Request $request, $id){
        $project = Project::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'bmc' => 'required|max:10000|mimes:pdf,ppt,pptx', 
                
        ], [
            'bmc.max' => 'The BMC file must be less than 10MB.',
            
        ]);

        if ($request->hasFile('bmc')) {
            $bmc = $request->file('bmc');
            if ($bmc->getSize() > 10000000) {
                return back()->withErrors(['bmc' => 'The BMC file must be less than 10MB.'])->withInput();
            }
            $bmcName = time() . '_bmc.' . $bmc->getClientOriginalExtension();
            $bmc->storeAs('public/public/projects/bmc/', $bmcName);
            $project->bmc = $bmcName;
            $project->bmc_status = 1;
            $project->save();
            toastr()->success(trans('message.success.create'));
            return redirect()->route('student.index');            
        }
    }

    public function reformatBmcFile($id){
        
        $project = Project::findOrFail($id);
        
        return view('student-project.reformatBmc', compact('project'));
    }

    public function updateBmcFile(Request $request, $id){
        $project = Project::findOrFail($id);
        
        $request->validate([
            'bmc' => 'required|max:10000|mimes:pdf,ppt,pptx',
        ]);

        if ($project->count() > 0) {
            Storage::delete('public/public/projects/bmc/' . $project->bmc);
        }

        $bmc = $request->file('bmc');
        $bmcName = time() . '_bmc.' . $bmc->getClientOriginalExtension();
        $bmc->storeAs('public/public/projects/bmc/', $bmcName);

        $project->bmc = $bmcName;
        $project->bmc_status = 1; 
        $project->save();

        toastr()->success(trans('message.success.update_bmc'));
        return redirect()->route('student.index');
    }

    public function administrative($id){
        $student = Student::find($id);
        $project = Project::where('id_student', $student->id)->first();
        $studentGroups = StudentGroup::where('id_student', $id)->get();
        $numMembers = $studentGroups->count();
    
        if($project){
            return view('student-project.administrative', compact('project','student', 'studentGroups', 'numMembers'));
        }
    }

    public function storeAdministrative(Request $request, $id){
        $student = Student::find($id);
        if ($student) {
            
            $studentGroups = StudentGroup::where('id_student', $student->id)->get();
            $admineFile = AdministrativeFiles::where('student_id', $student->id)->get();
            if ($admineFile->isNotEmpty()) {
                foreach ($admineFile as $file) {
                    if (Storage::exists('public/public/projects/administrative/registrations_certificates/' . $file->registration_certificate)) {
                        Storage::delete('public/public/projects/administrative/registrations_certificates/' . $file->registration_certificate);
                    }
                    if (Storage::exists('public/public/projects/administrative/identifications_cards/' . $file->identification_card)) {
                        Storage::delete('public/public/projects/administrative/identifications_cards/' . $file->identification_card);
                    }
                    if (Storage::exists('public/public/projects/administrative/photos/' . $file->photo)) {
                        Storage::delete('public/public/projects/administrative/photos/' . $file->photo);
                    }
                    $file->delete();
                }
            }
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
    
            $adminstrative = new AdministrativeFiles;
            $adminstrative->student_id = $student->id;
            $adminstrative->student_group_id = 0; 
    
            if ($request->hasFile('registration_certificate.0')) {
                $adminstrativeRgstCertificate = $request->file('registration_certificate.0');
                $adminstrativeRgstCertificateName = time() . '_registration_certificate_0.' . $adminstrativeRgstCertificate->getClientOriginalExtension();
                $adminstrativeRgstCertificate->storeAs('public/public/projects/administrative/registrations_certificates', $adminstrativeRgstCertificateName);
                $adminstrative->registration_certificate = $adminstrativeRgstCertificateName;
            }
            if ($request->hasFile('identification_card.0')) {
                $adminstrativeIdCart = $request->file('identification_card.0');
                $adminstrativeIdCartName = time() . '_identification_card_0.' . $adminstrativeIdCart->getClientOriginalExtension();
                $adminstrativeIdCart->storeAs('public/public/projects/administrative/identifications_cards', $adminstrativeIdCartName);
                $adminstrative->identification_card = $adminstrativeIdCartName;
            }
            if ($request->hasFile('photo.0')) {
                $adminstrativePhoto = $request->file('photo.0');
                $adminstrativePhotoName = time() . '_photo_0.' . $adminstrativePhoto->getClientOriginalExtension();
                $adminstrativePhoto->storeAs('public/public/projects/administrative/photos', $adminstrativePhotoName);
                $adminstrative->photo = $adminstrativePhotoName;
            }
            $adminstrative->save();
    
            foreach ($studentGroups as $index => $studentGroup) {
                $adminstrative = new AdministrativeFiles;
                if ($request->hasFile('registration_certificate.' . ($index + 1))) {
                    $adminstrativeRgstCertificate = $request->file('registration_certificate.' . ($index + 1));
                    $adminstrativeRgstCertificateName = time() . '_registration_certificate_' . ($index + 1) . '.' . $adminstrativeRgstCertificate->getClientOriginalExtension();
                    $adminstrativeRgstCertificate->storeAs('public/public/projects/administrative/registrations_certificates', $adminstrativeRgstCertificateName);
                    $adminstrative->registration_certificate = $adminstrativeRgstCertificateName;
                }
                if ($request->hasFile('identification_card.' . ($index + 1))) {
                    $adminstrativeIdCart = $request->file('identification_card.' . ($index + 1));
                    $adminstrativeIdCartName = time() . '_identification_card_' . ($index + 1) . '.' . $adminstrativeIdCart->getClientOriginalExtension();
                    $adminstrativeIdCart->storeAs('public/public/projects/administrative/identifications_cards', $adminstrativeIdCartName);
                    $adminstrative->identification_card = $adminstrativeIdCartName;
                }
                if ($request->hasFile('photo.' . ($index + 1))) {
                    $adminstrativePhoto = $request->file('photo.' . ($index + 1));
                    $adminstrativePhotoName = time() . '_photo_' . ($index + 1) . '.' . $adminstrativePhoto->getClientOriginalExtension();
                    $adminstrativePhoto->storeAs('public/public/projects/administrative/photos', $adminstrativePhotoName);
                    $adminstrative->photo = $adminstrativePhotoName;
                }
                $adminstrative->student_id = $student->id;
                $adminstrative->student_group_id = $studentGroup->id; 
                $adminstrative->save();
            }
            toastr()->success(trans('message.success.create'));
            return redirect()->route('student.index');
        }
    }
    
   
   
    public function editStatusBmc($id){

        $project = Project::find($id);

        return view('dashboard.project.edit_status_bmc',compact('project'));
    }

    public function storeStatusBmc(Request $request, $id){
        $project = Project::find($id);

        if($project){
            $validator = Validator::make($request->all(), [
                'bmc_status' => 'required', 
                    
            ], [
                'bmc_status.required' => 'The status bmc file is required.',
                
            ]);

            $project->bmc_status = $request->input('bmc_status');
            $project->save();
            toastr()->success(trans('message.success.update_bmc'));
            return redirect('dashboard/projet');

        }
    }
   
}
