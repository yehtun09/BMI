<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSellerProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
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
