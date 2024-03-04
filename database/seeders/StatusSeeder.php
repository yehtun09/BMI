<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{

    public function run()
    {
        $status = [
          [     "name" => "Pending",
                "type"  => "pending"
        ],
          [     "name" => "Delivery",
                "type"  => "delivery"
    ],
          [     "name" => "Success",
                "type"  => "Success"
          ]
];
    Status::insert($status);
    }
}
