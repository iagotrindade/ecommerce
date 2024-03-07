<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;


class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('images')->insert([
            "name" => 'avatars/adm/default_avatar.png'
        ]);

        DB::table('images')->insert([
            "name" => 'products/product_image.png'
        ]);



    }
}
