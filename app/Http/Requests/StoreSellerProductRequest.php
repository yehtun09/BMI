<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSellerProductRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "seller_product_type_id" => [
                'required',
                'integer'
            ],
            'order_date'    => [
                'required'
            ],
            'weight' => [
                'required'
            ],
            'measurement_id' => [
                'required',
                'integer'
            ],
            'total_amount' => [
                'required',
            ],
            'price' => [
                'required'
            ],
            'address' => [
                'required'
            ],
            
            
        ];
    }
}
