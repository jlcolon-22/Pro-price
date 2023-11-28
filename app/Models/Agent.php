<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Agent extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [

        "name","email","phone_number","password","license",'status','profile','company_name'
    ];

    public function getRating()
    {
        return $this->hasMany(Rating::class,'agent_id');
    }
}
