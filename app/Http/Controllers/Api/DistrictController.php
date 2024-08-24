<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictResource;
use App\Models\City;

class DistrictController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(City $city)
    {
        if(count($city->districts) > 0) {
            return ApiResponse::message(1, DistrictResource::collection($city->districts), "{$city->name} districts");
        }
        return ApiResponse::message(0, message: "there are no districts for {$city->name}");
    }
}
