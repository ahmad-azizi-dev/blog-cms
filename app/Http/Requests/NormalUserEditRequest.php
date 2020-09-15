<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class NormalUserEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //first check this user can modify with this request
        if ($this->id == Auth::user()->id)
            return true;
        else
            return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                 => 'required',
            'password'             => 'required|min:6',
            'new_password'         => 'nullable|min:6',
            'new_confirm_password' => 'nullable|same:new_password'
        ];
    }

    public function messages()
    {
        return [
            'name.required'             => 'please enter a name',
            'password.min'              => 'the password must be at least 6 character',
            'password.required'         => 'please enter password',
            'new_password.min'          => 'the password must be chosen at least 6 character',
            'new_confirm_password.same' => 'The new confirm password and new password must match!!',

        ];
    }
}
