<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\APIRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;


class TypeStoreRequest extends APIRequest
{
    public function rules()
    {
        return [
            'name'=> ['required', Rule::unique('types','name')],
            'allowed_people' => 'required'
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
