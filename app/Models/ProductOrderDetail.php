<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductOrderDetail extends Model
{
  
    use HasFactory, SoftDeletes;

    protected $table = 'product_order_details';
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = [
        'product_id',
        'product_order_id',
        'qty',
        'total_amount',
        'phone',
        'measurement_id',
    ];

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function productOrder(){
        return $this->belongsTo(ProductOrder::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function measurement()
    {
        return $this->belongsTo(Measurement::class);
    }

}
