<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSellerRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'name' => 'required|string',
            'phone_no' => 'required|string',
            'password' => 'required|string',
            'address' => 'required|string',
            // 'seller_type_id' => 'required|string',
        ];
    }
}
