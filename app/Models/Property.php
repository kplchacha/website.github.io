<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'location',
        'description'
    ];

    protected $casts = [
        'location' => 'array'
    ];

    /**
     * Define sample location key items
     * 
     * @return array of sample keys
     */
    public static function locationKeys() : array
    {
        return [
            'County',
            'Constituency',
            'Ward',
            'Street',
            'City',
            'Address'
        ];
    }

    /**
     * M : 1 Property Owner Relation
     * 
     * @return mixed Relation
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 1 : M Property Rooms Relation
     * 
     * @return mixed
     */
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    /**
     * Property Tenancy Relation through Room
     * 
     * @return mixed
     */
    public function tenancies()
    {
        return $this->hasManyThrough(
            RoomUser::class, 
            Room::class,
            'property_id',
            'room_id',
            'id',
            'id'
        )->where('active', true);
        
    }

    /**
     * Making Property Messageable
     * 
     * @return mixed
     */
    public function messages()
    {
        return $this->morphMany(Message::class, 'messageable');
    }
}
