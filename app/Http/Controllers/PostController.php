<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug)
    {
        return view('post', [
            'post' => Post::where('slug', '=', $slug)->first()
        ]);
    }

    public function store(Request $request)
    {
        $post = new Post();

        $post->title = $request->title;
        $post->body = $request->body;
        $post->slug = $request->slug;

        $post->save();

        return response()->json(["result" => "ok"], 201);
   }
}
