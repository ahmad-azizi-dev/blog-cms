<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
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

            'title'       => 'required|min:10',
            'slug'        => 'unique:posts',
            'description' => 'required',
            'photo'       => 'required',
            'cats'        => 'required',
            'status'      => 'required',
        ];
    }

    public function messages()
    {
        return [

            'title.required'       => 'please enter a title',
            'description.required' => 'please enter description',
            'cats.required'        => 'please choose one category',
            'status.required'      => 'please choose the status of the post',
            'photo.required'       => 'please enter one photo',
            'slug.unique'          => 'This slug has been chose please enter another one',
        ];
    }
}
