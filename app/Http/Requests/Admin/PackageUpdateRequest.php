<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\APIRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class PackageUpdateRequest extends APIRequest
{

    public function rules()
    {
        return [
            'name'=> ['required', Rule::unique('packages','name')->ignore($this->package->id)],
            // 'photo'=>'required',
            'type_id'=>['required', Rule::unique('packages','type_id')->ignore($this->package->id)],
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
