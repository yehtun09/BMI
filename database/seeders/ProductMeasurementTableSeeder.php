<?php

namespace Database\Seeders;

use App\Models\ProductMeasurement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductMeasurementTableSeeder extends Seeder
{

    public function run()
    {
        $productMeasurement = [
            [
                'product_id' => 1,
                'price'=>250000,
                'weight'=> '2kg',
                'measurement_id'=>1,
                'product_category_id'=>1
            ],
            [
                'product_id' => 2,
                'price'=>34000,
                'weight'=> '5kg',
                'measurement_id'=>2,
                'product_category_id'=>2
            ],
            [
                'product_id' => 3,
                'price'=>45000,
                'weight'=> '5kg',
                'measurement_id'=>1,
                'product_category_id'=>2
            ], 
        ];
        ProductMeasurement::insert($productMeasurement);
    }
}
