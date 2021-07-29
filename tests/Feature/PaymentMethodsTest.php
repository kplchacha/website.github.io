<?php

namespace Tests\Feature;

use App\Http\Livewire\PaymentMethods;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PaymentMethodsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp() : void
    {
        parent::setUp();

        $user = User::factory()->create();

        $this->be($user);

    }

    /** @group payments */
    public function test_authorized_user_can_view_all_payment_methods()
    {
        $this->withoutExceptionHandling();

        $this->withoutMiddleware();

        $response = $this->get(route('payment-methods.index'));

        $response->assertOk();

        $response->assertViewIs('payment-methods.index');

        $response->assertSeeLivewire('payment-methods');

    }

    /** @group payments */
    public function test_authorized_user_can_create_a_payment_method()
    {
        $this->withoutExceptionHandling();

        Livewire::test(PaymentMethods::class)
            ->set('name', 'Cash')
            ->call('createPaymentMethod');

        $this->assertTrue(PaymentMethod::where('name', 'Cash')->exists());
    }

    /** @group payments */
    public function test_authorized_user_can_update_a_payment_method()
    {
        $this->withoutExceptionHandling();

        $paymentMethod = PaymentMethod::factory()->create();

        Livewire::test(PaymentMethods::class)
            ->call('editPaymentMethod', $paymentMethod)
            ->set('name', 'Test Name')
            ->call('updatePaymentMethod');

        $this->assertEquals($paymentMethod->fresh()->name, 'Test Name');
        
    }

    /** @group payments */
    public function test_authorized_user_can_delete_a_payment_method()
    {
        $this->withoutExceptionHandling();

        $paymentMethod = PaymentMethod::factory()->create();

        Livewire::test(PaymentMethods::class)
            ->call('showDeleteModal', $paymentMethod)
            ->call('deletePaymentMethod');

        $this->assertFalse(PaymentMethod::where('name', $paymentMethod->name)->exists());
    }
}
