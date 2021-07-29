<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @group roles */
    public function test_a_role_can_be_create()
    {
        $this->withoutExceptionHandling();

        //Arrange
        $roleData = Role::factory()->make()->toArray();

        //Act
        Role::create($roleData);

        //Assert
        $this->assertTrue(Role::where('title', $roleData['title'])->exists());
    }
}
