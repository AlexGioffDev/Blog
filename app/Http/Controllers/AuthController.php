<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Validation\Rules\Password;


class AuthController extends Controller
{
    public function create()
    {
        return Inertia::render('auth/Create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'form.username' => ['required'],
            'form.email' => ['required', 'email', 'unique:users,email'],
            'form.password' => ['required', Password::min(8)]
        ]);

        $user = User::create($validateData['form']);


        Auth::login($user);

        return redirect('/');
    }
}
