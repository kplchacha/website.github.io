<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageCrudTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    /** @group message  */
    public function test_a_user_to_user_message_can_be_create()
    {
        $this->withoutExceptionHandling();

        /** @var User */
        $sender = User::factory()->create();

        /** @var User */
        $recipient = User::factory()->create();
        
        $message = Message::create([
            'content' => $content = $this->faker->sentence(),
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id
        ]);

        $this->assertNotNull($message);

        $this->assertEquals($content, $message->content);
        $this->assertEquals($sender->id, $message->sender->id);
        $this->assertEquals($recipient->id, $message->recipient->id);

    }

}
