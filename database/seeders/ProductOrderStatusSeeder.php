<?php

namespace Database\Seeders;

use App\Models\ProductOrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductOrderStatusSeeder extends Seeder
{

    public function run()
    {
        $orderStatus = [
            [
                'product_order_id' => 1,
                'user_id' => 1,
                'status_id' => 1,
                'date'=>'2024-02-08 23:47:19'
            ],
            [
                'product_order_id' => 2,
                'user_id' => 1,
                'status_id' => 1,
                'date'=>'2024-02-08 23:47:19'
            ],
            [
                'product_order_id' => 3,
                'user_id' => 2,
                'status_id' => 2,
                'date'=>'2024-02-08 23:47:19'
            ],
        ];
        ProductOrderStatus::insert($orderStatus);
    }
}
