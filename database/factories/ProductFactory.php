<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'name' => fake()->sentence(4),
            'description' => fake()->sentence(),
            'image_id' => 1,
            'status' => 'Ativado',
            'price' => fake()->randomFloat(2, 10, 1000),
            'quantity' => fake()->randomNumber(1, 5000)
        ];
    }
}
