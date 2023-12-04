<?php
namespace App\Traits;

use App\Models\UserEpic;
use Laravel\Sanctum\PersonalAccessToken;

trait CreatedBy
{
    static function whereUser(){
        if(request()->user()->role != 1){ #bukan admin
            return self::where('created_by',request()->user()?->id_user);
        }else{
            if(request('id_user') != 0){
                return self::where('created_by',request('id_user'));
            }
        }
        return new static;
    }
    static function whereCreatedBy(){
        return parent::where('created_by',request()->user()?->id_user);
    }
    public static function bootCreatedUpdatedBy()
    {
        dd(request()->user()?->id_user);
        // updating created_by and updated_by when model is created
        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) {
                $model->created_by = request()->user()?->id_user;
            }
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = request()->user()?->id_user;
            }
        });

        // updating updated_by when model is updated
        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = request()->user()?->id_user;
            }
        });
    }
}
