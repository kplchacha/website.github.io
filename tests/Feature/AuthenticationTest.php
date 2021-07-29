<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @group auth */
    public function test_login_page_can_be_visited()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('login'));

        $response->assertOk();
        
        $response->assertViewIs('auth.login');
    }

    /** @group auth */
    public function test_a_user_can_login_with_correct_credentials()
    {
        $this->withoutExceptionHandling();

        //Arrange

        //Create user in the database
        $userData = User::factory()->create()->toArray();

        //Act
        $this->post(route('login'), [
            'email' => $userData['email'],
            'password' => 'password'
        ]);

        //Assert
        $this->assertAuthenticated();
        
    }

    /** @group auth */
    public function test_incorrect_credentials_login_is_invalid()
    {
        //Act
        $response = $this->post(route('login'), [
            'email' => 'random@example.com',
            'password' => 'password'
        ]);

        //Assert
        $response->assertSessionHasErrors('email');
    }

    /** @group auth */
    public function test_a_logged_in_user_can_logout()
    {
        
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        Auth::login($user);

        $this->assertAuthenticated();

        $response = $this->post(route('logout'));

        $this->assertFalse(Auth::check());

        $response->assertRedirect(route('welcome'));
    }
}
