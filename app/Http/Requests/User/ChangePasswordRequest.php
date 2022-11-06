<?php

namespace App\Http\Requests\User;

use App\Http\Requests\APIRequest;
use Illuminate\Contracts\Validation\Validator;


class ChangePasswordRequest extends APIRequest
{
    public function rules()
    {
        return [
            'user_id'=>'required',
            'password' => 'bail|required|min:6',
            'confirm_password' => 'required|same:password',
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
