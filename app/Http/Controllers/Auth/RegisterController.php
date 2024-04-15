<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('reg');
    }

    public function register(Request $request)
    {
        $request->validate([
            'login' => 'required|string|max:40|unique:users',
            'password' => 'required|string|min:6|max:255',
            'last_name' => 'required|string|max:32',
            'first_name' => 'required|string|max:32',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|boolean',
        ]);

//        $isAdmin = $request->admin_code === '#';

        $user = User::create([
            'login' => $request->login,
            'password' => Hash::make($request->password),
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'role' => $request->role,

        ]);


        return redirect()->route('login')->with('Успешная регистрация');
    }
}
