<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            'code' => "",
            'order_city' => "",
            'client_id' => "",
            'payment_type' => "",
            'payment_status' => "",
            'processing_status' => "",
            'total_amount' => "",
            'coupon_id' => 1
        ]);
    }
}
