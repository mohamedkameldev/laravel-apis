<?php

namespace App\Helpers;

class ApiResponse
{
    public static function successResponse($data = [], $status = 200, $message = null)
    {
        return response()->json([
            'data' => $data,
            'status' => $status,
            'message' => $message,
        ], $status);
    }
}
