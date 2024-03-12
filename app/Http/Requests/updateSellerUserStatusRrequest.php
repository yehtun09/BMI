<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class  updateSellerUserStatusRrequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "seller_product_id" => [
                'required',
                'integer'
            ],
            "user_id" => [
                'required',
                'integer'
            ],
            "status_id" => [
                'required',
                'integer'
            ],
            "date" => [
                'required'
            ],
        ];
    }
}
