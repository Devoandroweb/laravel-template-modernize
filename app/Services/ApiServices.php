<?php
namespace App\Services;

use Illuminate\Http\Response;

class ApiService
{
    public static function safeApiCall(callable $callback)
    {
        try {
            return $callback();
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
