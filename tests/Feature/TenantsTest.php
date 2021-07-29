<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\Room;
use App\Models\RoomUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TenantsTest extends TestCase
{
    
    use RefreshDatabase, WithFaker;

    public function setUp() : void
    {
        parent::setUp();

        $user = User::factory()->create();

        $this->be($user);

    }

    /** @group tenants */
    public function test_authorized_view_single_tenant_page()
    {

        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $room = User::factory()->create() //Create a landlord
            ->properties()
            ->create(Property::factory()->make()->toArray()) // Create Property
            ->rooms()
            ->create(Room::factory()->make()->toArray()); // Create Room

        
        //Let a room to create a room user
        $room->users()->attach($user);

        /** @var RoomUser */
        $roomUser = RoomUser::first();

        $response = $this->get(route('tenants.show', $roomUser));

        $response->assertOk();

        $response->assertViewIs('tenants.show');

        $response->assertViewHas('roomUser');
    }
}
