<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserCrudTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_user_can_be_created_successfully()
    {
        
        $this->withoutExceptionHandling();

        $userData = array_merge(User::factory()->make()->toArray(), [
            'password' => Hash::make('pa$$word')
        ]);

        User::create($userData);

        $this->assertEquals(1, User::count());

        $theUser = User::first();

        $this->assertEquals($userData['name'], $theUser->name);
        $this->assertEquals($userData['email'], $theUser->email);
        $this->assertEquals($userData['phone'], $theUser->phone);
    }
}
