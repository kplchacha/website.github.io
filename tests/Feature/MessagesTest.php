<?php

namespace Tests\Feature;

use App\Http\Livewire\Messages;
use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MessagesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @group message */
    public function test_a_default_user_can_visit_the_messages_page()
    {
        $this->withoutExceptionHandling();

        /** @var User */
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('messages.index'));

        $response->assertOk();

        $response->assertViewIs('messages.index');

        $response->assertSeeLivewire('messages-threads');
        
    }

    /** @group message */
    public function test_end_to_end_messages_for_a_user_can_be_seen()
    {
        $this->withoutExceptionHandling();

        /** @var User */
        $user = User::factory()->create();
        $this->actingAs($user);

        /** @var User */
        $user = User::factory()->create();

        $response = $this->get(route('users.messages.index', $user));

        $response->assertOk();

        $response->assertViewIs('users.messages.index');

        $response->assertViewHasAll(['user']);

        $response->assertSeeLivewire('messages');
        
    }

    /** @group message */
    public function test_a_user_can_create_a_message()
    {
        $this->withoutExceptionHandling();

        /** @var User */
        $currentUser = User::factory()->create();
        $this->actingAs($currentUser);

        /** @var User */
        $user = User::factory()->create();

        Livewire::test(Messages::class, ['user' => $user])
            ->set('content', $content = $this->faker->paragraph)
            ->call('create');

        $this->assertTrue(Message::where('content', $content)->exists());
        
    }

    /** @var Message */
    public function test_a_message_will_be_marked_rea_when_read()
    {
        $this->withoutExceptionHandling();

        /** @var User */
        $currentUser = User::factory()->create();
        $this->actingAs($currentUser);

        /** @var User */
        $user = User::factory()->create();

        $message = $user->messages()->create([
            'recipient_id' => $currentUser->id,
            'content' => $this->faker->paragraph
        ]);

        Livewire::test(Messages::class, ['user' => $currentUser])
            ->call('read', $message);

        $this->assertNotNull($message->read_at);
    }
}
