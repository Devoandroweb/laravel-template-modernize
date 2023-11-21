<?php
namespace App\Traits;
use Illuminate\Support\Facades\Auth;

trait CreatedBy
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('created_by', function ($builder) {
            $builder->where('created_by', Auth::guard('cris')->user()->id_user);
        });
    }
}
