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

    //for validation of the unique rule, the input slug must be made before validation!!!
    protected function prepareForValidation()
    {
        if ($this->input('slug')) {
            $this->merge(['slug' => make_slug($this->input('slug'))]);
        } else {
            $this->merge(['slug' => make_slug($this->input('title'))]);
        }
    }

    public function rules()
    {
        return [

            'title'            => 'required|min:10',
            'slug'             => 'unique:posts',
            'description'      => 'required',
            'meta_description' => 'required',
            'meta_keywords'    => 'required',
            'photo'            => 'required',
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
            'photo.required'            => 'please enter one photo',
            'slug.unique'               => 'This slug has been chosen please enter another one',
        ];
    }
}
