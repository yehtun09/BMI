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
                'password' => '123456',
                'address' => '123 Main Street',
                'phone_no' => '09414231525',
                'buyer_category' => 1,
            ],
            [
                'name' => 'Jane Smith',
                'password' => '123456',
                'address' => '456 Elm Street',
                'phone_no' => '094452422',
                'buyer_category' => 2,
            ],
            [
                'name' => 'Michael Johnson',
                'password' => '123456',
                'address' => '789 Oak Street',
                'phone_no' => '0987673',
                'buyer_category' => 2,
            ],
        ];

        Buyer::insert($buyer);
    }
}
