<?php

namespace Database\Seeders;

use App\Models\TodayPrice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodayPricesTableSeeder extends Seeder
{

    public function run()
    {
        $today_prices=[
            [
                'date' => '2024-04-02',
                'type' => 1,
                'sell_price' => '30000',
                'buy_price' => '25000',
                'rice' => 'san',
                'remark' => 'abcd',
            ],
            [
                'date' => '2022-08-01',
                'type' => 2,
                'sell_price' => '25000',
                'buy_price' => '23000',
                'rice' => 'sansan',
                'remark' => 'efgh',
            ],
        ];

            TodayPrice::insert($today_prices);
    }
}
