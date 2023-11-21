<?php
namespace App\Traits;

use App\Models\UserEpic;
trait CreatedBy
{
    protected static function boot()
    {
        
        $user = UserEpic::token()->get();
        dd($user);
        parent::boot();
        static::addGlobalScope('created_by', function ($builder) {
            $builder->where('created_by', Auth::guard('cris')->user()?->id_user);
        });
    }
}
