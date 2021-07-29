<?php

namespace App\Http\Livewire;

use App\Models\Permission;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Permissions extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public $title;
    public $description;

    public $permissionId;

    /**
     * Renders the component
     */
    public function render()
    {
        return view('livewire.permissions', [
            'permissions' => $this->readPermissions()
        ]);
    }

    /**
     * The validation rules for permission fields
     */
    public function rules()
    {
        return [
            'title' => ['bail', 'required', Rule::unique('permissions')->ignore($this->permissionId)],
            'description' => ['nullable', 'string']
        ];
    }

    /**
     * Get all permissions from storage in this case the database
     * 
     * @return Paginator
     */
    public function readPermissions()
    {
        return Permission::with('roles')->latest()->paginate();
    }

    /**
     * Update permission details in storage
     */
    public function updatePermission()
    {
        $data = $this->validate();

        $permission = Permission::find($this->permissionId);

        if($permission){

            $permission->update($data);

            $this->emit('closeEditPermissionModal');
        }
    }

    /**
     * Delete a permission from the storage (database)
     */
    public function deletePermission()
    {
        $permission = Permission::find($this->permissionId);

        if(boolval($permission)){
            
            $permission->delete();

            $this->emit('closePermissionDeletionModal');
        }
    }

    /**
     * Show the permission edit dialog
     */
    public function editPermission(Permission $permission)
    {
        $this->permissionId = $permission->id;

        $this->title = $permission->title;
        $this->description = $permission->description;

        $this->emit('showEditPermissionModal');
        
    }

    /**
     * Show the permission deletion confirmation modal
     */
    public function showDeletePermission(Permission $permission)
    {
        $this->permissionId = $permission->id;

        $this->title = $permission->title;
        //$this->description = $permission->description;

        $this->emit('showPermissionDeletionModal');
    }
}
