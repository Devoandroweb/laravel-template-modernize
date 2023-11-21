<?php
namespace App\Traits;

use App\Models\UserEpic;
use Laravel\Sanctum\PersonalAccessToken;

trait CreatedBy
{
    protected static function boot()
    {
        $idUser = PersonalAccessToken::where('auth_token',request()->header('Authorization'))->first()->value('tokenable_id');
        echo $idUser;
        parent::boot();
        static::addGlobalScope('created_by', function ($builder) use ($idUser) {
            $builder->where('created_by', $idUser);
        });
    }
}
