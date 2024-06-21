<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use App\Repositories\Student\StudentRepository;
use Illuminate\Support\Facades\Validator;


class ProjectController extends Controller
{
    private $students;

    
    /**
     * StudentDashboardController constructor.
     * @param StudentRepository $students
    */

    public function __construct(StudentRepository $students)
    {
        $this->students = $students;
    }

    public function index(){
        $student = $this->students->find(auth('student')->id());
       
        $projects = Project::where('id_student', $student->id)->get(); 
      //  dd($projects);
        return view('student-project.index',compact('projects'));
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
            'bmc' => 'required|max:10000|mimes:pdf,ppt,pptx', 
            'video' => 'required|max:10240|mimes:mp4,mov,avi',
            'project_type' =>'required' 
        ], [
            'name_project.required' => "The name is required",
            'description.required' => 'The description is required',
            'project_type.required' => 'The project type is requires',
            'video.max' => 'The video file must be less than 10MB.',
            'bmc.max' => 'The BMC file must be less than 10MB.',
            'description.max' => 'The description may not be greater than 5000 characters.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $project = new Project;
        $project->name = $request->input('name_project');
        $project->description = $request->input('description');
        $project->type_project = $request->input('project_type');
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            if ($video->getSize() > 10240000) {
                return back()->withErrors(['video' => 'The video file must be less than 10MB.'])->withInput();
            }
            $videoName = time() . '_video.' . $video->getClientOriginalExtension();
            $video->storeAs("public/public/projects/videos", $videoName);
            $project->video = $videoName;
        }

        if ($request->hasFile('bmc')) {
            $bmc = $request->file('bmc');
            if ($bmc->getSize() > 10000000) {
                return back()->withErrors(['bmc' => 'The BMC file must be less than 10MB.'])->withInput();
            }
            $bmcName = time() . '_bmc.' . $bmc->getClientOriginalExtension();
            $bmc->storeAs('public/public/projects/bmc/', $bmcName);
            $project->bmc = $bmcName;
        }
        
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

        toastr()->success(trans('message.success.create'));
        return redirect()->route('student.index');
    }


}
