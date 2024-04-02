<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class productCategoryPrices extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable=['name','product_category_id'];

    public function productCategory(){
        return $this->belongsTo(ProductCategory::class);
    }
}
