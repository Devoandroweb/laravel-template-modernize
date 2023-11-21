<?php
namespace App\Traits;

use App\Models\UserEpic;
use Laravel\Sanctum\PersonalAccessToken;

trait CreatedBy
{
    protected static function boot()
    {
        if(request()->user()->role != 1){
            parent::boot();
            static::addGlobalScope('created_by', function ($builder){
                $builder->where('created_by', request()->user()->id_user);
            });
        }
    }
}
