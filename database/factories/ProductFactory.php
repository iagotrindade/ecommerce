<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categories;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $random = rand(1,2);

        if($random == 1) {
            $status = 'Ativado';
        }

        else {
            $status = 'Desativado';
        }
        return [
            'name' => fake()->sentence(4),
            'categories_id' => Categories::all()->random(),
            'description' => fake()->sentence(),
            'image_id' => 2,
            'status' => $status,
            'price' => fake()->randomFloat(2, 10, 1000),
            'quantity' => fake()->randomNumber(1, 5),
            'discount_status' => 'Desativado'
        ];
    }
}
