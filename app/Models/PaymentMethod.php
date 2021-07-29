<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];

    /**
     * Payment Method - Payment Associaton HasMany Relation 1 : M
     * 
     * @return Relation
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
