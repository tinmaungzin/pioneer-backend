<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\APIRequest;
use Illuminate\Contracts\Validation\Validator;


class SetTypeStoreRequest extends APIRequest
{

    public function rules()
    {
        return [
            //'set_price'=>'required',
            'type_id'=>'required',
            //'table_count'=>'required',
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
