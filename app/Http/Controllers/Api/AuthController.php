<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'code' => 400,
                'message' => $validator->errors(),
                'data'=>[]
            ],400); // 400 message is required
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $jwt_token = JWTAuth::fromUser($user);
    
        $user->roles()->attach(2); // Simple user role

        return response()->json([
            'token'=>$jwt_token,
            'data'=>$user,
         ],200);
    }
    public function __login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'password'=>'required',
            'email'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                "code" => 400,
                'message' => $validator->errors(),
                'data'=>[],
            ],400); // 400 message is required
        }

        $credentials = request(['email', 'password']);
        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'password' => [
                        'Invalid credentials'
                    ],
                ]
            ], 422); // 422 request fails
        }
    
        $user = User::find(auth()->user()->id);
        // $jwt_token = JWTAuth::fromUser($user);
        // if (!$user->jwt_token) {
        //     $token = JWTAuth::fromUser($user, ['exp' => now()->addYears(10)->timestamp]);
        //     $user->update(['jwt_token' => $token]);
        // } else {
        //     $token = $user->jwt_token;
        // }

        if (!$user->jwt_token) {
            // If not, generate a new token with a very long expiration time (e.g., 10 years)
            $token = JWTAuth::fromUser($user, ['exp' => now()->addYears(10)->timestamp]);
            $user->jwt_token = $token;
            $user->save();
        } else {
            try {
                JWTAuth::setToken($user->jwt_token)->checkOrFail();
                $token = $user->jwt_token;
            } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                // Token is expired, generate a new one
                $token = JWTAuth::fromUser($user, ['exp' => now()->addYears(10)->timestamp]);
                $user->jwt_token = $token;
                $user->save();
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                // Token is invalid, generate a new one
                $token = JWTAuth::fromUser($user, ['exp' => now()->addYears(10)->timestamp]);
                $user->jwt_token = $token;
                $user->save();
            }
        }
    
    
             return response()->json([
                'token'=>$token,
                'data'=>$user,
                'status'=> 200
             ],200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'password'=>'required',
            'email'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                "code" => 400,
                'message' => $validator->errors(),
                'data'=>[],
            ],400); // 400 message is required
        }

        $credentials = request(['email', 'password']);
        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'password' => [
                        'Invalid credentials'
                    ],
                ]
            ], 422); // 422 request fails
        }
    
        $user = User::find(auth()->user()->id);
        $jwt_token = JWTAuth::fromUser($user);
    
             return response()->json([
                'token'=>$jwt_token,
                'data'=>$user,
                'status'=> 200
             ],200);
    }
    public function test(Request $request)
    {
        return response()->json([
            'data'=>"Hello World",
            'status'=> 200
         ],200);
    }
}

