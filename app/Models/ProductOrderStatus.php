<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductOrderStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_order_status';
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = [
        'product_order_id',
        'user_id',
        'status_id',
        'date',
    ];

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function productOrder()
    {
        return $this->belongsTo(ProductOrder::class, 'product_order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
