<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\PermissionItems;

class PermissionItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //MÍDEA PERMISSIONS
        DB::table('permission_items')->insert([
            'name' => 'Cadastrar Imagem na Galeria',
            'slug' => 'upload_image_to_gallery',
            'type' => 'gallery_access'
        ]);

        DB::table('permission_items')->insert([
            'name' => 'Deletar Imagem na Galeria',
            'slug' => 'delete_image_to_gallery',
            'type' => 'gallery_access'
        ]);

        //USERS PERMISSIONS

        DB::table('permission_items')->insert([
            'name' => 'Cadastrar Novo Usuário',
            'slug' => 'register_new_user',
            'type' => 'user_access'
        ]);

        DB::table('permission_items')->insert([
            'name' => 'Editar um Usuário',
            'slug' => 'edit_user',
            'type' => 'user_access'
        ]);

        DB::table('permission_items')->insert([
            'name' => 'Editar meu Usuário',
            'slug' => 'edit_my_user',
            'type' => 'user_access'
        ]);

        DB::table('permission_items')->insert([
            'name' => 'Deletar Usuário',
            'slug' => 'delete_user',
            'type' => 'user_access'
        ]);

        DB::table('permission_items')->insert([
            'name' => 'Deletar meu Usuário',
            'slug' => 'delete_my_user',
            'type' => 'user_access'
        ]);

        //PERMISSION GROUPS PERMISSIONS

        DB::table('permission_items')->insert([
            'name' => 'Registrar nova Permissão',
            'slug' => 'register_new_permission',
            'type' => 'permissions_access'
        ]);

        DB::table('permission_items')->insert([
            'name' => 'Editar Permissão',
            'slug' => 'edit_permission_group',
            'type' => 'permissions_access'
        ]);

        DB::table('permission_items')->insert([
            'name' => 'Deletar Permissão',
            'slug' => 'delete_permission_group',
            'type' => 'permissions_access'
        ]);
    }
}
