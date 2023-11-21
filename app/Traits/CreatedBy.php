<?php

trait CreatedBy
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('created_by', function ($builder) {
            $builder->where('created_by', Auth::user()->id);
        });
    }
}
