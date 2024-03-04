<?php

namespace Database\Seeders;

use App\Models\ProductOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserTableSeeder::class,
            RoleTableSeeder::class,
            RoleUserTableSeeder::class,
            PermissionTableSeeder::class,
            PermissionRoleTableSeeder::class,
            ProductCategoryTableSeeder::class,
            BuyerTableSeeder::class,
            MeasurementTableSeeder::class,
            ProductSeeder::class,
            ProductOrderTableSeeder::class,
            StatusSeeder::class,
            ProductOrderStatusSeeder::class,
        ]);
    }
}
