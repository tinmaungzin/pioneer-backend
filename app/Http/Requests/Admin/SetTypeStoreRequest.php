<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\APIRequest;
use Illuminate\Contracts\Validation\Validator;

class SetTypeStoreRequest extends APIRequest
{

    public function rules()
    {
        return [
            'set_price'=>'required_without:table_count',
            'type_id'=> ($this->has('set_price') && $this->has('table_count')) ?
                 'required|unique:set_type,type_id': 'required',
            'table_count'=>'required_without:set_price',
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
