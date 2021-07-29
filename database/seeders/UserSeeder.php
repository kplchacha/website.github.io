<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Seed an admin
        $adminRole = Role::firstOrCreate(['title' => 'Admin']);

        User::factory()->create([
            'email' => 'admin@arentiq.com',
            'role_id' => $adminRole->id
        ]);

        // Seed some property owners
        $propertyOwnerRole = Role::firstOrCreate(['title' => 'Property Owner']);
        User::factory()->create([
            'email' => 'property-owner@arentiq.com',
            'role_id' => $propertyOwnerRole->id
        ]);
        User::factory(4)->create(['role_id' => $propertyOwnerRole->id]);

        // Seed some tenants
        $tenantRole = Role::firstOrCreate(['title' => 'Tenant']);
        User::factory()->create([
            'email' => 'tenant@arentiq.com',
            'role_id' => $tenantRole->id
        ]);        
        User::factory(32)->create(['role_id' => $tenantRole->id]);

    }
}
