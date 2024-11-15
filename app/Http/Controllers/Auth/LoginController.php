<?php

namespace App\Http\Controllers\Auth;

use App\Traits\AuthTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\StudentLoginRequest;

class LoginController extends Controller
{
    use AuthTrait;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginForm()
    {
        return view('auth.login');
    }

    public function loginAsStudent()
    {
        return view('auth.student.login');
    }

    public function submitLogin(LoginRequest $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        return $this->login($data);
    }

    public function submitStudentLogin(StudentLoginRequest $request)
    {
        $data = [
            'code' => $request->code,
            'password' => $request->password,
        ];

        return $this->login($data);
    }

}
