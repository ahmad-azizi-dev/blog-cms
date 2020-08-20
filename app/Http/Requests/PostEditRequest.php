<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostEditRequest extends FormRequest
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

            'title'            => 'required|min:10',
            //  by ignoring this post form unique rule we can update the post with the same slug
            'slug'             => Rule::unique('posts', 'slug')->ignore($this->post),
            'description'      => 'required',
            'meta_description' => 'required',
            'meta_keywords'    => 'required',
            'cats'             => 'required',
            'status'           => 'required',
        ];
    }

    public function messages()
    {
        return [

            'title.required'            => 'please enter a title',
            'description.required'      => 'please enter description',
            'meta_description.required' => 'please enter meta_description',
            'meta_keywords.required'    => 'please enter meta_keywords',
            'cats.required'             => 'please choose one category',
            'status.required'           => 'please choose the status of the post',
            'slug.unique'               => 'This slug has been chosen please enter another one',
        ];
    }
}
