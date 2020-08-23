<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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

            'title'       => 'required|min:10',
            //  by ignoring this category form unique rule we can update the category with the same slug
            //  route list -> uri ->  admin/categories/{category} -> ($this->category)  !!!
            'slug'        => Rule::unique('cats', 'slug')->ignore($this->category),
            'description' => 'required',
            'keywords'    => 'required',
        ];
    }

    public function messages()
    {
        return [

            'title.required'       => 'please enter a title',
            'description.required' => 'please enter description',
            'keywords.required'    => 'please enter keywords',
            'slug.unique'          => 'This slug has been chosen please enter another one',
        ];
    }
}
