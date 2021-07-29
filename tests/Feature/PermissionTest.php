<?php

namespace Tests\Feature;

use App\Http\Livewire\Permissions;
use App\Models\Permission;
use App\Models\Role;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

class PermissionTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp() : void
    {
        parent::setUp();

        /** @var Permission */
        $permission = Permission::firstOrCreate(['title' => 'permissions-read']);

        /** @var Role */
        $role = Role::factory()->create();

        $role->permissions()->attach($permission);

        $this->actingAs(User::factory()->create(['role_id' => $role->id]));
    }
    
    /** @group permissions */
    public function test_authorized_user_can_visit_permissions_page()
    {
        $this->withoutExceptionHandling();

        $this->withoutMiddleware();

        $response = $this->get(route('permissions.index'));

        $response->assertViewIs('permissions.index');

        $response->assertSeeLivewire('permissions');

        $response->assertOk();
    }

    /** @group permissions */
    public function test_authorized_user_can_edit_a_permissions_description()
    {
        $this->withoutExceptionHandling();

        $permission = Permission::factory()->create();

        Livewire::test(Permissions::class)
            ->call('editPermission', $permission)
            ->set('description', 'Some description')
            ->call('updatePermission');
        
        $this->assertTrue(Permission::where('description', 'Some description')->exists());
    }

    /** @group permissions */
    public function test_authorized_user_can_delete_a_permission()
    {
        $this->withoutExceptionHandling();

        $permission = Permission::factory()->create();

        Livewire::test(Permissions::class)
            ->call('showDeletePermission', $permission)
            ->call('deletePermission');
        
        $this->assertFalse(Permission::where('title', $permission->title)->exists());        
        
    }
}
