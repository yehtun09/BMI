<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    public function run()
    {
        $product  = [
            [
                'name' => 'ရွှေဘိုပေါ်ဆန်းမွှေး',
                // 'price'=>250000,
                // 'weight'=> '2kg',
                // 'measurement_id'=>1,
                // 'product_category_id'=>1
            ],
            [
                'name' => 'မြောင်းမြဆန်',
                // 'price'=>34000,
                // 'weight'=> '5kg',
                // 'measurement_id'=>2,
                // 'product_category_id'=>2
            ],
            [
                'name' => 'ဆင်းသွယ်',
                // 'price'=>45000,
                // 'weight'=> '5kg',
                // 'measurement_id'=>1,
                // 'product_category_id'=>2
            ],
        ];
        Product::insert($product);
    }
}
