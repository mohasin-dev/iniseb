<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use App\Events\PostCreated;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostRequest $request)
    {
        $post             = new Post();
        $post->title      = $request->title;
        $post->slug       = $post::checkSlugExists(Str::slug($request->title));
        $post->body       = $request->body;
        $post->website_id = $request->website_id;
        $post->save();

        if ($post->id) {
            event(new PostCreated($post));
        }

        return response()->json([
            'type' => 'success',
            'data' => 'New post successfully created!',
        ], 200);
    }
}
