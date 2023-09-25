<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEpic extends Model
{
    use HasFactory;
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $fillable = ['role', 'username', 'password'];
}
