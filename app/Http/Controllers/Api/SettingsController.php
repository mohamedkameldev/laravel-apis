<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\SettingsResource;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        #-------------- Fore Retreving just one record:
        // $oneRecord = DB::table('settings')->first();
        // return new SettingsResource($oneRecord);


        #-------------- For Retreving a collection of records:
        // $settingsData = DB::table('settings')->get();
        // return SettingsResource::collection($settingsData);


        #-------------- Dealing with a user-defined Helper method (to standardized sending responses)
        $settingsData = DB::table('settings')->get();

        if(count($settingsData) > 1) {
            return ApiResponse::message(1, SettingsResource::collection($settingsData), 'settings data returned successfully');
        }
        return ApiResponse::message(0, message: 'there is no settings data');
    }
}
