<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CAuth extends Controller
{
    function authenticated(Request $request){
        try{
            if (!Auth::attempt($request->only('email', 'password')))
            {
                return response()->json([
                    'status' => FALSE,
                    'message' => "Email atau Password salah !!",
                    'data' => null,
                    'access_token' => null,
                ], 200);
            }

            $user = Auth::user();
            $authToken = $user->createToken('auth_token')->plainTextToken;
            $data = ['status'=>TRUE,'message' => 'Berhasil Login', 'access_token' => $authToken, 'token_type' => 'Bearer'];
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => FALSE,
                'message' => "Auth Failed !!",
                'data' => null,
                'access_token' => null,
            ], 500);
        }
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        
        return response()->json([
            'status' => TRUE,
            'message' => "Berhasil Logout",
            'data' => null,
            'access_token' => null,
        ], 200);
    }
}
