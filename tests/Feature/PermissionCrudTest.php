<?php

namespace Tests\Feature;

use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PermissionCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @group permissions */
    public function test_a_permission_can_be_stored_in_the_database()
    {
        $permissionData = Permission::factory()->make()->toArray();

        Permission::create($permissionData);

        $this->assertEquals(1, Permission::count());

        $this->assertTrue(Permission::where('title', $permissionData['title'])->exists());
    }
}
