<?php

namespace App\Http\Controllers\Api;

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
        // Fore Retreving just one record:
        // $oneRecord = DB::table('settings')->first();
        // return new SettingsResource($oneRecord);

        // For Retreving a collection of records:
        $settingsData = DB::table('settings')->get();
        return SettingsResource::collection($settingsData);
    }
}
