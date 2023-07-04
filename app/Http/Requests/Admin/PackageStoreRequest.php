<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\APIRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;


class PackageStoreRequest extends APIRequest
{

    public function rules()
    {
        return [
            'name'=> ['required', Rule::unique('packages','name')],
            'photo'=>'required',
            'type_id'=> ['required', Rule::unique('packages','type_id')],
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
