<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class AdminBoardController extends Controller
{
    //
    public function index()
    {
        if (Gate::denies('only-admin')) {
            return redirect('/');
        }

        $posts = Post::select('id', 'title')->latest()->get();
        $users = User::select('id', 'username', 'role')->get();
        $isAdmin = Gate::allows('only-admin');
        return Inertia::render('AdminBoard/index', ['posts' => $posts, 'users' => $users, 'isAdmin' => $isAdmin]);
    }


    public function destroy(User $user)
    {
        if (Gate::denies('delete-user', $user)) {
            return redirect()->back();
        }

        $user->delete();
        return redirect()->back();
    }

    public function create()
    {
        return Inertia::render("AdminBoard/create");
    }

    public function store(Request $request)
    {
        if (Gate::denies('only-admin')) {
            return redirect()->back();
        }

        $request->validate([
            'form.title' => ['required', 'string', 'max:255'],
            'form.image_url' => ['required', 'url'],  // Controlla che sia un URL valido
            'form.body' => ['required', 'string'],
        ]);


        $post = new Post();
        $post->title = $request->input('form.title');
        $post->image_url = $request->input('form.image_url');
        $post->body = $request->input('form.body');
        $post->user_id = auth()->id();
        $post->save();


        return redirect('/dashboard');
    }

    public function update(Request $request, User $user)
    {
        if (Gate::denies('only-admin')) {
            return redirect()->back();
        }

        $request->validate([
            'role' => ['required', 'in:ADMIN,MOD,USER']
        ]);

        $user->role = $request['role'];
        $user->save();

        return redirect()->back();
    }
}
