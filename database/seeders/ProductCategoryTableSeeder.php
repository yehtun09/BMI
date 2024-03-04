<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategoryTableSeeder extends Seeder
{
    
    public function run()
    {
        $product_category=[
            [
                'name' => 'လက်လီ',
            ],
            [
                'name' => 'လက်ကား',
            ]
        ];
    
            ProductCategory::insert($product_category);
    }
}
