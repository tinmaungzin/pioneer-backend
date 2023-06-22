<?php

namespace App\Http\Requests\User;

use App\Http\Requests\APIRequest;
use Illuminate\Contracts\Validation\Validator;

class UserRegisterRequest extends APIRequest
{
    public function rules()
    {
        return [
            'name'=> 'required',
            'phone_number' => 'bail|required|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ];
    }
    public function authorize()
    {
        return parent::authorize();
    }

    public function failedValidation(Validator $validator)
    {
        parent::failedValidation($validator);
    }
}
