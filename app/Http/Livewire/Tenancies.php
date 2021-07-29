<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Property;
use App\Models\RoomUser;
use Illuminate\View\View;

class Tenancies extends Component
{
    public $name;
    public $label;

    public $roomUserId;

    public ?Property $property = null;

    /**
     * Renders the tenancy modal
     * 
     * @return View
     */
    public function render()
    {
        return view('livewire.tenancies', ['tenancies' => $this->property->tenancies]);
    }
    
    /**
     * Shows the modal for revoking a tenancy
     * 
     * @param RoomUser $roomUser the tenancy itself
     */
    public function showRevokeTenancyModal(RoomUser $roomUser)
    {
        $this->roomUserId = $roomUser->id;

        $this->name = $roomUser->user->name;

        $this->label = $roomUser->room->label;

        $this->emit('showRevokeTenancyModal');
    }

    /**
     * Ends the tenureship
     */
    public function revokeTenancy()
    {
        $roomUser = RoomUser::find($this->roomUserId);

        if($roomUser){

            $roomUser->update([
                'deleted_at' => now(),
                'active' => false
            ]);

            $this->emit('showRevokeTenancyModal');
        }

    }
}
