<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // add request header Accept: application/json to enforce laravel return json
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        $sendMessage = Message::create($request->all());
        if($sendMessage) {
            return ApiResponse::successResponse(status: 1, message:'your message has been send successfully');
        }
        return ApiResponse::errorResponse(status: 0, message:'there is some error occured');
    }
}
