<?php
namespace App\Traits;

use App\Models\UserEpic;
use Laravel\Sanctum\PersonalAccessToken;

trait CreatedBy
{
    protected static function boot()
    {
        dd(request()->user());
        parent::boot();
        if(request()->user()->role != 1){
            static::addGlobalScope('created_by', function ($builder){
                $builder->where('created_by', request()->user()->id_user);
            });
        }
    }
}
