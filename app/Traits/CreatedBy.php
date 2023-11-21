<?php
namespace App\Traits;

use App\Models\UserEpic;
use Laravel\Sanctum\PersonalAccessToken;

trait CreatedBy
{
    protected static function boot()
    {
        $accessToken = PersonalAccessToken::where('token',request()->header('Authorization'))->first();
        dd(request()->header('Authorization'),$accessToken?->tokenable_id);
        parent::boot();
        static::addGlobalScope('created_by', function ($builder) use ($accessToken) {
            $builder->where('created_by', $accessToken->tokenable_id);
        });
    }
}
