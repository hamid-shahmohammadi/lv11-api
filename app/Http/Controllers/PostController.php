<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index (){
        return Post::get();
    }
    public function createPost (Request $request){
        $data = $request->validate([
            'title'=>['required','string','min:3'],
            'content'=>['required','string','max:5000'],
            'user_id'=>['required','exists:users,id'],
        ]);
        return Post::create($data);
    }

}
