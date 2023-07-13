<?php

namespace App\Http\Requests\User;

use App\Http\Requests\APIRequest;
use Illuminate\Contracts\Validation\Validator;

class PasswordRequest extends APIRequest
{
    public function rules()
    {
        return [
            'old_password'=>'required',
            'new_password' => 'bail|required|min:6',
            'confirm_new_password' => 'required|same:new_password',
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
