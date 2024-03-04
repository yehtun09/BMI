<?php

namespace Database\Seeders;

use App\Models\Buyer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuyerTableSeeder extends Seeder
{
    public function run()
    {
        $buyer=[
            [
                'name' => 'John Doe',
                'password' => bcrypt('password123'),
                'address' => '123 Main Street',
                'phone_no' => '555-1234',
                'buyer_category' => 1,
            ],
            [
                'name' => 'Jane Smith',
                'password' => bcrypt('password456'),
                'address' => '456 Elm Street',
                'phone_no' => '555-5678',
                'buyer_category' => 2,
            ],
            [
                'name' => 'Michael Johnson',
                'password' => bcrypt('password789'),
                'address' => '789 Oak Street',
                'phone_no' => '555-91011',
                'buyer_category' => null,
            ],
        ];

        Buyer::insert($buyer);
    }
}
