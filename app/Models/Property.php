<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    public function photo()
    {
        return $this->hasOne(PropertyPhoto::class ,'property_id','id');
    }
    public function photos()
    {
        return $this->hasMany(PropertyPhoto::class ,'property_id','id');
    }
    public function userInfo()
    {
        return $this->belongsTo(Seller::class ,'seller_id');
    }
}
