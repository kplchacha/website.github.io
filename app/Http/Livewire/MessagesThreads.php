<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MessagesThreads extends Component
{

    public $needle;

    public function render()
    {
        return view('livewire.messages-threads', [
            'users' => $this->getRecipients() 
        ]);
    }
    
    /**
     * Get all users that the currenu user can send message, the caretake / admin, 
     * the other tenants in the same property
     * 
     * @return Collection<User>
     */
    public function getRecipients()
    {
        /** @var User */
        $currentUser = Auth::user();

        $userQuery = User::query();

        if(!empty($this->needle)) $userQuery->where('name', 'like', "%{$this->needle}%");

        return $userQuery->orderBy('name', 'ASC')
            ->where('id', '!=', $currentUser->id)
            ->paginate(16);
    }
}
