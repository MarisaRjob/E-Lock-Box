<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCaseFormRequest extends FormRequest
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
            //
            'email' => 'required|email|unique:users',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
//            'birthday'   => 'regex:/^\d{2}-\d{2}-\d{4}$/',
            'gender'     => 'max:6',
            'webpage'    => 'max:255',
            'ssn'        => 'regex:/^\d{3}-\d{2}-\d{4}$/',
        ];
    }
}
