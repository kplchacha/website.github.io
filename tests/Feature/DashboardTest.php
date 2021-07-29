<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    
    use RefreshDatabase, WithFaker;

    public function setUp() : void
    {
        parent::setUp();

        /** @var Permission */
        $permission = Permission::firstOrCreate(['title' => 'access-dashboard']);

        /** @var Role */
        $role = Role::factory()->create();

        $role->permissions()->attach($permission);

        $this->actingAs(User::factory()->create(['role_id' => $role->id]));
    }


    
    /** @group dashoboard */
    public function test_authorized_can_visit_dashboard()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('dashboard'));

        $response->assertOk();

        $response->assertViewIs('dashboard');

        $response->assertViewHasAll([
            'propertiesCount', 
            'usersCount', 
            'propertyOwnersCount', 
            'tenantsCount',
            'rolesCount',
            'permissionsCount',
            'paymentMethodsCount'
        ]);
    }
}
