<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'role_id',
        'password',
        'approved',
        'active',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * M : 1 User Role Relationship
     */
    public function role()
    {
        return $this->belongsTo(Role::class)
            ->withDefault([
                'title' => 'Default'
            ]);
    }

    /**
     * 1 : M Property Owner relation
     */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    /**
     * M : N Tenant Room Relation
     * 
     * @return mixed
     */
    public function rooms()
    {
        return $this->belongsToMany(Room::class)
            ->withTimestamps()
            ->withPivot('active', 'deleted_at')
            ->wherePivot('active', true)
            ->wherePivotNull('deleted_at')
            ->using(RoomUser::class);
    }

    /**
     * Check where this user instance has the admin role
     * 
     * @return bool true if admin else false
     */
    public function isAdmin()
    {
        return strtolower($this->role->title) === strtolower('Admin');
    }

    /**
     * Check where this user instance has the property owner role
     * 
     * @return bool true if admin else false
     */
    public function isPropertyOwner()
    {
        return strtolower($this->role->title) === strtolower('Property Owner');
    }

    /**
     * Check where this user instance has the tenant role
     * 
     * @return bool true if admin else false
     */
    public function isTenant()
    {
        return strtolower($this->role->title) === strtolower('Tenant');
    }

    /**
     * Query Scope Method to get users of the specified roles(s)
     * 
     * @return Query
     */
    public function scopeGroup($query, array $roleIds)
    {
        return $query->whereIn('role_id', $roleIds);
    }

    /**
     * Current User with their sent messages
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * User Payments Association using 1 : M relation
     * 
     * @return Relation
     */
    public function rentPayments()
    {
        return $this->hasMany(Payment::class, 'tenant_id');
    }
}
