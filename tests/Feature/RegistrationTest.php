<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    
    /** @group registration */
    public function test_register_page_can_be_visited()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('register'));

        $response->assertOk();

        $response->assertViewIs('auth.register');
    }


    /** @group registration */
    public function test_a_user_can_register()
    {
        $this->withoutExceptionHandling();

        //Arrange
        $userData = array_merge(User::factory()->make()->toArray(), [
            'password' => 'pa$$word',
            'password_confirmation' => 'pa$$word',
        ]);

        unset($userData['email_verified_at']);

        //dd($userData);

        //Act
        $response = $this->post(route('register'), $userData);

        //Assertions
        $this->assertAuthenticated();
    }
}
