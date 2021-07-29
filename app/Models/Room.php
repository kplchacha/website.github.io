<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'property_id', 
        'label', 
        'cost', 
        'description'
    ];

    /**
     *  M : 1 Room Property Realtion
     * 
     * @return mixed
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * M : N Room Tenants relationship
     * 
     * @return mixed
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps()
            ->withPivot('active', 'deleted_at')
            ->wherePivot('active', true)
            ->wherePivotNull('deleted_at')
            ->using(RoomUser::class);
    }

    /**
     * Checks the status of a room if occupied or not
     * 
     * @return string for the status
     */
    public function occupied() : bool
    {
        return boolval($this->users()->count());
    }
}
