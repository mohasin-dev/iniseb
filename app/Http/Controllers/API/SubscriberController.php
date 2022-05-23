<?php

namespace App\Http\Controllers\API;

use App\Models\Subscriber;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\SubscriberRequest;

class SubscriberController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SubscriberRequest $request)
    {
        $subscriber             = new Subscriber();
        $subscriber->email      = $request->email;
        $subscriber->website_id = $request->website_id;
        $subscriber->save();

        $subscribers = Subscriber::active()->whereWebsiteId($subscriber->website_id)->get();
        Cache::put('subscribers_' . $subscriber->website_id, $subscribers);

        return response()->json([
            'type' => 'success',
            'data' => 'Thanks for subscribing!',
        ], 200);
    }
}
