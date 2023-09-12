<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MLatihan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_latihan';
    protected $table = 'latihan';
    protected $fillable = ['pertanyaan','bobot'];
}
