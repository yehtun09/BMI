<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SellerUserStatus extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'seller_user_statuses';

    protected $fillable = [
        'seller_product_id',
        'user_id',
        'status_id',
        'date',
    ];

    // Relationships
    public function sellerProduct()
    {
        return $this->belongsTo(SellerProduct::class, 'seller_product_id');
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
