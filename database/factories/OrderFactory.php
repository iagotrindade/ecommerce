<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Client;

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
        $paymentStatus = rand(1,3);
        $processingStatus = rand(1,3);

        switch ($paymentStatus) {
            case 1:
                $paymentStatus = 'Pago';
                break;

            case 2:
                $paymentStatus = 'Pendente';
                break;

            case 3:
                $paymentStatus = 'Cancelado';
                break;
        }

        switch ($processingStatus) {
            case 1:
                $processingStatus = 'Processado';
                break;

            case 2:
                $processingStatus = 'Não Processado';
                break;

            case 3:
                $processingStatus = 'Cancelado';
                break;
        }

        return [
            'code' => "#".rand(10000, 99999),
            'client_id' => Client::all()->random(),
            'client_name' => fake()->name(30),
            'payment_type' => rand(1,4),
            'payment_status' => $paymentStatus,
            'processing_status' => $processingStatus,
            'coupon_id' => 1,
            'order_city' => fake()->city(),
            'total_amount' => rand(99,1999)
        ];
    }
}
