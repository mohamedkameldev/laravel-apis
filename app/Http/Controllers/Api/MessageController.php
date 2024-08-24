<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(MessageRequest $request)
    {
        // add request header Accept: application/json to enforce laravel return json
        // $request->validate([
        //     'name' => 'bail|required', // to stop at the first error
        //     'email' => 'required',
        //     'message' => 'required'
        // ]);


        // dd($request->all());
        // dd($request->validated());
        // dd($request->only(['name', 'email', 'message']));
        // dd($request->safe()->only(['name', 'email', 'message']));

        $sendMessage = Message::create($request->safe()->only(['name', 'email', 'message']));
        if($sendMessage) {
            return ApiResponse::successResponse(status: 1, message:'your message has been send successfully');
        }
        return ApiResponse::errorResponse(status: 0, message:'there is some error occured');
    }
}
