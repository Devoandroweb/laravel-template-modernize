<?php
namespace App\Traits;

use App\Models\UserEpic;
use Laravel\Sanctum\PersonalAccessToken;

trait CreatedBy
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('created_by', function ($builder){
            $builder->where('created_by', request()->user()->id_user);
        });
    }
}
