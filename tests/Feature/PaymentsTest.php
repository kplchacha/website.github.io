<?php

namespace Tests\Feature;

use App\Http\Livewire\Payments;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Property;
use App\Models\Room;
use App\Models\RoomUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PaymentsTest extends TestCase
{
    use RefreshDatabase;

    private ?User $user = null;
    private ?Room $room = null;
    private ?PaymentMethod  $paymentMethod = null;

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

        $this->actingAs($this->user);

    }
    
    /** @group payments */
    public function test_a_payment_can_be_created_via_modal()
    {
        $this->withoutExceptionHandling();

        //Let a room to create a room user
        $this->room->users()->attach($this->user);

        $paymentsData = Payment::factory()->make()->toArray();

        Livewire::test(Payments::class, ['roomUser' => RoomUser::first()])
            ->set('amount', $paymentsData['amount'])
            ->set('description', $paymentsData['description'])
            ->set('payment_method_id', $this->paymentMethod->id)
            ->call('createPayment');

        $this->assertEquals(1, Payment::count());

        $this->assertEquals($paymentsData['amount'], Payment::first()->amount);
        $this->assertEquals($this->paymentMethod->id, Payment::first()->payment_method_id);
        
    }

    /** @group payments */
    public function test_payment_can_be_update()
    {
        $this->withoutExceptionHandling();

        //Let a room to create a room user
        $this->room->users()->attach($this->user);

        $roomUser = RoomUser::first();

        $payment = $roomUser->payments()->create(
            array_merge(
                Payment::factory()->make()->toArray(),
                ['payment_method_id' => $this->paymentMethod->id]
            )
        );

        $paymentsData = Payment::factory()->make()->toArray();

        Livewire::test(Payments::class, ['roomUser' => $roomUser])
            ->call('editPayment', $payment)
            ->set('amount', $paymentsData['amount'])
            ->set('description', $paymentsData['description'])
            ->set('payment_method_id', $this->paymentMethod->id)
            ->call('updatePayment');

        $this->assertEquals(1, Payment::count());

        $this->assertEquals($paymentsData['amount'], Payment::first()->amount);
        $this->assertEquals($this->paymentMethod->id, Payment::first()->payment_method_id);
                
    }

    /** @group payments */
    public function test_payment_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        //Let a room to create a room user
        $this->room->users()->attach($this->user);

        $roomUser = RoomUser::first();

        $payment = $roomUser->payments()->create(
            array_merge(
                Payment::factory()->make()->toArray(),
                ['payment_method_id' => $this->paymentMethod->id]
            )
        );

        Livewire::test(Payments::class, ['roomUser' => $roomUser])
            ->call('showDeletePaymentModal', $payment)
            ->call('deletePayment');

        $this->assertEquals(0, Payment::count());

    }

}
