<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PropertyPersistenceTest extends TestCase
{
    
    use RefreshDatabase;

    /** @group properties */
    public function test_a_property_can_be_created()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $propertyData = array_merge(
            Property::factory()->make()->toArray(),
            [
                'location' => [
                    'city' => 'Nairobi',
                    'Avenue' => 'Moi Avenue',
                    'county' => 'Nairobi'
                ],
                'user_id' => $user->id
            ]
        );


        Property::create($propertyData);

        $this->assertTrue(Property::where('name', $propertyData['name'])->exists());

        $this->assertEquals('Nairobi', Property::first()->location['city']);
    }
}
