<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdResource;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::latest()->paginate(10);

        if(!$ads->hasPages()) {
            return ApiResponse::message(1, AdResource::collection($ads), 'all of ads');
        }
        $data = [
            'data' => AdResource::collection($ads),
            'pagination' => [
                'first_item_in_the_page' => $ads->firstItem(),
                'last_item_in_the_page' => $ads->lastItem(),
                'per_page' => $ads->perPage(),
                'total' => $ads->total(),
                'links' => [
                    'current' => $ads->url($ads->currentPage()),
                    'previous' => $ads->previousPageUrl(),
                    'next' => $ads->nextPageUrl(),
                    'first' => $ads->url(1),
                    'last' => $ads->url($ads->lastPage()),
                ]
            ]
        ];
        return ApiResponse::message(1, $data, 'all of ads');
    }
}
