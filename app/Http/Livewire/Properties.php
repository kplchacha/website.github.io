<?php

namespace App\Http\Livewire;

use App\Models\Property;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Properties extends Component
{
    public $name;
    public $user_id;
    public $location = [
        ['key' => '', 'value' => '']
    ];
    public $description;

    public $propertyId;

    /**
     * Renders the Properties full page component
     */
    public function render()
    {
        return view('livewire.properties',[
            'properties' => $this->readProperties(),
            'users' => $this->readPropertyOwners(),
            'locationKeys' => Property::locationKeys()
        ]);
    }

    /**
     * Define rules for the property fields
     * 
     * @return array of the rules
     */
    protected function rules()
    {
        return [
            'name' => ['bail', 'string', 'required', 'max:255', Rule::unique('properties')->ignore($this->propertyId)],
            'user_id' => ['bail', 'required', 'numeric'],
            'location' => ['bail', 'array', 'nullable', 'min:1'],
            'location.*.key' => ['bail', 'string', 'required'],
            'location.*.value' => ['bail', 'string', 'required'],
            'description' => ['bail', 'string', 'nullable']
        ];
    }


    /**
     * Persisst a property to the database
     */
    public function createProperty()
    {

        $data = $this->validate();

        $location = [];

        if(array_key_exists('location', $data)){
            foreach ($data['location'] as  $item) {
                $location[$item['key']] = $item['value'];
            }
        }

        $data['location'] = $location;

        $property = Property::create($data);

        if(boolval($property)){

            $this->reset();

            $this->emit('hideUpsertPropertyModal');
        }
    }

    /**
     * Retrieve all properties from the database
     * 
     * @return Collection of all the propeties in the data
     */
    public function readProperties()
    {
        /** @var User */
        $currentUser = Auth::user();

        $propertiesQuery = Property::query();

        $propertiesQuery->with('user');

        if($currentUser->isPropertyOwner()){
            $propertiesQuery->where('user_id', $currentUser->id);
        }

        return $propertiesQuery->latest()->get(['id', 'name', 'user_id']);
        
    }

    /**
     * Update a database property entry fields
     */
    public function updateProperty()
    {
        $data = $this->validate();

        $property = Property::find($this->propertyId);

        if(boolval($property)){

            $location = [];
    
            if(array_key_exists('location', $data)){
                foreach ($data['location'] as  $item) {
                    $location[$item['key']] = $item['value'];
                }
            }
    
            $data['location'] = $location;

            $property->update($data);
            
            $this->reset();

            $this->emit('hideUpsertPropertyModal');

        }
        
    }

    /**
     * Delete a property entry from the database
     */
    public function deleteProperty()
    {        
        
        $property = Property::find($this->propertyId);

        if(boolval($property)){

            $property->delete();
            
            $this->reset();

            $this->emit('hideDeletePropertyModal');

        }
        
    }

    /**
     * Retrieve all users from the database
     * 
     * @return Collection
     */
    public function readPropertyOwners()
    {
        $role = Role::firstOrCreate(['title' => 'Property Owner']);

        return User::group([$role->id])->get(['id', 'name']);
    }

    /**
     * Remove a location items from the array
     * 
     * @param $location index
     */
    public function removeLocationItem($index)
    {

        if(count($this->location) > 1){

            unset($this->location[$index]);
    
            $this->location = array_values($this->location);
        }
        
    }

    /**
     * Adds an item to the location array
     */
    public function addLocationItem()
    {
        $this->location[] = ['key' => '', 'value' => ''];
    }

    /**
     * Show upsert modal for editing property details
     * 
     * @param Property $property
     */
    public function editProperty(Property $property)
    {
        $this->propertyId = $property->id;

        $this->name = $property->name;
        $this->user_id = $property->user_id;
        $this->description = $property->description;

        $this->location = [];

        if(boolval($property->location)){

            foreach ($property->location as  $key => $value) {
                $this->location[] = ['key' => $key, 'value' => $value];
            }

        }else{

            $this->addLocationItem();
        }

        $this->emit('showUpsertPropertyModal');
    }

    /**
     * Show the modal for deleting a property
     * 
     * @param Property $property the one to delete
     */
    public function showDeleteProperty(Property $property)
    {
        $this->propertyId = $property->id;

        $this->name = $property->name;

        $this->emit('showDeletePropertyModal');
        
    }
}
