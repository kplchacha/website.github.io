<?php

namespace App\Policies;

use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PaymentMethodPolicy
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
        return in_array('payment-methods-read', $user->role->permissions->pluck('title')->toArray())
            ? Response::allow()
            : Response::deny('You lack sufficient permissions to view payment methods');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return mixed
     */
    public function view(User $user, PaymentMethod $paymentMethod)
    {
        return in_array('payment-methods-read', $user->role->permissions->pluck('title')->toArray())
            ? Response::allow()
            : Response::deny('You lack sufficient permissions to view a payment method');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array('payment-methods-create', $user->role->permissions->pluck('title')->toArray())
            ? Response::allow()
            : Response::deny('You lack sufficient permissions to create a payment method');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return mixed
     */
    public function update(User $user, PaymentMethod $paymentMethod)
    {
        return in_array('payment-methods-update', $user->role->permissions->pluck('title')->toArray())
            ? Response::allow()
            : Response::deny('You lack sufficient permissions to update a payment method');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return mixed
     */
    public function delete(User $user, PaymentMethod $paymentMethod)
    {
        return in_array('payment-methods-delete', $user->role->permissions->pluck('title')->toArray())
            ? Response::allow()
            : Response::deny('You lack sufficient permissions to delete a payment method');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return mixed
     */
    public function restore(User $user, PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return mixed
     */
    public function forceDelete(User $user, PaymentMethod $paymentMethod)
    {
        //
    }
}
