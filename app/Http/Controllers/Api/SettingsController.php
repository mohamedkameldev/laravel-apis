<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\SettingsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        #-------------- Fore Retreving just one record:
        // $oneRecord = DB::table('settings')->first();
        // return new SettingsResource($oneRecord);


        #-------------- For Retreving a collection of records:
        // $settingsData = DB::table('settings')->get();
        // return SettingsResource::collection($settingsData);


        #-------------- Dealing with a user-defined Helper method (to standardized sending responses)
        $settingsData = DB::table('settings')->get();

        if($settingsData) {
            return ApiResponse::successResponse(SettingsResource::collection($settingsData), 200, 'settings data returned successfully');
        }
        return ApiResponse::errorResponse(message: 'there is no settings data');
    }
}
