<?php

namespace Tests\Feature;

use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Property;
use App\Models\Room;
use App\Models\RoomUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentPersistenceTest extends TestCase
{

    private ?User $user = null;
    private ?Room $room = null;
    private ?PaymentMethod $paymentMethod = null;

    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->room = User::factory()->create() //Create a landlord
            ->properties()
            ->create(Property::factory()->make()->toArray()) // Create Property
            ->rooms()
            ->create(Room::factory()->make()->toArray()); // Create Room

        $this->paymentMethod = PaymentMethod::factory()->create();

    }
    
    /** @group payments */
    public function test_a_payment_can_be_added()
    {
        //Let a room to create a room user
        $this->room->users()->attach($this->user);

        $paymentData = Payment::factory()->make()->toArray();

        /** @var RoomUser */
        $roomUser = RoomUser::first();

        Payment::create(
            array_merge($paymentData, 
                [
                    'payment_method_id' => $this->paymentMethod->id,
                    'room_user_id' => $roomUser->id
                ]
            )
        );
                

        $this->assertEquals(1, Payment::count());
    }
}
