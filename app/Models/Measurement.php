<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    use HasFactory;

    protected $fillable=['name','type','product_category_id'];

    public function productCategory(){
        return $this->belongsTo(ProductCategory::class,'product_category_id');
    }
}
