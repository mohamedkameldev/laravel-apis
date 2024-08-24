<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class MessageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if($this->wantsJson()) {
            #-- return an array (key => field name, value => error messages)
            // $response = ApiResponse::message(0, $validator->errors(), 'there are some validation errors');
            // $response = ApiResponse::message(0, $validator->errors(), $validator->errors()->first());

            #-- return only the error messages
            $response = ApiResponse::message(0, $validator->messages()->all(), $validator->messages()->first());
            throw new ValidationException($validator, $response);
        }
    }
}
