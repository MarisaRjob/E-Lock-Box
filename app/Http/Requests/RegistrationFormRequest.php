<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
//use Illuminate\Http\Request;

class RegistrationFormRequest extends Request
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
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone_number' => array('regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}/'),
            'address1' => 'max:255',
            'address2' => 'max:255',
            'city' => 'max:255',
            'zip' => 'max:5',
        ];
    }
}
