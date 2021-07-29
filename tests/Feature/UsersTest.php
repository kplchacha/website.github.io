<?php

namespace Tests\Feature;

use App\Http\Livewire\Users;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp() : void
    {
        parent::setUp();

        /** @var Permission */
        $permission = Permission::firstOrCreate(['title' => 'users-read']);

        /** @var Role */
        $role = Role::factory()->create();

        $role->permissions()->attach($permission);

        $this->actingAs(User::factory()->create(['role_id' => $role->id]));
    }

    /** @group users */
    public function test_authorized_can_view_users_page()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('users.index'));

        $response->assertOk();

        $response->assertViewIs('users.index');

        $response->assertSeeLivewire('users');
    }

    /** @group users */
    public function test_an_authorized_user_can_view_users_of_a_particular_group()
    {
        $this->withoutExceptionHandling();

        /** @var Role */
        $role = Role::factory()->create();
        User::factory(5)->create(['role_id' => $role->id]);

        $response = $this->get(route('roles.users.index', $role));

        $response->assertOk();

        $response->assertViewIs('roles.users');

        $response->assertViewHasAll(['role']);

        $response->assertSeeLivewire('users');
        
    }

    /** @group users */
    public function test_authorized_can_delete_a_user()
    {
        $this->withoutExceptionHandling();

        /** @var User */
        $user = User::factory()->create();

        Livewire::test(Users::class)
            ->call('showDeleteUserModal', $user)
            ->call('deleteUser');
        
        $this->assertFalse(User::where('email', $user->email)->exists());
        
    }

    /** @group users */
    public function test_authorized_can_change_a_user_role()
    {
        $this->withoutExceptionHandling();

        /** @var User */
        $user = User::factory()->create(['role_id' => Role::factory()->create()->id]);

        $role = Role::factory()->create();

        Livewire::test(Users::class)
            ->call('showChangeRoleModal', $user)
            ->set('role_id', $role->id)
            ->call('changeUserRole');
        
        $this->assertEquals($user->fresh()->role_id, $role->id);
        
    }

    /** @group users */
    public function test_an_authorized_user_can_create_a_user()
    {
        $this->withoutExceptionHandling();

        $role = Role::factory()->create();

        Livewire::test(Users::class)
            ->set('name', $name = $this->faker->name)
            ->set('email', $email = $this->faker->unique()->safeEmail)
            ->set('phone', $phone = $this->faker->unique()->e164PhoneNumber)
            ->set('password', 'elephant69')
            ->set('role_id', $role->id)
            ->call('create');

        $this->assertTrue(User::where('name', $name)->exists());
        $this->assertTrue(User::where('email', $email)->exists());
        $this->assertTrue(User::where('phone', $phone)->exists());

        /** @var User */
        $user = User::where('email', $email)->first();

        $this->assertTrue($user->role->is($role));
        
    }

    /** @group users */
    public function test_an_authorized_user_can_update_a_user()
    {
        $this->withoutExceptionHandling();

        /** @var User */
        $user = User::factory()->create();

        /** @var Role */
        $role = Role::factory()->create();

        Livewire::test(Users::class)
            ->call('edit', $user)
            ->set('name', $name = $this->faker->name)
            ->set('email', $email = $this->faker->unique()->safeEmail)
            ->set('phone', $phone = $this->faker->unique()->e164PhoneNumber)
            ->set('password', 'elephant69')
            ->set('role_id', $role->id)
            ->call('update');

        $this->assertEquals($name, $user->fresh()->name);
        $this->assertEquals($email, $user->fresh()->email);
        $this->assertEquals($phone, $user->fresh()->phone);

        $this->assertTrue($user->fresh()->role->is($role));
        
    }
}
