<?php

namespace Database\Seeders;

use App\Models\Measurement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeasurementTableSeeder extends Seeder
{
   
    public function run()
    {
        $measurement=[
            [
                'name' => '၃ ပြည်',
                'type' => 1,
                'product_category_id' =>1,
            ],
            [
                'name' => '၆ ပြည်',
                'type' => 0, 
                'product_category_id' =>1,
            ],
            [
                'name' => '၁၂ ပြည်',
                'type' => 0,
                'product_category_id' =>2,
            ],
        ];

        Measurement::insert($measurement);
    }
}
