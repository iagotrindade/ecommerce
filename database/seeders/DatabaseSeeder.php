<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use App\Models\Order;
use App\Models\Image;
use App\Models\PermissionGroups;
use App\Models\PermissionItems;
use App\Models\PermissionLinks;
use App\Models\Product;
use App\Models\PurchasedProducts;
use App\Models\ProductAddons;
use App\Models\Adresses;
use App\Models\PurchasedProductAddons;
use App\Models\Categories;
use App\Models\QrCodes;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionGroupsSeeder::class
        ]);

        $this->call([
            PermissionItemsSeeder::class
        ]);

        PermissionLinks::factory(10)->create();

        $this->call([
            ImageSeeder::class
        ]);

        User::factory(1)->create();

        Categories::factory(3)->create();

        Product::factory(20)->create();

        //Order::factory(5)->create();

        //ProductAddons::factory(15)->create();

        //PurchasedProducts::factory(7)->create();

        //PurchasedProductAddons::factory(14)->create();

        //Adresses::factory(1)->create();
    }


    // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
}
