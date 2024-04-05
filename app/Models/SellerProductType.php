<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SellerProductType extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'seller_product_types';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'product_category_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function sellerProductCategory(){
        return $this->belongsTo(SellerProductCategory::class,'product_category_id');
    }
}
