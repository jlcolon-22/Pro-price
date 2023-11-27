<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'feedback','user_type','user_id'
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class,'user_id');
    }
    public function seller()
    {
        return $this->belongsTo(Seller::class,'user_id');
    }
    public function buyer()
    {
        return $this->belongsTo(Buyer::class,'user_id');
    }
}
