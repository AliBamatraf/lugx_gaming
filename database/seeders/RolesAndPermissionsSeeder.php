<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //permissions used in website 
        $permissions = [
            'Add Category',
            'Edit Category',
            'Delete Category',
            'Add Game',
            'Edit Game',
            'Delete Game',
            'Purchaes Game'
        ];

        foreach ($permissions as $permission) {
            //create permissions
            Permission::create([
                'name' => $permission
            ]);
        }

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleUser = Role::create(['name' => 'user']);

        $roleAdmin->givePermissionTo( Permission::all()->where('name', '!=', 'Purchaes Game'));
        $roleUser->givePermissionTo('Purchaes Game');
    }
}
