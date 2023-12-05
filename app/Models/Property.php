<?php

namespace App\Models;

use App\Models\Agent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'floor_area',
        'floor_number',
        'status',
        'land_size',
        'price',
        'seller_id',
        'bed_room',
        'bath_room',
        'address',
        'description',
        'user_type',
        'agent_id',
        'title_copy',
        'longitude',
        'latitude',
        'area_situation',
        'views'
    ];

    public function photo()
    {
        return $this->hasOne(PropertyPhoto::class ,'property_id','id');
    }
    public function photos()
    {
        return $this->hasMany(PropertyPhoto::class ,'property_id','id');
    }
    public function sellerInfo()
    {
        return $this->belongsTo(Seller::class ,'seller_id');
    }
    public function agentInfo()
    {
        return $this->belongsTo(Agent::class ,'agent_id');
    }

    public function amenities()
    {
        return $this->hasMany(Amenity::class,'property_id');
    }
}
