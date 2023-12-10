<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'payment_id',
        'property_id',
        'seller_id',
        'amount',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
