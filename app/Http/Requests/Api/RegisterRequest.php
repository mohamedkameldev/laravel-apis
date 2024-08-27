<?php

namespace App\Http\Requests\Api;

use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

// use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if($this->wantsJson()) {
            #-- return an array (key => field name, value => error messages)
            $response = ApiResponse::message(0, $validator->errors(), $validator->errors()->first());

            #-- return only the error messages
            // $response = ApiResponse::message(0, $validator->messages()->all(), $validator->messages()->first());

            throw new ValidationException($validator, $response);
        }
    }
}
