<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MKelas extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_kelas';
    protected $table = 'kelas';
    protected $fillable = ['nama','tingkatan'];
}
