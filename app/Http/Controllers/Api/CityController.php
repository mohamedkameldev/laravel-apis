<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function __invoke()
    {
        $cities = DB::table('cities')->get();

        if(count($cities) > 0) {
            return ApiResponse::successResponse(CityResource::collection($cities), 1, 'all cities');
        }
        return ApiResponse::errorResponse(0, 'there are no cities in the system');
    }
}
