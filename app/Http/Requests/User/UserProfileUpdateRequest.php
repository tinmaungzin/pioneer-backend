<?php

namespace App\Http\Requests\User;

use App\Http\Requests\APIRequest;
use Illuminate\Contracts\Validation\Validator;

class UserProfileUpdateRequest extends APIRequest {

    public function rules()
    {
        return [
            'gender' => 'nullable|in:male,female',
            'image' =>'image|mimes:png,jpg,webp,PNG,JPG|max:5120',
        ];
    }

    public function authorize(){
        return parent::authorize();
    }

    public function failedValidation(Validator $validator){
        parent::failedValidation($validator);
    }

}
