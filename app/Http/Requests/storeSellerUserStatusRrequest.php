<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeSellerUserStatusRrequest extends FormRequest
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
