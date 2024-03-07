<?php

namespace Database\Factories;
use app\Models\Order;
use app\Models\Product;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchasedProducts>
 */
class PurchasedProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::all()->random(),
            'product_id' => Product::all()->random(),
            'quantity' => fake()->randomNumber(1, 10)
        ];
    }
}
