<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Messages extends Component
{
    public User $user;

    public $content;

    /**
     * Called once when the component mount
     * 
     * @param User $user 
     */
    public function mount(User $user)
    {
        $this->user = $user;
    }

    /**
     * Re-renders the component when the state of the component is modified
     */
    public function render()
    {
        return view('livewire.messages', [
            'messages' => $this->getExchangedMessages()
        ]);
    }

    /**
     * Get messages of the current parties
     */
    public function getExchangedMessages()
    {
        /** @var User */
        $currentUser = Auth::user();

        $messageQuery = Message::query();

        $messageQuery->where(function($query) use($currentUser){
            $query->where('sender_id', $currentUser->id)
                ->where('recipient_id', $this->user->id);
        });

        $messageQuery->orWhere(function($query) use($currentUser){
            $query->where('sender_id', $this->user->id)
                ->where('recipient_id', $currentUser->id);
        });

        return $messageQuery->latest()->paginate(16);
    }

    public function rules()
    {
        return [
            'content' => ['required', 'string']
        ];
    }

    /**
     * Persists a message to the database
     */
    public function create()
    {
        /** @var User */
        $user = Auth::user();

        $data = $this->validate();

        $data['recipient_id'] = $this->user->id;

        $message = $user->messages()->create($data);

        if($message){

            $this->reset('content');

            $this->emit('hide-upsert-message-modal');
        }
        
    }

    /**
     * Show modal for reading the speficified message content
     */
    public function read(Message $message)
    {
        /** @var User */
        $user = Auth::user();

        if ($user->is($message->recipient)) $message->update(['read_at' => now()]);

        $this->content = $message->content;

        $this->emit('show-read-message-modal');
        
    }

    /**
     * Deletes a message record from the database
     */
    public function delete(Message $message)
    {
        $message->delete();
    }
}
