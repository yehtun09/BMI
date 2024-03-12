<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductMeasurementRequest extends FormRequest
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

   
    public function rules()
    {
        return [
            'product_id' => [
                'required',
                'integer'
            ],
            'measurement_id' => [
                'required',
                'integer'
            ],
            "price" => [
                "required"
            ],
            "weight" => [
                "required"
            ],
            "product_category_id" => [
                "required",
                'integer'
            ]
        ];
    }
}
