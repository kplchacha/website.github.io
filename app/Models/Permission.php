<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'description'];

    /**
     * M : N Permission Role Relationship
     * 
     * Loads roles granted this permission
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}