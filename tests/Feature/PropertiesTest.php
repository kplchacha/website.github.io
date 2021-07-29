<?php

namespace Tests\Feature;

use App\Http\Livewire\Properties;
use App\Models\Permission;
use App\Models\Property;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PropertiesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp() : void
    {
        parent::setUp();

        /** @var Permission */
        $permission = Permission::firstOrCreate(['title' => 'properties-read']);

        /** @var Role */
        $role = Role::factory()->create();

        $role->permissions()->attach($permission);
        
        /** @var User */
        $user = User::factory()->create(['role_id' => $role->id]);

        $this->actingAs($user);
    }

    /** @group properties */
    public function test_authorized_user_can_view_appropriate_properties()
    {
        $this->withoutExceptionHandling();

        $this->withoutMiddleware();

        $response = $this->get(route('properties.index'));

        $response->assertOk();

        $response->assertViewIs('properties.index');

        $response->assertSeeLivewire('properties');
    }

    /** @group properties */
    public function test_authorized_user_can_create_property()
    {
        $this->withoutExceptionHandling();

        $propertyData = Property::factory()->make()->toArray();

        $user = User::factory()->create();

        Livewire::test(Properties::class)
            ->set('name', $propertyData['name'])
            ->set('description', $propertyData['description'])
            ->set('user_id', $user->id)
            ->set('location', [['key' => 'city', 'value' => 'Nairobi']])
            ->call('createProperty');


        $this->assertEquals(1, Property::count());

        $this->assertTrue(Property::where('name', $propertyData['name'])->exists());

        $this->assertEquals('Nairobi', Property::first()->location['city']);            
    }

    /** @group properties */
    public function test_authorized_user_can_update_a_property()
    {
        $this->withoutExceptionHandling();

        $property = User::factory()->create()
            ->properties()
            ->create(Property::factory()->make()->toArray());
            
        Livewire::test(Properties::class)
            ->call('editProperty', $property)
            ->set('name', 'Test Name')
            ->set('description', 'Test Description')
            ->set('location', [['key' => 'city', 'value' => 'Nairobi']])
            ->call('updateProperty');

        $this->assertEquals('Test Name', $property->fresh()->name);
        $this->assertEquals('Test Description', $property->fresh()->description);
    }

    /** @group properties */
    public function test_authorized_user_can_delete_a_property()
    {
        $this->withoutExceptionHandling();

        $property = User::factory()->create()
            ->properties()
            ->create(Property::factory()->make()->toArray());
            
        Livewire::test(Properties::class)
            ->call('showDeleteProperty', $property)
            ->call('deleteProperty'); 

        $this->assertEquals(0, Property::count());
    }

    /** @group properties */
    public function test_authorized_user_can_visit_a_properties_show_page()
    {
        $this->withoutExceptionHandling();

        $property = User::factory()->create()
            ->properties()
            ->create(Property::factory()->make()->toArray());
        
        $response = $this->get(route('properties.show', $property));

        $response->assertOk();

        $response->assertViewIs('properties.show');

        $response->assertViewHas('property');

        $response->assertSeeLivewire('rooms');

        $response->assertSeeLivewire('tenancies');
    }
}
