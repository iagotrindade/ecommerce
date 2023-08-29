<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;


class ProductsSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('products')->insert([
            'name' => fake()->name(10),
            'description' => fake()->sentence(),
            'image_id' => 1,
            'status' => 'Ativado',
            'price' => fake()->randomFloat(2, 10, 1000),
            'quantity' => fake()->randomNumber()
        ]);
    }
}
