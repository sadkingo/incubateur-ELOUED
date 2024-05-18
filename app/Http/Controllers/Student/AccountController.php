<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Student\StudentRepository;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Models\StudentGroup;

class AccountController extends Controller
{
    private $students;

    /**
     * AccountController constructor.
     * @param StudentRepository $students
     */
    public function __construct(StudentRepository $students)
    {
        $this->students = $students;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = $this->students->find(auth('student')->id());
        $studentGroups= StudentGroup::where('id_student', $student->id)->get();
        
        return view('student-dashboard.profile',compact('student','studentGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student-dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $student = $this->students->find(auth('student')->id());
        
        $request->validate([
            'inputs.*.firstname_ar' => 'required',
            'inputs.*.lastname_ar'  => 'required',
            'inputs.*.firstname_fr' => 'required',
            'inputs.*.lastname_fr'  => 'required',
            'inputs.*.gender'       => 'required',
            'inputs.*.birthday'     => 'required',
        ],[
            'inputs.*.firstname_ar' => 'First name arabic is required',
            'inputs.*.lastname_ar'  => 'Last name arabic is required',
            'inputs.*.firstname_fr' => 'First name fr is required',
            'inputs.*.lastname_fr' => 'First name fr is required',
            'inputs.*.gender' => 'Gender is required',
            'inputs.*.birthday' => 'Date of birthday is required',
        ]);

        foreach($request->inputs as $key => $value){
            $studentGroupe = new StudentGroup;
            $studentGroupe->firstname_fr = $value['firstname_fr'];
            $studentGroupe->firstname_ar = $value['firstname_ar'];
            $studentGroupe->lastname_fr = $value['lastname_fr'];
            $studentGroupe->lastname_ar = $value['lastname_ar'];
            $studentGroupe->birthday = $value['birthday'];
            $studentGroupe->gender = $value['gender'];
            $studentGroupe->id_student = $student->id;
            $studentGroupe->save();
        }
        toastr()->success(trans('message.success.create'));
        return redirect()->route('student.index');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    // public function update(UpdateStudentRequest $request)
    {
        $this->students->update($request->id,$request->all());
        toastr()->success(trans('message.success.update'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
