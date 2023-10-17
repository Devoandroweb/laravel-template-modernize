<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MMateri extends Model
{
    use HasFactory;
    protected $table = 'materi';
    protected $primaryKey = 'id_materi';
    protected $fillable = ['judul','isi','gambar'];
    function subMateri(){
        return $this->hasOne(SubMateri::class,'id_materi','id_materi');
    }
}
