<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        if (!User::where('email', 'admin@sibo.com')->exists()) {
            User::create([
                'name' => 'Admin SIBO',
                'email' => 'admin@sibo.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]);
        }
    }
}