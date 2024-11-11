<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Gate;
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

    public function destroy(Post $post)
    {

        if (Gate::denies('only-admin')) {
            return redirect('/');
        }

        $post->delete();
        return redirect()->back();
    }
}
