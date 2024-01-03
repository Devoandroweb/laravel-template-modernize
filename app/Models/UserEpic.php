<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class UserEpic extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $fillable = ['nama', 'email', 'nama_toko','role', 'username', 'password','foto','token','alamat', 'ttl', 'tempat_lahir', 'jk', 'no_tlp','fcm','password_show','is_login','is_active','device'];
    public function setPasswordAttribute($value): void
    {
        $this->attributes['password_show'] = $value;
        $this->attributes['password'] = Hash::make($value);
    }

}
