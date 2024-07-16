<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Traits\DaysTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Repositories\Student\StudentRepository;
use App\Http\Requests\Auth\RegisterStudentRequest;
use App\Models\Departement;
use App\Models\Faculty;
use App\Repositories\Attendence\AttendenceRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class RegisterController extends Controller
{
    use DaysTrait;
    private $students;
    private $attendences;

    /**
     * RegisterController constructor.
     * @param StudentRepository $students
     * @param AttendenceRepository $attendences
     */
    public function __construct(StudentRepository $students, AttendenceRepository $attendences)
    {
        $this->students = $students;
        $this->attendences = $attendences;
    }

    public function registerForm()
    {
        $faculties = Faculty::all();
        $departments = Departement::all();
        return view('auth.student.register', compact('faculties', 'departments'));
    }

    public function register(RegisterStudentRequest $request){        
       $data = $request->all();
       if ($request->hasFile('photo')) {
        $image = $request->file('photo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('public/projects/profile/', $imageName); 
        $data['photo'] = $imageName; 
    }
    
       $student = $this->students->create($data);
        $startDate = Carbon::parse($student->start_date);
        $endDate = Carbon::parse($student->end_date);
        $allDays = $this->getDaysFromSundayToThursdays($startDate, $endDate);
        foreach ($allDays['days'] as $key => $day) {
            $data = [
                'day' => $day+1,
                'week' =>$allDays['weeks'][$key],
                'month' =>$allDays['months'][$key],
                'year' =>$allDays['years'][$key],
                'student_id' => $student->id,
                'number' => 3,
            ];
            $this->attendences->create($data);
        }
        auth()->guard('student')->login($student);
        return redirect()->intended(RouteServiceProvider::STUDENT);
    }
}
