<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoomPersistenceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @group rooms */
    public function test_a_property_room_can_be_added_to_the_database()
    {
        $this->withoutExceptionHandling();

        $property = User::factory()->create()
            ->properties()
            ->create(Property::factory()->make()->toArray());

        Room::create(array_merge(
            $roomData = Room::factory()->make()->toArray(),
            ['property_id' => $property->id]
        ));

        $this->assertTrue(Room::where('label', $roomData['label'])->exists());

        $room = Room::where('label', $roomData['label'])->first();

        $this->assertEquals($roomData['cost'], $room->cost);
        $this->assertEquals($roomData['description'], $room->description);

    }
}
