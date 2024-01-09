<?php
namespace App\Traits;

use App\Models\UserEpic;
use Laravel\Sanctum\PersonalAccessToken;

trait CreatedBy
{
    static function whereUser(){
        dd(request()->user());
        if(request()->user()->role != 1){ #bukan admin
            return self::where('created_by',request()->user()?->id_user)->orderBy('created_at','desc');
        }else{
            if(request('id_user') != 0){
                return self::where('created_by',request('id_user'))->orderBy('created_at','desc');
            }
        }
        return new static;
    }
    static function whereCreatedBy(){
        return parent::where('created_by',request()->user()?->id_user);
    }
    
}
