<?php

namespace Database\Seeders;

use App\Models\ProductCategoryPrices;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategoryPricesTableSeeder extends Seeder
{

    public function run()
    {
        $product_category_prices=[
            [
                'name' => 'ABC',
                'product_category_id' =>1,
            ],
            [
                'name' => 'DEF',
                'product_category_id' =>2,
            ],
        ];

            ProductCategoryPrices::insert($product_category_prices);
    }
}
