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

        if (!$ads->hasPages()) {
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

    public function latest($num)
    {
        $latestAds = Ad::latest()->take($num)->get();

        if (count($latestAds) >= 1) {
            return ApiResponse::message(1, AdResource::collection($latestAds), 'the latest '.$num.' ads');
        }
        return ApiResponse::message(0, message:'there is no enough ads');
    }

    public function search(Request $request)
    {
        $keyword = $request->query('keyword');

        #-- working without any errors:
        // $results = Ad::where('title', 'like', "%$keyword%")->orWhere('description', 'like', "%$keyword%")->dd();

        $results = Ad::when($keyword, function ($q) use ($keyword) {
            $q->where('title', 'like', "%$keyword%")->orWhere('description', 'like', "%$keyword%");
        })->latest()->get();

        if (count($results) > 0) {
            return ApiResponse::message(1, AdResource::collection($results), 'all matched records');
        }
        return ApiResponse::message(0, message: 'there are no matched records');
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'phone' => 'required',
            'status' => 'required'
        ]);

        $request->merge(['user_id' => $request->user()->id]);

        $created_ad = Ad::create($request->only(['title', 'description', 'phone', 'status', 'user_id']));

        if ($created_ad) {
            return ApiResponse::message(1, new AdResource($created_ad), 'new ad created successfully');
        }
        return ApiResponse::message(0, message: 'something wrong is happened');
    }

    public function update(Request $request, string $adId)
    {
        // dd($request->all());
        $ad = Ad::findOrFail($adId);
        if ($ad->user_id != $request->user()->id) {
            return ApiResponse::message(0, message:'you aren\'t authorized to update this AD');
        }

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'phone' => 'required',
            'status' => 'required'
        ]);

        $updated_ad = $ad->update($request->only(['title', 'description', 'phone', 'status']));

        if ($updated_ad) {
            return ApiResponse::message(1, new AdResource($ad), 'ad have been updated successfully');
        }
        return ApiResponse::message(0, message: 'something wrong is happened');
    }

    public function delete(string $adId)
    {
        $ad = Ad::findOrFail($adId);
        if ($ad->user_id != request()->user()->id) {
            return ApiResponse::message(0, message:'you aren\'t authorized to delete this AD');
        }

        $deleted_ad = $ad->delete();

        if ($deleted_ad) {
            return ApiResponse::message(1, message:'ad have been deleted successfully');
        }
        return ApiResponse::message(0, message: 'something wrong is happened');
    }
}
