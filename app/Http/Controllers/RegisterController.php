<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'last_name' => ['required', 'max:255'],
            'first_name' => ['required', 'max:255'],
            'middle_name' => ['max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'phone' => ['max:255'],
            'password' => ['required', 'min:5', 'max:20'],
            'agreement' => ['accepted']
        ]);

        $attributes['password'] = bcrypt($attributes['password']);
        $attributes['user_role'] = 4; // Set user_role to 4 for students

        session()->flash('success', 'Your account has been created.');
        $user = User::create($attributes);
        Auth::login($user);

        return redirect('/dashboard');
    }
}
