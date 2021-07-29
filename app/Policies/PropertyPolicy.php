<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PropertyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return in_array('properties-read', $user->role->permissions->pluck('title')->toArray())
            ? Response::allow()
            : Response::deny('You lack sufficient permissions to view properties');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Property  $property
     * @return mixed
     */
    public function view(User $user, Property $property)
    {

        if($user->isAdmin()) return Response::allow();

        return (in_array('properties-read', $user->role->permissions->pluck('title')->toArray()) && $property->user->is($user))
            ? Response::allow()
            : Response::deny('You lack sufficient permissions to view properties');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array('properties-create', $user->role->permissions->pluck('title')->toArray())
            ? Response::allow()
            : Response::deny('You lack sufficient permissions to create a property');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Property  $property
     * @return mixed
     */
    public function update(User $user, Property $property)
    {
        return in_array('properties-update', $user->role->permissions->pluck('title')->toArray())
            ? Response::allow()
            : Response::deny('You lack sufficient permissions to updated property');

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Property  $property
     * @return mixed
     */
    public function delete(User $user, Property $property)
    {
        return in_array('properties-delete', $user->role->permissions->pluck('title')->toArray())
            ? Response::allow()
            : Response::deny('You lack sufficient permissions to delete a property');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Property  $property
     * @return mixed
     */
    public function restore(User $user, Property $property)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Property  $property
     * @return mixed
     */
    public function forceDelete(User $user, Property $property)
    {
        //
    }
}
