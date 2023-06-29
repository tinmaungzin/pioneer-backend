<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\APIRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class EventUpdateRequest extends APIRequest
{
    public function rules()
    {
        return [
            'name'=> ['required', Rule::unique('events','name')->ignore($this->event->id)],
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
