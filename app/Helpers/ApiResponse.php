<?php

namespace App\Helpers;

class ApiResponse
{
    public static function message($status = 1, $data = [], $message = null)
    {
        return response()->json([
            'status' => $status,
            'data' => $data,
            'message' => $message,
        ]);
    }
}
