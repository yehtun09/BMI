<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerProductType extends Model
{
    use HasFactory;

    protected $fillable=['name','product_category_id'];

    public function sellerProductCategory(){
        return $this->belongsTo(SellerProductCategory::class,'product_category_id');
    }
}
