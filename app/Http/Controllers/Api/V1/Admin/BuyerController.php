<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBuyerRequest;
use App\Models\Buyer;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyerController extends Controller
{
    public function Register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'phone_no' => 'required',
            'password' => 'required|min:6',
            "address"  => 'required',
            "buyer_category" => "required"
        ]);

        if($validator->fails())
        {
            return response()->json([
                'code' => 400,
                'message' => "Error!",
                "error" => $validator->errors(),
                'data'=>[]
            ],400); // 400 message is required
        }

        $buyers = Buyer::create($request->all());
        // $jwt_token = JWTAuth::fromUser($buyers)
        return  response()->json([
            "code" => 200,
            "message"=> 'Success!',
            "data" => $buyers,
            // "token" => $jwt_token
        ],200);
    }

    public function login(Request $request)
    {
        $credentials = request(['phone_no', 'password']);

        $validator = Validator::make($credentials, [
            'phone_no' => 'required',
            'password' => 'required',
        ]);
        

        if ($validator->fails()) {
            return response()->json([
                'code'    => 422,
                'message' => 'Error',
                'errors' => $validator->errors(),
            ], 422);
        }
        
        $buyer = Buyer::where('phone_no', $credentials['phone_no'])->first();
        if (!$buyer || $buyer->password != $credentials['password']) {
            return response()->json([
                'code'    => 422,
                'message' => 'Error',
                'errors' => [
                    'password' => ['Invalid credentials'],
                ],
            ], 422);
        }
            $buyer = Buyer::where('phone_no' , $credentials['phone_no'])->first();
            return  response()->json([
                "code" => 200,
                "message"=> 'Success',
                "data" => $buyer,
            ],200);
    }

}
