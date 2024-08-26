<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function __invoke()
    {
        #------- Add request header Accept: application/json to enforce laravel return json
        // request()->validate([
        //     'name' => 'bail|required', // to stop at the first error
        //     'email' => 'required',
        //     'message' => 'required'
        // ]);

        // $validator = Validator::validate(request()->all(), [  // returns the validated data directly
        $validator = Validator::make(request()->all(), [        // returns an object of validator - you can get the validated data from it
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        if($validator->fails()) {
            // return ApiResponse::message(0, $validator->errors(), $validator->errors()->first());
            return ApiResponse::message(0, $validator->messages()->all(), $validator->messages()->first());
        }

        // dd(request()->validated());      // doesn't work here - works with form request validation
        // dd(request()->all());
        // dd(request()->only(['name', 'email', 'message']));
        // dd(request()->safe()->only(['name', 'email', 'message']));

        // dd($validator->validated());
        // dd($validator->safe()->only(['name', 'email', 'message']));

        $sendMessage = Message::create($validator->safe()->only(['name', 'email', 'message']));

        if($sendMessage) {
            return ApiResponse::message(status: 1, message:'your message has been send successfully');
        }
        return ApiResponse::message(status: 0, message:'there is some error occured');
    }
}
