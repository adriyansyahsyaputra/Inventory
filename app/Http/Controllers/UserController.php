<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::all();

        return view('users.create', compact('users'));
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required|string|in:admin,manager,staff',
            ]);

            // Membuat userID berdasarkan role
            $userId = User::generateUserId($request->role);

            User::create([
                'user_id' => $userId,
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
                'email_verified_at' => now(),
                'avatar' => 'default.jpg',
            ]);

            return redirect()->route('users.table')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
