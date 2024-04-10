<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductCategoryPrices extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table='product_category_prices';

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

    public function SellerProductCategory(){
        return $this->belongsTo(SellerProductCategory::class, 'product_category_id');
    }
}
