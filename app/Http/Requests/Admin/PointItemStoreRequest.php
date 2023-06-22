<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\APIRequest;
use Illuminate\Contracts\Validation\Validator;

class PointItemStoreRequest extends APIRequest
{

    public function rules()
    {
        return [
            'point'=>'required',
            'photo' => 'nullable|image|mimes:png,jpg,webp,PNG,JPG|max:5120',
            'details'=>'required',
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
