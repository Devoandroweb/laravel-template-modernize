<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MLatihan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_latihan';
    protected $table = 'latihan';
    protected $fillable = ['nomor','urutan','pertanyaan','bobot','pilihan_a','pilihan_b','pilihan_c','pilihan_d','jawaban'];

    function checkDonelatihan($nis){
        $nilaiLatihan = NilaiLatihan::whereNis($nis)->whereNomor($this->nomor)->get()->count();
        $latihan = $this->whereNomor($this->nomor)->get()->count();
        if($latihan == $nilaiLatihan){
            return true;
        }
        return false;
    }
}
