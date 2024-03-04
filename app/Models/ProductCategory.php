<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable=['name'];

    public function products()
    {
        return $this->hasMany(Product::class,'product_category_id');
    }

    public function measurements()
    {
        return $this->hasMany(Measurement::class,'product_category_id');
    }
}
