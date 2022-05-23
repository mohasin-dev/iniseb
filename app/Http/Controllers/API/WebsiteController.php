<?php

namespace App\Http\Controllers\API;

use App\Models\Website;
use App\Http\Controllers\Controller;
use App\Http\Requests\WebsiteRequest;

class WebsiteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\WebsiteRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(WebsiteRequest $request)
    {
        $website              = new Website();
        $website->title       = $request->title;
        $website->description = $request->description;
        $website->url         = $request->url;
        $website->save();

        return response()->json([
            'type' => 'success',
            'data' => 'Website successfully created!',
        ], 200);
    }
}
