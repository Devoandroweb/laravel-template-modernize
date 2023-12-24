<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CAuth extends Controller
{
    function authenticated(Request $request){
        try{
            if (!Auth::guard('cris')->attempt($request->only('username', 'password')))
            {
                return response()->json([
                    'status' => FALSE,
                    'message' => "Email atau Password salah !!",
                    'data' => null,
                    'access_token' => null,
                ], 200);
            }

            $user = Auth::guard('cris')->user();
            if($user->is_login == 1){
                return response()->json([
                    'status' => FALSE,
                    'message' => "Sudah login di perangkat lain",
                    'data' => null,
                    'access_token' => null,
                ], 200);
            }
            $authToken = $user->createToken('auth_token')->plainTextToken;
            $user->is_login = 1;
            $user->update();
            $data = ['status'=>TRUE,'message' => 'Berhasil Login', 'access_token' => $authToken, 'token_type' => 'Bearer','user'=>$user];
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => FALSE,
                'message' => "Auth Failed !!",
                'data' => ['messages'=>$th->getMessage()],
                'access_token' => null,
            ], 500);
        }
    }
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        $user->is_login = 0;
        $user->update();

        return response()->json([
            'status' => TRUE,
            'message' => "Berhasil Logout",
            'data' => null,
            'access_token' => null,
        ], 200);
    }
    public function tokenFCM(Request $request)
    {
        if($request->user()->fcm == $request->token_fcm){
            return response()->json([
                'status' => TRUE,
                'message' => "Token FCM already",
            ], 200);
        }
        return response()->json([
            'status' => FALSE,
            'message' => "Token FCM Not already",
        ], 200);
    }
    public function updateTokenFCM(Request $request)
    {
        $user = $request->user();
        $user->fcm = $request->token_firebase;
        $user->update();
        return response()->json([
            'status' => TRUE,
            'message' => "Token FCM Has been Updated",
        ], 200);
    }

}
