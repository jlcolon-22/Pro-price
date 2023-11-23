<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
        'purpose',
        'details',
        'agent_id',
        'status',
        'property_id',
        'buyer_id'
    ];
}
