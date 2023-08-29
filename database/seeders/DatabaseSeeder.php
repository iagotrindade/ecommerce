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

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Client::factory(20)->create();

        Order::factory(50)->create();

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


        Product::factory(400)->create();
    }


    // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
}
