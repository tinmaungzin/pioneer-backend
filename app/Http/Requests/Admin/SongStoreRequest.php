<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\APIRequest;
use Illuminate\Contracts\Validation\Validator;

class SongStoreRequest extends APIRequest
{
    public function rules()
    {
        return [
            'names' => 'required',
            'photo' => 'nullable|image|mimes:png,jpg,webp,PNG,JPG|max:5120',
            'srt' => 'nullable|mimes:srt,txt|max:5120',
            'song' => 'nullable|mimes:mp3,mp4a,m4a,mp4|max:10240',
            'specifications' => 'required',
            // 'album_id' => 'required'
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
