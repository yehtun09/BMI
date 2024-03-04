<?php

namespace Database\Seeders;

use App\Models\ProductOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductOrderTableSeeder extends Seeder
{
    
    public function run()
    {
        $product_orders=[
            [
                'product_id'=>1,
                'buyer_id'=>1,
                'order_date' => now(),
                'qty' => 5,
                'total_amount' => 100,
                'delivery_address' => '123 Main St',
                'phone_no' => '1234567890',
            ],
            [
                'product_id'=>2,
                'buyer_id'=>2,
                'order_date' => now(),
                'qty' => 3,
                'total_amount' => 50,
                'delivery_address' => '456 Elm St',
                'phone_no' => '0987654321',
            ],
            [
                'product_id'=>3,
                'buyer_id'=>3,
                'order_date' => now(),
                'qty' => 2,
                'total_amount' => 30,
                'delivery_address' => '789 Oak St',
                'phone_no' => '9876543210',
            ],
        ];
        ProductOrder::insert($product_orders);
    }
}
