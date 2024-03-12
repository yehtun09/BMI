<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductOrder extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'product_orders';
    // protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = [
        'product_id',
        'buyer_id',
        'order_date',
        'qty',
        'total_amount',
        'delivery_address',
        'phone_no',
    ];

    public function buyer(){
        return $this->belongsTo(Buyer::class,'buyer_id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function productOrderStatues()
    {
        return $this->hasMany(ProductOrderStatus::class,'product_order_id');
    }

    public function prouductOrderDetails()
    {
        return $this->hasMany(ProductOrderDetail::class,'product_order_id');
    }

    public function statues()
    {
        return $this->hasMany(ProductOrderStatus::class);
    }
    // public function productMeasurement()
    // {
    //     return $this->belongsTo(ProductMeasurement::class);
    // }
}