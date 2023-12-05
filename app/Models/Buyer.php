<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Buyer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [

        "name","email","phone_number","password",'profile','goverment_id'
    ];
}
