<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class SessionController extends Controller
{
    public function create()
    {
        return Inertia::render('session/Create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'form.email' => ['required', 'email'],
            'form.password' => ['required']
        ]);

        if (!Auth::attempt($attributes['form'])) {
            throw ValidationException::withMessages([
                'data' => 'Sorry, data not valid! check again!'
            ]);
        }

        request()->session()->regenerate();

        return redirect('/');
    }


    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
