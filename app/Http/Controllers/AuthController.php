<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    //
    public function getToken(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        // failed attempt
        if(!$token = auth()->guard('api')->attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Wrong email or password'
            ], 401);
        }

        // success attempt
        return response()->json([
            'success' => true,
            'user_id'    => auth()->guard('api')->user()->_id,    
            'token'   => $token   
        ], 200);
    }

    public function invalidateToken() {
        if(JWTAuth::invalidate(JWTAuth::getToken())) {
            return response()->json([
                'success' => true,
                'message' => 'Succes',  
            ], 200);
        }
    }
}
