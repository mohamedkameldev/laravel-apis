<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\DistrictResource;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistrictController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(City $city)
    {
        if(count($city->districts) > 0) {
            return ApiResponse::successResponse(DistrictResource::collection($city->districts), 1, "{$city->name} districts");
        }
        return ApiResponse::errorResponse(0, "there are no districts for {$city->name}");
    }
}
