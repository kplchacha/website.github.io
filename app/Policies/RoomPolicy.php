<?php

namespace App\Policies;

use App\Models\Room;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RoomPolicy
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
        return in_array('rooms-read', $user->role->permissions->pluck('title')->toArray())
            ? Response::allow()
            : Response::deny('You lack sufficient permissions to view property rooms');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Room  $room
     * @return mixed
     */
    public function view(User $user, Room $room)
    {
        return in_array('rooms-read', $user->role->permissions->pluck('title')->toArray())
            ? Response::allow()
            : Response::deny('You lack sufficient permissions to view property room');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array('rooms-create', $user->role->permissions->pluck('title')->toArray())
            ? Response::allow()
            : Response::deny('You lack sufficient permissions to add property room');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Room  $room
     * @return mixed
     */
    public function update(User $user, Room $room)
    {
        return in_array('rooms-update', $user->role->permissions->pluck('title')->toArray())
            ? Response::allow()
            : Response::deny('You lack sufficient permissions to update property room');
    }

    /**
     * Determine whether the user can let a room.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Room  $room
     * @return mixed
     */
    public function let(User $user, Room $room)
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny('You lack sufficient permissions to update property room');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Room  $room
     * @return mixed
     */
    public function delete(User $user, Room $room)
    {
        return in_array('rooms-delete', $user->role->permissions->pluck('title')->toArray())
            ? Response::allow()
            : Response::deny('You lack sufficient permissions to delete a property room');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Room  $room
     * @return mixed
     */
    public function restore(User $user, Room $room)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Room  $room
     * @return mixed
     */
    public function forceDelete(User $user, Room $room)
    {
        //
    }
}
