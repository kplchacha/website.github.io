<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'content',
        'sender_id',
        'recipient_id',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime'
    ];

    /**
     * Association of a message and the sender of the message
     * 
     * @return Relation
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
        
    }

    /**
     * Association of a message and the recipient of the message
     * 
     * @return Relation
     */
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
        
    }
}
