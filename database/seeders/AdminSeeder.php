<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::updateOrCreate(
            ['username' => 'admin@bodia.com'],
            [
                'password' => Hash::make('123456'), // Use env() in production
                'type' => 1,                    // Set the admin type
                'token' => Str::random(60),           // Generate a random token
            ]
        );
    }
}


