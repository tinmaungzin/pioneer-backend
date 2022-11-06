<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\APIRequest;
use Illuminate\Contracts\Validation\Validator;

class SingerProfileStoreRequest extends APIRequest
{
    public function rules()
    {
        return [
            'names'=>'required',
            'photo'=>'nullable|image|mimes:png,jpg,webp,PNG,JPG|max:5120',
            'specifications'=>'required',
            'gender_id'=>'required',
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
