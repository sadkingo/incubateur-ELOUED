<?php

namespace App\Http\Controllers\Student;

use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\StudentGroup;
class StudentDashboardController extends Controller {


    public function index() {
      return redirect()->route('dashboard.projects');
        // $account = $this->students->findNotes(auth('student')->id());
        // $evaluationExists = Evaluation::whereStudentId(auth('student')->id())->first();
        // $studentGroups= StudentGroup::where('id_student', $account->id)->get();
        // $project = Project::where('id_student',$account->id)->first();

        // return view('student-dashboard.index',compact('account','evaluationExists','studentGroups','project'));
    }

  //   public function indexAdmin($id){

  //     $account = $this->students->findNotes($id);
  //     $evaluationExists = Evaluation::whereStudentId($id)->first();
  //     return view('student-dashboard.index',compact('account','evaluationExists'));
  // }

    // public function store(){
    //     return view('student-dashboard.create');
    // }
    // public function account(){
    //     $student = $this->students->find(auth('student')->id());
    //     return view('student-dashboard.profile',compact('student'));
    // }
}
