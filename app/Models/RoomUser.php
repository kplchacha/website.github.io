<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RoomUser extends Pivot
{

    protected $fillable = ['active', 'deleted_at'];

    protected $casts = [
        'deleted_at' => 'datetime'
    ];

    /**
     * M : 1 Tenancy User reltionship
     * 
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * M : 1 Tenancy Room Relation
     * 
     * @return mixed
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * 1 : M Tenancy Payment Relation
     * 
     * @return mixed
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'room_user_id')
            ->latest();
    }

}
