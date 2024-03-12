<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Buyer extends Model implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    public $table = 'buyers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // protected $hidden = [
    //     'password',
    // ];

    protected $fillable = [
        'name',
        'password',
        'address',
        'phone_no',
        'buyer_category',
        'shop_name',
        'shop_address',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getJWTIdentifier()
    {
           return $this->getKey();
      }
    public function getJWTCustomClaims()
  {
       return [];
  }
}
