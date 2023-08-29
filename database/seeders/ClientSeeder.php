<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clients')->insert([
            "name" => "Cliente Teste",
            "email" => fake()->unique()->safeEmail(),
            "password" => "12345678"
        ]);
    }
}
