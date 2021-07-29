<?php

namespace Tests\Feature;

use App\Http\Livewire\Rooms;
use App\Models\Property;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RoomsTest extends TestCase
{
    use RefreshDatabase;

    /** @group rooms */
    public function test_a_room_can_be_created()
    {
        $this->withoutExceptionHandling();

        $property = User::factory()->create()
            ->properties()
            ->create(Property::factory()->make()->toArray());

        $roomData = Room::factory()->make()->toArray();

        Livewire::test(Rooms::class, ['property' => $property])
            ->set('label', $roomData['label'])
            ->set('cost', $roomData['cost'])
            ->set('description', $roomData['description'])
            ->call('createRoom');
        
        $this->assertTrue(Room::where('label', $roomData['label'])->exists());

        $this->assertEquals(1, $property->rooms()->count());

        $room = Room::where('label', $roomData['label'])->first();

        $this->assertEquals($roomData['cost'], $room->cost);
        $this->assertEquals($roomData['description'], $room->description);

    }

    /** @group rooms */
    public function test_a_room_can_be_update()
    {
        $this->withoutExceptionHandling();

        /** @var Property */
        $property = User::factory()->create()
            ->properties()
            ->create(Property::factory()->make()->toArray());

        $room = $property->rooms()->create(Room::factory()->make()->toArray());

        $roomData = Room::factory()->make()->toArray();

        Livewire::test(Rooms::class, ['property' => $property])
            ->call('editRoom', $room)
            ->set('label', $roomData['label'])
            ->set('cost', $roomData['cost'])
            ->set('description', $roomData['description'])
            ->call('updateRoom');
        
        $this->assertFalse(Room::where('label', $room->label)->exists());
        $this->assertTrue(Room::where('label', $roomData['label'])->exists());

        $this->assertEquals(1, $property->rooms()->count());

        $this->assertEquals($roomData['cost'], $room->fresh()->cost);
        $this->assertEquals($roomData['description'], $room->fresh()->description);
    }

    /** @group rooms */
    public function test_a_property_room_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        /** @var Property */
        $property = User::factory()->create()
            ->properties()
            ->create(Property::factory()->make()->toArray());

        $room = $property->rooms()->create(Room::factory()->make()->toArray());

        Livewire::test(Rooms::class, ['property' => $property])
            ->call('showDeleteRoomModal', $room)
            ->call('deleteRoom');
        
        $this->assertFalse(Room::where('label', $room->label)->exists());

        $this->assertEquals(0, $property->rooms()->count());

    }

    /** @group rooms */
    public function test_a_property_room_can_be_let()
    {
        $this->withoutExceptionHandling();

        /** @var Property */
        $property = User::factory()->create()
            ->properties()
            ->create(Property::factory()->make()->toArray());

        $room = $property->rooms()->create(Room::factory()->make()->toArray());

        /** @var User */
        $user = User::factory()->create();

        Livewire::test(Rooms::class, ['property' => $property])
            ->call('showLetRoomModal', $room)
            ->set('user_id', $user->id)
            ->call('letRoom');
        
        $this->assertEquals(1, $user->rooms()->count());

    }

}
