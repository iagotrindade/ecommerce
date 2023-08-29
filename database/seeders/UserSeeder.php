<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => fake()->name(30),
            'image' => "assets/images/panel-avatars/default-avatar.png",
            'id_permission' => '1',
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$1U7IKFv89Y7264RDP.rkXOe6kgIFQX.s60ks3jjYa5fyKxw6Th.r2', // password
            'status' => $status,
            'remember_token' => Str::random(10),
        ]);
    }
}
