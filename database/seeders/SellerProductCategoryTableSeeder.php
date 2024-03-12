<?php

namespace Database\Seeders;

use App\Models\SellerProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SellerProductCategoryTableSeeder extends Seeder
{

    public function run()
    {
        $product_categories=[
            [
                'id' => 1 ,
                'name'  => 'ဆန်'
            ],
            [
                'id' => 2,
                'name'  => 'ဆန်ကွဲ'
            ],
            [
                'id' => 3,
                'name'  => 'စပါး'
            ],
        ];
         SellerProductCategory::insert($product_categories);

    }
}
