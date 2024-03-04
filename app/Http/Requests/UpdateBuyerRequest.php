<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBuyerRequest extends FormRequest
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
                "required",
            ],
            "address" => [
                "required"
            ],
            "phone_no" =>[
                "required"

            ],
            "password" => [
                "required",
                "string",
                "min:6",
            ],
        ];
    }


    public function messages()
    {
        return [
            'password.min' => 'The password must be at least 6 characters long.',
        ];
    }
}
