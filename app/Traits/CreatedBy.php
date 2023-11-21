<?php
namespace App\Traits;

use App\Models\UserEpic;
use Laravel\Sanctum\PersonalAccessToken;

trait CreatedBy
{
    static function whereUser(){
        if(request()->user()->role == 1){
            return parent::all();
        }else{
            return parent::where('created_by',request()->user()?->id_user)->get();
        }
    }
    static function whereCreatedBy(){
        return parent::where('created_by',request()->user()?->id_user);
    }
}
