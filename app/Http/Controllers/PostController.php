<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index (){
        // $post=Post::whereJsonContains('metadata->author', 'ali')->get();
        $post=Post::first();
        return $post->metadata['author'];
    }
    public function createPost (Request $request){
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'metadata' => 'required',
            'user_id' => 'required',
        ]);
        return Post::create($validated);
    }

}
