<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductOrderDetail extends Model
{
  
    use HasFactory, SoftDeletes;

    protected $table = 'product_order_details';

    protected $fillable = [
        'buyer_id',
        'date',
        'delivery_address',
        'phone',
    ];

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
