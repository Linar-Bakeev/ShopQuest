<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //admin_panel
    public function index()
    {
        $users = User::orderBy('id')->get();
        return view('admin.users.index', compact('users'));
    }


    public function create()
    {
        $sellers = User::where('role', 'seller')->get();
        return view('admin.users.create', compact('sellers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'login'=>'required|string|min:1|max:75',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);

        $user = User::create([
            'login'=> $request->login,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Пользователь успешно добавлен.');
    }



    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,

        ]);

        // Обновление основной информации пользователя
        $user->update($request->only(['first_name', 'last_name', 'email']));

        // Обновление роли пользователя
        switch ($request->input('role')) {
            case 'seller':
                $user->role = 'seller';
                break;
            case 'admin':
                $user->role = 'admin';
                break;
            case 'buyer':
                $user->role = 'buyer';
                break;
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Информация о пользователе обновлена.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Пользователь удален.');
    }
    //user_panel
    public function showProfile()
    {
        $user = auth()->user();
        $orders = $user->orders;

        return view('user.profile', compact('user', 'orders'));
    }
    public function updateProfile(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only(['first_name', 'last_name', 'email']));

        return redirect()->route('profile')->with('success', 'Данные успешно обновлены.');
    }

}
