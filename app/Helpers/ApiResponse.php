<?php

namespace App\Helpers;

class ApiResponse
{
    public static function successResponse($data = [], $status = 1, $message = null)
    {
        return response()->json([
            'data' => $data,
            'status' => $status,
            'message' => $message,
        ]);
    }

    public static function errorResponse($status = 0, $message = 'something wrong')
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
        ]);
    }
}
