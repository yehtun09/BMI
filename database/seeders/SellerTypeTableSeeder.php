<?php

namespace Database\Seeders;

use App\Models\SellerType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SellerTypeTableSeeder extends Seeder
{
   
    public function run()
    {
        $sellerType = [
            [
                'id' => 1,
                'name' => "Normal Seller"
            ],
            [
                'id' => 2,
                'name' => "Premium Seller"
            ],
            [
                'id'  => 3,
                'name' => 'Gold Seller'
            ]
        ];
        SellerType::insert($sellerType);
    }
}
