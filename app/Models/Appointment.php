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

    public function propertyDetails()
    {
        return $this->belongsTo(Property::class,'property_id');
    }
    public function agentInfo()
    {
        return $this->belongsTo(Agent::class,'agent_id');
    }
    public function buyerInfo()
    {
        return $this->belongsTo(Buyer::class,'buyer_id');
    }
}
