<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\APIRequest;
use Illuminate\Contracts\Validation\Validator;

class EventUpdateRequest extends APIRequest
{
    public function rules()
    {
        return [
            "date" => "required"
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
