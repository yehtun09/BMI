<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' =>'audit_logs_access'
            ],
            [
                'id'    => 18,
                'title' =>'audit_logs_show'
            ],
            [
                'id'    => 19,
                'title' =>'audit_logs_delete'
            ],
            [
                'id'    => 20,
                'title' => 'buyer_create',
            ],
            [
                'id'    => 21,
                'title' => 'buyer_edit',
            ],
            [
                'id'    => 22,
                'title' => 'buyer_show',
            ],
            [
                'id'    => 23,
                'title' => 'buyer_delete',
            ],
            [
                'id'    => 24,
                'title' => 'buyer_access',
            ],
            [
                'id'    => 25,
                'title' => 'buyer_management_access',
            ],
            [
                'id'    => 26,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 27,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 28,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 29,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 30,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 31,
                'title' => 'measurement_edit',
            ],
            [
                'id'    => 32,
                'title' => 'measurement_show',
            ],
            [
                'id'    => 33,
                'title' => 'measurement_delete',
            ],
            [
                'id'    => 34,
                'title' => 'measurement_access',
            ],
            [
                'id'    => 35,
                'title' => 'measurement_create',
            ],
            [
                'id'    => 36,
                'title' => 'product_edit',
            ],
            [
                'id'    => 37,
                'title' => 'product_show',
            ],
            [
                'id'    => 38,
                'title' => 'product_delete',
            ],
            [
                'id'    => 39,
                'title' => 'product_access',
            ],
            [
                'id'    => 40,
                'title' => 'product_create',
            ],
            [
                'id'    => 41,
                'title' => 'product_order_edit',
            ],
            [
                'id'    => 42,
                'title' => 'product_order_show',
            ],
            [
                'id'    => 43,
                'title' => 'product_order_delete',
            ],
            [
                'id'    => 44,
                'title' => 'product_order_access',
            ],
            [
                'id'    => 45,
                'title' => 'product_order_create',
            ],
            [
                'id'    => 46,
                'title' => 'product_order_status_edit',
            ],
            [
                'id'    => 47,
                'title' => 'product_order_status_show',
            ],
            [
                'id'    => 48,
                'title' => 'product_order_status_delete',
            ],
            [
                'id'    => 49,
                'title' => 'product_order_status_access',
            ],
            [
                'id'    => 50,
                'title' => 'product_order_status_create',
            ],
            [
                'id'    => 51,
                'title' => 'status_edit',
            ],
            [
                'id'    => 52,
                'title' => 'status_show',
            ],
            [
                'id'    => 53,
                'title' => 'status_delete',
            ],
            [
                'id'    => 54,
                'title' => 'status_access',
            ],
            [
                'id'    => 55,
                'title' => 'status_create',
            ],
            [
                'id'    => 56,
                'title' => 'product_order_details_edit',
            ],
            [
                'id'    => 57,
                'title' => 'product_order_details_show',
            ],
            [
                'id'    => 58,
                'title' => 'product_order_details_delete',
            ],
            [
                'id'    => 59,
                'title' => 'product_order_details_access',
            ],
            [
                'id'    => 60,
                'title' => 'product_order_details_create',
            ],
        ];

        Permission::insert($permissions);
    }
}
