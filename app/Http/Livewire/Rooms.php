<?php

namespace App\Http\Livewire;

use App\Models\Property;
use App\Models\Role;
use App\Models\Room;
use App\Models\User;
use Livewire\Component;

class Rooms extends Component
{
    public ?Property $property = null;

    public $label;
    public $cost;
    public $description;

    public $roomId;

    public $user_id;

    /**
     * Renders the room component
     * 
     * @return View
     */
    public function render()
    {

        return view('livewire.rooms', [
            'rooms' => $this->readRooms(),
            'users' => $this->readTenants()
        ]);
    }

    /**
     * Defines room fields validation rules
     * 
     * @return array of the rules
     */
    public function rules()
    {
        return [
            'label' => ['bail', 'required', 'string', 'max:255'],
            'cost' => ['bail', 'required', 'numeric'],
            'description' => ['bail', 'nullable', 'string']
        ];
    }

    /**
     * Creates a new property room in the database
     */
    public function createRoom()
    {
        $data = $this->validate();
        
        if(boolval($this->property)){

            $room = $this->property->rooms()->create($data);

            if($room){

                $this->reset(['label', 'description', 'cost']);
                
                $this->emit('hideUpsertRoomModal');
            }
            
        }
        
    }

    /**
     * Retrieves rooms of the current property from the database
     * 
     * @return Collection of rooms belong to the property
     */
    public function readRooms()
    {
        return $this->property->rooms;
    }

    /**
     * Retrieve all users from the database
     * 
     * @return Collection of db users
     */
    public function readTenants()
    {
        $role = Role::firstOrCreate(['title' => 'Tenant']);

        return User::group([$role->id])->get(['id', 'name']);
    }

    /**
     * Updates current property room
     */
    public function updateRoom()
    {
        $data = $this->validate();

        $room = Room::find($this->roomId);

        if ($room) {

            $room->update($data);

            $this->reset(['label', 'description', 'cost', 'roomId']);
                
            $this->emit('hideUpsertRoomModal');
        }
        
    }

    /** 
     * Deletes a room from the database
     */
    public function deleteRoom()
    {

        $room = Room::find($this->roomId);

        if ($room) {

            $room->delete();

            $this->reset(['label', 'description', 'cost', 'roomId']);
                
            $this->emit('hideDeleteRoomModal');
        }        
    }

    /**
     * Leases a room to a user and persists the information
     */
    public function letRoom()
    {
        $data = $this->validate(['user_id' => ['bail', 'required', 'numeric']]);

        /** @var Room */
        $room = Room::find($this->roomId);

        if ($room) {

            $room->users()->attach($data['user_id']);

            $this->reset(['label', 'description', 'cost', 'roomId', 'user_id']);
                
            $this->emit('hideLetRoomModal');
        }
    }

    /**
     * Shows the modal for editing a property room
     */
    public function editRoom(Room $room)
    {
        $this->roomId = $room->id;

        $this->label = $room->label;
        $this->cost = $room->cost;
        $this->description = $room->description;

        $this->emit('showUpsertRoomModal');
    }


    /**
     * Shows a modal room deletion modal
     * 
     * @param Room $room the one to delete
     */
    public function showDeleteRoomModal(Room $room)
    {
        $this->roomId = $room->id;

        $this->label = $room->label;
        
        $this->emit('showDeleteRoomModal');
    }

    /**
     * Shows the modal for letting a room to a user
     * 
     * @param Room $room to let
     */
    public function showLetRoomModal(Room $room)
    {
        $this->roomId = $room->id;

        $this->label = $room->label;
        
        $this->emit('showLetRoomModal');
        
    }
}
