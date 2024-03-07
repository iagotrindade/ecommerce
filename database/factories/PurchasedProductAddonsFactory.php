<?php

namespace Database\Factories;
use App\Models\Order;
use App\Models\ProductAddons;
use App\Models\Product;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchasedProductAddons>
 */
class PurchasedProductAddonsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "quantity" => fake()->randomNumber(1, 10),
            'addons_price' => fake()->randomFloat(2, 10, 1000),
            "order_id" => Order::all()->random(),
            "product_id" => Product::all()->random(),
            "product_addons_id" => ProductAddons::all()->random(),
        ];
    }
}
