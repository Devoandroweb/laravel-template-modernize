<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiLatihan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_nilai_latihan';
    protected $table = 'nilai_latihan';
    protected $fillable = ['nis','nomor','urutan','nilai'];
     function latihan(){
        return $this->hasMany(MLatihan::class,'nomor','nomor');
     }
     function siswa(){
        return $this->hasOne(MSiswa::class,'nis','nis');
     }
}
