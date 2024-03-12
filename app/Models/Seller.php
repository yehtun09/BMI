<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_no',
        'password',
        'address',
        'seller_type_id',
    ];

    public function sellerType(){
        return $this->belongsTo(SellerType::class, 'seller_type_id');
    }
}
