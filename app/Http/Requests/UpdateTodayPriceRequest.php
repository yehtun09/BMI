<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTodayPriceRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'date' => ['required'],
            'type' => ['required'],
            'sell_price' => ['required'],
            'buy_price' => ['required'],
            'rice' => ['required'],
            'remark' => ['required'],
        ];
    }
}
