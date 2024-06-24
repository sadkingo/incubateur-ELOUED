<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstname_fr' => 'required|string',
            'lastname_fr' => 'required|string',

            'firstname_ar' => ['required', 'string', 'regex:/^[\p{Arabic}\s]+$/u'],
            'lastname_ar' => ['required', 'string', 'regex:/^[\p{Arabic}\s]+$/u'],

            'birthday' => 'required|date',
            'gender' => 'required|numeric|between:1,2',
            'state_of_birth' => 'required|string',
            'place_of_birth' => 'required|string',

            'photo' => 'required',
            'status' => 'nullable|numeric|between:1,2',

            'registration_number' => 'required|numeric|unique:students,registration_number',
            'group' => 'nullable|numeric',

            'residence' => 'required|string',
            'batch' => 'required|string',
            'academicLevel' => 'required|string',
            'specialty' => 'required|string',
            'faculty' => 'required|string',
            'department' => 'required|string',
            
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',

            'phone' => 'required|numeric|unique:students,phone',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:8|max:255',
            'password_confirmation' => 'required_with:password|same:password|min:8|max:255'
        ];
    }
    public function attributes()
    {
        return [
            'firstname_fr'   => trans('auth/student.firstname_fr'),
            'firstname_ar'   => trans('auth/student.firstname_ar'),
            'lastname_fr'    => trans('auth/student.lastname_fr'),
            'lastname_ar'    => trans('auth/student.lastname_ar'),

            'birthday'       => trans('auth/student.birthday'),
            'gender'         => trans('auth/student.gender'),
            'state_of_birth' => trans('auth/student.state_of_birth'),
            'place_of_birth' => trans('auth/student.place_of_birth'),

            'registration_number' => trans('auth/student.registration_number'),
            'group'               => trans('auth/student.group'),
            'residence'               => trans('auth/student.residence'),
            'batch'               => trans('auth/student.batch'),
            'start_date'               => trans('auth/student.start_date'),
            'end_date'               => trans('auth/student.end_date'),

            'phone'    => trans('auth/student.phone'),
            'email'    => trans('auth/student.email'),
            'password' => trans('auth/student.password'),
        ];
    }
}
