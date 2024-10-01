<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    //

    public function index()
    {
        $posts = Post::latest()->paginate(9);
        return Inertia::render('posts/Index', ['posts' => $posts]);
    }
}
