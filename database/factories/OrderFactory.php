<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $random = rand(1,3);

        switch ($random) {
            case 1:
                $status = 'Cancelado';
                break;

            case 2:
                $status = 'Pendente';
                break;

            case 3:
                $status = 'Aceito';
                break;
        }

        switch ($random) {
            case 1:
                $type = 'Delivery';
                break;

            case 2:
                $type = 'Mesa';
                break;

            case 3:
                $type = 'Delivery';
                break;
        }

        return [
            'code' => "#".rand(10000, 99999),
            'user_id' => User::all()->random(),
            'payment_type' => rand(1,4),
            'type' => $type,
            'status' => $status,
            'coupon_id' => 1,
            'obs' => fake()->sentence(),
            'order_city' => fake()->city(),
            'total_amount' => rand(99,1999)
        ];
    }
}
