<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'description'];

    /**
     *  M : N Roles Permissions Relationship
     *  Defines the permissions granted to the role
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * 1 : M Role User Relationship
     * Indetifies user with this role
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
