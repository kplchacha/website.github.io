<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_user_id',
        'recorder_id', //One who recorded the entry to the database
        'payment_method_id',
        'tenant_id',  //One who paid the rent
        'amount',
        'description'
    ];

    /**
     * M : 1 Payment and Payment Method Relation
     * 
     * @return mixed
     */
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
