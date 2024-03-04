<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBuyerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            "name" => [
                "required",
            ],
            "address" => [
                "required"
            ],
            "phone_no" =>[
                "required",
                "unique:buyers,phone_no"
            ],
            "password" => [
                "required",
                "string",
                "min:6"
            ],
        ];
    }
}
