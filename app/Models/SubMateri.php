<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMateri extends Model
{
    use HasFactory;
    protected $table = 'sub_materi';
    protected $primaryKey = 'id_sub_materi';
    protected $fillable = ['judul', 'isi', 'id_materi'];
    function materi(){
        return $this->hasOne(MMateri::class,'id_materi','id_materi');
    }
}
