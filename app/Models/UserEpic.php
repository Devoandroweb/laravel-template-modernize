<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserEpic extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $fillable = ['nama', 'email', 'nama_toko','role', 'username', 'password','foto'];
}
