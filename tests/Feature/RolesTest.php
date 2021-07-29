<?php

namespace Tests\Feature;

use App\Http\Livewire\Roles;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RolesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        /** @var Permission */
        $permission = Permission::firstOrCreate(['title' => 'roles-read']);

        /** @var Role */
        $role = Role::factory()->create();

        $role->permissions()->attach($permission);

        $this->actingAs(User::factory()->create(['role_id' => $role->id]));
    }
    
    /** @group roles */
    public function test_authorized_user_can_visit_roles_page()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get(route('roles.index'));

        $response->assertViewIs('roles.index');

        $response->assertSeeLivewire('roles');

        $response->assertOk();

    }


    /** @group roles */
    public function test_authorized_user_can_create_role()
    {
        $this->withoutExceptionHandling();

        $permissions = Permission::factory(3)->create()->pluck('id')->toArray();

        Livewire::test(Roles::class)
            ->set('title', 'Test Role')
            ->set('description', 'Some description for make me believe Role')
            ->set('permissions', $permissions)
            ->call('createRole');

        $this->assertTrue(Role::where('title', 'Test Role')->exists());

        $this->assertEquals(3, Role::where('title', 'Test Role')->first()->permissions()->count());
    }

    /** @group roles */
    public function test_authorized_user_can_update_role()
    {
        $this->withoutExceptionHandling();

        //Arrange
        $role = Role::factory()->create();
        $permissions = Permission::factory(3)->create()->pluck('id')->toArray();

        //Act
        Livewire::test(Roles::class)
            ->call('showRole', $role)
            ->set('title', 'Updated Role')
            ->set('permissions', $permissions)
            ->set('description', 'Some description for make me believe Role')
            ->call('updateRole');

        //Assert

        $this->assertFalse(Role::where('title', $role->title)->exists());

        $this->assertTrue(Role::where('title', 'Updated Role')->exists());

        $this->assertEquals(3, Role::where('title', 'Updated Role')->first()->permissions()->count());
    }

    /** @group roles */
    public function test_a_role_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        //Arrange
        $role = Role::factory()->create();

        //Act
        Livewire::test(Roles::class)
            ->call('deleteRole', $role)
            ->call('destroyRole');

        //Assert
        $this->assertFalse(Role::where('title', $role->title)->exists());

    }
    
}
