<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'user_id' => User::generateUserId('admin'),
            'name' => 'Yanto',
            'username' => 'yanto12',
            'email' => 'yanto@gmail.com',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => 'password',
            'avatar' => 'default.jpg',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'user_id' => User::generateUserId('staff'),
            'name' => 'Asep',
            'username' => 'asep12',
            'email' => 'asep@gmail.com',
            'role' => 'staff',
            'email_verified_at' => now(),
            'password' => 'password',
            'avatar' => 'default.jpg',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'user_id' => User::generateUserId('manager'),
            'name' => 'Budi',
            'username' => 'budi125',
            'email' => 'budi@gmail.com',
            'role' => 'manager',
            'email_verified_at' => now(),
            'password' => 'password',
            'avatar' => 'default.jpg',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'user_id' => User::generateUserId('staff'),
            'name' => 'Cindy',
            'username' => 'cindy126',
            'email' => 'cindy@gmail.com',
            'role' => 'staff',
            'email_verified_at' => now(),
            'password' => 'password',
            'avatar' => 'default.jpg',
            'remember_token' => Str::random(10),
        ]);
    }
}
