<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;

class PostController extends Controller
{
    //

    public function index()
    {
        $posts = Post::withCount('comments')->with(['user:id,username'])->latest()->paginate(9);
        return Inertia::render('posts/Index', ['posts' => $posts]);
    }

    public function show(Post $post)
    {
        $post->load(['user:id,username,email', 'comments.user:id,username']);
        return Inertia::render('posts/Show', ['post' => $post]);
    }
}
