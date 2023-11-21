<?php
namespace App\Traits;
use Illuminate\Support\Facades\Auth;

trait CreatedBy
{
    protected static function boot()
    {
        dd(Auth::guard('cris')->user().Auth::guard('cris')->check());
        parent::boot();
        static::addGlobalScope('created_by', function ($builder) {
            $builder->where('created_by', Auth::guard('cris')->user()?->id_user);
        });
    }
}
