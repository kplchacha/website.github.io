<?php

namespace Tests\Feature;

use App\Http\Livewire\Tenancies;
use App\Models\Property;
use App\Models\Room;
use App\Models\RoomUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TenanciesTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    private ?User $user = null;
    private ?Room $room = null;
    private ?Property $property = null;

    public function setUp() : void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->property = User::factory()->create() //Create a landlord
            ->properties()
            ->create(Property::factory()->make()->toArray()); // Create Property
        $this->room = $this->property->rooms()
            ->create(Room::factory()->make()->toArray()); // Create Room

    }
    
    /** @group tenancies */
    public function test_tenureship_can_be_revoked()
    {

        //Let a room to create a room user
        $this->room->users()->attach($this->user);

        /** @var RoomUser */
        $roomUser = RoomUser::first();

        Livewire::test(Tenancies::class, ['property' => $this->property])
            ->call('showRevokeTenancyModal', $roomUser)
            ->call('revokeTenancy');

        $this->assertFalse(boolval($roomUser->fresh()->active));
        $this->assertNotNull($roomUser->fresh()->deleted_at);
    }
}
