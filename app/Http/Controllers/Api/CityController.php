<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function __invoke()
    {
        $cities = DB::table('cities')->get();

        if(count($cities) > 0) {
            return ApiResponse::message(CityResource::collection($cities), 1, 'all cities');
        }
        return ApiResponse::message(0, 'there are no cities in the system');
    }
}
