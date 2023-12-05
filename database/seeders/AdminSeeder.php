<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'scn' => 'admin',
            'title' => 'admin',
            'role' => 'admin',
            'firstName' => 'admin',
            'lastName' => 'admin',
            'phoneNumber' => '800000000000',
            'gender' => 'male',
            'address' => 'ikeja nba office',
            'email' => 'admin@nbaikeja.com.ng',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            // 'remember_token' => Str::random(10),
    ]);
    }

    



}
