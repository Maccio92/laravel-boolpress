<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(5);
        
        return response()->json([
            'response' => true,
            'results' => $post,
        ]);
    }
}
