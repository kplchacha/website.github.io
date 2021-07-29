<?php

namespace Tests\Feature;

use App\Models\PaymentMethod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @group payments */
    public function test_payment_method_can_be_created()
    {
        $this->withoutExceptionHandling();

        $paymentMethodData = PaymentMethod::factory()->make()->toArray();

        PaymentMethod::create($paymentMethodData);

        $this->assertTrue(PaymentMethod::where('name', $paymentMethodData['name'])->exists());

    }
}
