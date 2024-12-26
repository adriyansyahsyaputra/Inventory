<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users.table', compact('users'));
    }

    public function create()
    {
        $users = User::all();

        return view('users.create', compact('users'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required|string',
            ]);

            // Membuat userID berdasarkan role
            $userId = User::generateUserId($request->role);

            User::create([
                'user_id' => $userId,
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'email_verified_at' => now(),
                'avatar' => 'default.jpg',
                'remember_token' => Str::random(10),
            ]);

            return redirect()->route('users.table')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.table')->with('error', 'User not found');
        }

        $user->delete();

        return redirect()->route('users.table')->with('success', 'User deleted successfully');
    }

    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.table')->with('error', 'User not found');
        }

        return view('users.update', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.table')->with('error', 'User not found');
        }

        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8', // Password opsional
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string',
        ]);

        // Update data user
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        // Ubah password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Update role dan user_id jika role berubah
        if ($user->role !== $request->role) {
            $user->role = $request->role;
            $user->user_id = User::generateUserId($request->role);
        }

        $user->save();

        return redirect()->route('users.table')->with('success', 'User updated successfully');
    }
}
