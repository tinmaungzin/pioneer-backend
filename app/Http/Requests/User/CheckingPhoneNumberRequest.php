<?php

namespace App\Http\Requests\User;

use App\Http\Requests\APIRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CheckingPhoneNumberRequest extends APIRequest
{
    public function rules()
    {
        return [
            'phone_number' => 'required|exists:users,phone_number',
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
