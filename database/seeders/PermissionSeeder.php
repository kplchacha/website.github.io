<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //Declare general resource permissions
        $permissions = [
            'access-dashboard',

            'roles-create',
            'roles-read',
            'roles-update',
            'roles-delete',

            'permissions-create',
            'permissions-read',
            'permissions-update',
            'permissions-delete',

            'users-create',
            'users-read',
            'users-update',
            'users-delete',

            'payment-methods-create',
            'payment-methods-read',
            'payment-methods-update',
            'payment-methods-delete',

            'payments-create',
            'payments-read',
            'payments-update',
            'payments-delete',

            'properties-create',
            'properties-read',
            'properties-update',
            'properties-delete',

            'rooms-create',
            'rooms-read',
            'rooms-update',
            'rooms-delete',
        ];

        //Create the permisions

        array_walk($permissions, fn($permission) => Permission::create(['title' => $permission]));
    }
}
