<?php

namespace App\Http\Requests\User;

use App\Http\Requests\APIRequest;
use Illuminate\Contracts\Validation\Validator;

class SearchRequest extends APIRequest
{
    public function rules()
    {
        return [
            'search_input' => 'sometimes',
            'type' => 'required'
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
