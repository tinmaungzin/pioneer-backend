<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\APIRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends APIRequest
{

    public function rules()
    {
        return [
            // 'name'=>'required',
            // 'phone_number'=>['required', Rule::unique('users','phone_number')->ignore($this->user->id)],
            // 'allowed_table'=>'required',
            // 'user_type_id'=>'required',
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
