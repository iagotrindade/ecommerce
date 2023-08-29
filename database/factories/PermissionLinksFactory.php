<?php

namespace Database\Factories;
use App\Models\PermissionGroups;
use App\Models\PermissionItems;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PermissionLinks>
 */
class PermissionLinksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'permission_group_id' =>PermissionGroups::all()->random(),
            'permission_item_id' => PermissionItems::all()->random()
        ];
    }
}
