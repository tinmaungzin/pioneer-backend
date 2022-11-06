<?php


namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

abstract class APIRequest extends FormRequest
{
    abstract public function rules();

    protected function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->getMessageBag()->toArray();
        $keys = array_keys($errors);
        foreach ($keys as $key){
            $errors[$key] = $errors[$key][0];
        }

        throw new HttpResponseException(
            response()->json(
                ['message' => $errors],
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            ));
    }
}
