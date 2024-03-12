<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'buyer_id' => ['required','integer'],
            'order_date' => ['required'],
            'delivery_address' => ['required','string'],
            'phone_no' => ['required','string'],
        ];
    }
}
