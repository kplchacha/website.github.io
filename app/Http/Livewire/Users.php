<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name;
    public $email;
    public $phone;
    public $role_id;
    public $password;

    public $userId;

    public ?Role $role;

    /**
     * Called once when the component is mounting
     * 
     * @param Role $role
     */
    public function mount(?Role $role = null)
    {
        $this->role = $role;
    }

    /**
     * Renders the users component
     */
    public function render()
    {
        return view('livewire.users', [
            'users' => $this->readUsers(),
            'roles' => $this->readRoles()
        ]);
    }

    /**
     * Properties validation rules
     * 
     * @return array of the rules
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->userId)],
            'phone' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($this->userId)],
            'password' => ['required', 'string'],
            'role_id' => []
        ];
    }

    /**
     * Persists a new user to the database
     */
    public function create()
    {
        $data = $this->validate();

        $user = User::create($data);

        if($user){

            $this->reset('name', 'email', 'phone', 'password', 'role_id');

            $this->emit('hide-upsert-user-modal');
            
        }
        
    }

    /**
     * Get all user from the database
     */
    public function readUsers()
    {
        $usersQuery = User::query();

        if(!is_null($this->role) && request()->routeIs('roles.users.index')) $usersQuery->group([$this->role->id]);

        return $usersQuery->latest()->paginate(20);
    }

    /**
     * Retrieve all roles from the database
     * 
     * @return Collection of all retrived roles
     */
    public function readRoles()
    {
        return Role::all(['id', 'title']);
    }

    /**
     * Changing the current user role in the database
     */
    public function changeUserRole()
    {
        $data = $this->validate(['role_id' => ['bail', 'required', 'numeric']]);

        /** @var User */
        $user = User::find($this->userId);

        if ($user) {

            $user->update($data);

            $this->emit('hideChangeRoleModal');
            
        }
        
    }

    /**
     * Soft delete a user from the database
     */
    public function deleteUser()
    {
        /** @var User */
        $user = User::find($this->userId);

        if($user){

            $user->delete();

            $this->emit('hideDeleteUserModal');
        }
    }

    /**
     * Show user deletion modal
     * 
     * @param User $user to delete
     */
    public function showDeleteUserModal(User $user)
    {
        $this->name = $user->name;

        $this->userId = $user->id;

        $this->emit('showDeleteUserModal');
    }

    public function showChangeRoleModal(User $user)
    {
        $this->name = $user->name;

        $this->userId = $user->id;

        $this->role_id = $user->role_id;

        $this->emit('showChangeRoleModal');
        
    }

    /**
     * Show the modal for editing a user
     */
    public function edit(User $user)
    {
        $this->userId = $user->id;

        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->role_id = $user->role_id;

        $this->emit('show-upsert-user-modal');
        
    }

    /**
     * Updates a user entry in the database
     */
    public function update()
    {
        /** @var User */
        $user = User::find($this->userId);

        if($user){

            $data = $this->validate();

            $data['password'] = Hash::make($data['password']);

            $user->update($data);

            $this->reset('userId', 'name', 'email', 'phone', 'role_id', 'password');

            $this->emit('hide-upsert-user-modal');

        }
        
    }
}
