<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => 'required',
            'email'    => 'required|email',
            'roles'    => 'required',
            'status'   => 'required',
            'password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'please enter a name',
            'email.required'    => 'please enter an email',
            'email.email'       => 'please enter valid email',
            'roles.required'    => 'please choose at least one roles',
            'status.required'   => 'please enter the status of the user',
            'password.required' => 'please enter the password',
            'password.min'      => 'the password must be chosen at least 6 character',

        ];
    }
}
