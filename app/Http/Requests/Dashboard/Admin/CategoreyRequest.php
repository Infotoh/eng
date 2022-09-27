<?php

namespace App\Http\Requests\Dashboard\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoreyRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            
            $admin = $this->route()->parameter('admin');

            $rules['email'] = ['required','email','min:2','max:255', Rule::unique('users')->ignore($admin->id)];

        } else {

            $rules['email'] = ['required','email','unique:users','min:2','max:255'];

        } //end of if

        return $rules;

    }//end of rules

}//end of request