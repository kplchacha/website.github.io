<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create the Admin Role and Grant all permissions

        $rolesData = [
            [
                'title' => 'Admin',
                'description' => 'The most powerful role in the system'
            ],
            [
                'title' => 'Property Owner',
                'description' => 'Property owners and other property managers maybe'
            ],
            [
                'title' => 'Tenant',
                'description' => 'The very basic role'
            ],
        ];

        DB::table('roles')->insert($rolesData);

        $adminRole = Role::firstOrCreate(
            ['title' => 'Admin'],
            ['description' => 'The most powerful role in the system']
        );

        //Grant All Permissions to the Admin Role
        $permissions = Permission::all(['id'])->pluck('id')->toArray();
        
        $adminRole->permissions()->sync($permissions);

    }
}
