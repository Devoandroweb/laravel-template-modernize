<?php
namespace App\Traits;

use App\Models\UserEpic;
use Laravel\Sanctum\PersonalAccessToken;

trait CreatedBy
{
    static function whereUser(){

        if(request()->user()->role != 1){ #owner
            return self::orderBy('created_at','desc');
        }else{ # admin
            if(request()->user()){
                return self::where('created_by',request()->user()?->id_user)->orderBy('created_at','desc');
            }
        }
        return new static;
    }
    static function whereCreatedBy(){
        return parent::where('created_by',request()->user()?->id_user);
    }

}
