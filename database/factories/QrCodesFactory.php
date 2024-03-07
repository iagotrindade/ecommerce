<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class QrCodesFactory extends Factory
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
            'name' => fake()->name(),
            'qrcode' => fake()->url(),
            'status' => $status
        ];
    }
}
