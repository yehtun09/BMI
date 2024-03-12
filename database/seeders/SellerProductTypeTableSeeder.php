<?php

namespace Database\Seeders;

use App\Models\SellerProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SellerProductTypeTableSeeder extends Seeder
{
    
    public function run()
    {
       $seller_product_types=[
        [
            'name' => 'Product Type 1 for Category 1',
            'product_category_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Product Type 1 for Category 2',
            'product_category_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Product Type 1 for Category 3',
            'product_category_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ];
    SellerProductType::insert($seller_product_types);
    }
}
