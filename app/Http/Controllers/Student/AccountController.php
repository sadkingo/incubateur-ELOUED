<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Student\StudentRepository;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Models\Departement;
use App\Models\Faculty;
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
        $faculties = Faculty::all();
        $departments = Departement::all();
        return view('student-dashboard.create' ,compact('faculties', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $student = $this->students->find(auth('student')->id());
    //dd($request);
        $request->validate([
            'inputs.*.firstname_ar' => ['required', 'regex:/^[\p{Arabic}\s]+$/u'],
            'inputs.*.lastname_ar'  => ['required', 'regex:/^[\p{Arabic}\s]+$/u'],
            'inputs.*.firstname_fr' => 'required',
            'inputs.*.lastname_fr'  => 'required',
            'inputs.*.gender'       => 'required',
            'inputs.*.birthday'     => 'required',
            'inputs.*.place_of_birth' => 'required',
            'inputs.*.registration_number' => 'required|numeric',
            'inputs.*.academicLevel' => 'required',
            'inputs.*.specialty' => 'required',
            'inputs.*.id_faculty' => 'required',
            'inputs.*.id_department' => 'required',
            ],[
                'inputs.*.firstname_ar.required' => 'First name arabic is required',
                'inputs.*.firstname_ar.regex' => 'First name arabic must be in Arabic letters only',
                'inputs.*.lastname_ar.required'  => 'Last name arabic is required',
                'inputs.*.lastname_ar.regex' => 'Last name arabic must be in Arabic letters only',
                'inputs.*.firstname_fr' => 'First name fr is required',
                'inputs.*.lastname_fr' => 'Last name fr is required',
                'inputs.*.gender' => 'Gender is required',
                'inputs.*.birthday' => 'Date of birthday is required',
                'inputs.*.place_of_birth' => 'Place of birthday is required',
                'inputs.*.registration_number' => 'Registration number is required',
                'inputs.*.academicLevel' => 'Academic level is required',
                'inputs.*.specialty' => 'Specialty is required',
                'inputs.*.id_faculty' => 'Faculty is required',
                'inputs.*.id_department' => 'Department is required',
        ]);

        foreach($request->inputs as $key => $value){
            $studentGroupe = new StudentGroup;
            $studentGroupe->firstname_fr = $value['firstname_fr'];
            $studentGroupe->firstname_ar = $value['firstname_ar'];
            $studentGroupe->lastname_fr = $value['lastname_fr'];
            $studentGroupe->lastname_ar = $value['lastname_ar'];
            $studentGroupe->birthday = $value['birthday'];
            $studentGroupe->gender = $value['gender'];
            $studentGroupe->state_of_birth = $value['place_of_birth'];
            $studentGroupe->registration_number  = $value['registration_number'];
            $studentGroupe->academicLevel  = $value['academicLevel'];
            $studentGroupe->specialty  = $value['specialty'];
            $studentGroupe->id_faculty  = $value['id_faculty'];
            $studentGroupe->id_department  = $value['id_department'];
            $studentGroupe->id_student = $student->id;
            $studentGroupe->save();
        }
        toastr()->success(trans('message.success.create'));
        return redirect()->route('student.index');
    }
    

    public function edit($id){
        $studentGroup = StudentGroup::findOrFail($id);
        return view('student-dashboard.edit', compact('studentGroup'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'firstname_ar' => ['required', 'regex:/^[\p{Arabic}\s]+$/u'],
            'lastname_ar'  => ['required', 'regex:/^[\p{Arabic}\s]+$/u'],
            'firstname_fr' => 'required',
            'lastname_fr'  => 'required',
            'gender'       => 'required',
            'birthday'     => 'required',
        ], [
            'firstname_ar.required' => 'First name arabic is required',
            'firstname_ar.regex' => 'First name arabic must be in Arabic letters only',
            'lastname_ar.required'  => 'Last name arabic is required',
            'lastname_ar.regex' => 'Last name arabic must be in Arabic letters only',
            'firstname_fr.required' => 'First name fr is required',
            'lastname_fr.required' => 'Last name fr is required',
            'gender.required' => 'Gender is required',
            'birthday.required' => 'Date of birthday is required',
        ]);
    
        $studentGroup = StudentGroup::findOrFail($id);
        $studentGroup->update($request->all());
    
        toastr()->success(trans('message.success.update'));
        return redirect()->route('student.index');
    }
    

    public function destroy($id){
        $studentGroup = StudentGroup::findOrFail($id);
        $studentGroup->delete();

        toastr()->success(trans('message.success.delete'));
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
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request)
    // // public function update(UpdateStudentRequest $request)
    // {
    //     $this->students->update($request->id,$request->all());
    //     toastr()->success(trans('message.success.update'));
    //     return redirect()->back();
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }
}
