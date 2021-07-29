<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PaymentPolicy
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
        return in_array('payments-read', $user->role->permissions->pluck('title')->toArray())
            ? Response::allow()
            : Response::deny('You lack sufficient permissions to view payments');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payment  $payment
     * @return mixed
     */
    public function view(User $user, Payment $payment)
    {
        return in_array('payments-read', $user->role->permissions->pluck('title')->toArray())
            ? Response::allow()
            : Response::deny('You lack sufficient permissions to view a payment');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array('payments-create', $user->role->permissions->pluck('title')->toArray())
            ? Response::allow()
            : Response::deny('You lack sufficient permissions to create a payment');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payment  $payment
     * @return mixed
     */
    public function update(User $user, Payment $payment)
    {
        return in_array('payments-update', $user->role->permissions->pluck('title')->toArray())
            ? Response::allow()
            : Response::deny('You lack sufficient permissions to update a payment');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payment  $payment
     * @return mixed
     */
    public function delete(User $user, Payment $payment)
    {
        return in_array('payments-delete', $user->role->permissions->pluck('title')->toArray())
            ? Response::allow()
            : Response::deny('You lack sufficient permissions to update a payment');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payment  $payment
     * @return mixed
     */
    public function restore(User $user, Payment $payment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payment  $payment
     * @return mixed
     */
    public function forceDelete(User $user, Payment $payment)
    {
        //
    }
}
