<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\APIRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class SpecificationStoreRequest extends APIRequest
{
    public function rules()
    {
        return [
            'name'=>['required',
                Rule::unique('specifications','name')],
            'photo'=>'nullable|image|mimes:png,jpg,webp,PNG,JPG|max:5120',
            'type_id'=>'required'
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
