<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\APIRequest;
use Illuminate\Contracts\Validation\Validator;


class SetTypeStoreRequest extends APIRequest
{

    public function rules()
    {
        return [
            'set_id'=>'required',
            'type_id'=>'required',
            'price'=>'required',
            'table_count'=>'required',
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
