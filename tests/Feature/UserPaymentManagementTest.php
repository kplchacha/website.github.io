<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserPaymentManagementTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @group payments */
    public function test_a_users_can_visit_their_rent_payment_page()
    {
        $this->withoutExceptionHandling();

        /** @var User */
        $currentUser = User::factory()->create();
        $this->actingAs($currentUser);

        $response = $this->get(route('user.payments'));

        $response->assertOk();

        $response->assertViewIs('user.payments');

        $response->assertViewHasAll(['payments']);
        
    }
}
