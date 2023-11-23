<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       User::create(
            [
                'name' => 'Administrator',
                'email' =>'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('@admin2023'), // password
                'remember_token' => Str::random(10),
            ]
        );

    }
}
