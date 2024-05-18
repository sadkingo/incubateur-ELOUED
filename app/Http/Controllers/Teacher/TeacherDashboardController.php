<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Student;
use App\Models\StudentGroup;
use Illuminate\Http\Request;
use App\Repositories\Student\StudentRepository;


class TeacherDashboardController extends Controller
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
        $student = $this->students->findNotes(auth('student')->id());
        $allStudents = Student::all();
        return view('teacher-dashboard.index',compact('allStudents'));
    }
    public function projects(){
        
        $projects = Project::all();
        
        return view('teacher-dashboard.projects',compact('projects'));
    }

    public function showProject(Project $project)
    {
        $student = Student::where('id',$project->id_student)->get();
        $projectImages = ProjectImage::where('id_project',$project->id)->get();    
        return view('teacher-dashboard.project-show', compact('student','project','projectImages'));
    }

    public function updateProjectStatus(Request $request)
    {
        $project = Project::find($request->project_id);
        $project->status = $request->status;
        $project->save();
        
        return response()->json([
            'message' => 'Project status updated successfully',
            'status' => $project->status
        ]);
    }

}
