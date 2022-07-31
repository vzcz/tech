<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class employeeRequest extends FormRequest
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
        return [

            //
            'name'=>'required|max:100',
            'age'=>'required|numeric',
            'country'=>'required|max:100',

        ];
    }
    public function messages(){
        return [
            'name.required' => "Name field is required",
            'age.required' => "Age field is required",
            'age.numeric' => "Age field is numeric",
            'country.required' => "Country field is required",
        ];
    }
}
