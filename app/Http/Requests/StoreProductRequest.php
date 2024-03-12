<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            "name" => [
                'required',
                'string'
            ],
            // "price" => [
            //     'required',
            //     'string'
            // ],
            // "weight" => [
            //         'required',
            //         'string'
            // ],
            // "measurement_id" => [
            //     'required',
            //     'integer'
            // ],
            // "product_category_id" => [
            //     'required',
            //     'integer'
            // ]
        ];
    }
}
