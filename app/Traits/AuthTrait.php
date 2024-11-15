<?php

namespace App\Traits;

use App\Models\Project;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Log;

trait AuthTrait
{
    public function checkGuard() {
        if (auth()->guard('admin')->check()) {
            return 'admin';
        } else if (auth()->guard('teacher')->check()) {
            return 'teacher';
        } else if (auth()->guard('student')->check()) {
            return 'student';
          } else if (auth()->guard('manager')->check()) {
            return 'manager';
        } else {
            return null;
        }
    }
    public function redirectTo($guard)
    {
        switch ($guard) {
            case ('admin'):
                return redirect()->intended(RouteServiceProvider::ADMIN);
                break;
            case ('teacher'):
                return redirect()->intended(RouteServiceProvider::ADMIN);
                // return redirect()->intended(RouteServiceProvider::TEACHER);
                break;
            case ('student'):
                return redirect()->intended(RouteServiceProvider::STUDENT);
                break;
              case ('manager'):
                return redirect()->intended(RouteServiceProvider::MANAGER);
                break;
            default:
                return redirect()->intended(RouteServiceProvider::LOGIN)
                    ->with(['error' => trans('message.invalid_credentials')]);
        }
    }

    public function login($credentials)
    {
      if (isset($credentials['email'])) {
        if (auth('admin')->attempt($credentials)) {
            return $this->redirectTo('admin');
        } else if (auth('teacher')->attempt($credentials)) {
            return $this->redirectTo('teacher');
        } else if (auth('manager')->attempt($credentials)) {
            return $this->redirectTo('manager');
        }
      } elseif (isset($credentials['code']) && isset($credentials['password'])) {
        if (auth('student')->attempt(['code' => $credentials['code'], 'password' => $credentials['password']])) {
            Log::info('Student login successful');
            return $this->redirectTo('student');
        } else {
            Log::error('Invalid student login attempt', $credentials);
            return redirect()->back()->withErrors(['error' => 'Invalid Code or Password']);
        }
      }



        return $this->redirectTo(null);
    }

    public function logout($guard)
    {
        return auth()->guard($guard)->logout();
    }
}
