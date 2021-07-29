<?php

namespace App\Http\Livewire;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Roles extends Component
{

    /**
     * Role properties that are tracked by the modal
     */
    public $title;
    public $description;
    public $permissions = [];

    public $roleId;

    /**
     * Renders the component wherever it is mounted
     */
    public function render()
    {
        return view('livewire.roles', [
            'roles' => $this->readRoles(),
            'dbPermissions' => $this->readPermissions()
        ]);
    }

    /**
     * Defines the validation rules for the curent component
     * 
     * @return array validation rules
     */
    public function rules()
    {
        return [
            'title' => [
                'bail', 
                'required', 
                Rule::unique('roles')->ignore($this->roleId),
                'max:20'
            ],
            'description' => ['nullable'],
            'permissions' => ['array', 'min:1']
        ];
    }

    /**
     * Persists a new role to the database
     */
    public function createRole()
    {

        $data = $this->validate();

        $role = Role::create($data);

        $role->permissions()->sync($this->permissions);

        $this->reset();

        $this->emit('closeUpsertRoleModal');
    }

    /**
     * Reads all the roles from the database
     * 
     * @return Collection of Roles in the database
     */
    public function readRoles() : Collection
    {
        return Role::with(['users', 'permissions'])->latest()->get();
    }

    /**
     * Read all the permissions from the storage (database)
     * 
     * @return Collection of all the permissions
     */
    public function readPermissions() : Collection
    {
        $permissions = Permission::orderBy('title', 'DESC')->get(['id', 'title']);

        return $permissions;
    }

    /**
     * Update the fields of role in the database
     */
    public function updateRole()
    {
        $role = Role::find($this->roleId);

        if(boolval($role)){
            
            $data = $this->validate();

            $role->update($data);

            $role->permissions()->sync($this->permissions);

            $this->reset();

            $this->emit('closeUpsertRoleModal');
        }
    }

    /**
     * Delete a role entry from the persistance
     */
    public function destroyRole()
    {
        $role = Role::find($this->roleId);

        if (!in_array($role->title, ['Admin', 'Property Owner', 'Tenant'])) {
            
            if(boolval($role)){
                
                $role->delete();
    
                $this->emit('closeRoleDeletionModal');
            }
        }

    }

    /**
     * Show the upsert model for updating the role in questions
     * 
     * @param Role $role the role in question
     */
    public function showRole(Role $role)
    {
        $this->roleId = $role->id;

        $this->title = $role->title;

        $this->permissions = $role->permissions->pluck('id')->toArray();

        $this->description = $role->description;

        $this->emit('showUpsertRoleModal');
        
    }

    /**
     * Show the deletion modal for confirmation
     * 
     * @param Role $role, the role to delete
     */
    public function deleteRole(Role $role)
    {
        $this->roleId = $role->id;

        $this->title = $role->title;

        $this->emit('showRoleDeletionModal');
        
    }
}

