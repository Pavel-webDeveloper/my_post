<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index(){

        $postList = Post::all();
        return response()->json($postList);
    }

    public function show($slug){

        $singlePost = Post::where('slug', $slug)->with(['category', 'tags', 'comments'])->first();
        if(empty($singlePost)){
            return response()->json(["message"=>"Page Not Found"], 404);
        }
        return response()->json($singlePost);
    }
}
