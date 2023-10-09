<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persediaan extends Model
{
    use HasFactory;
    protected $table = 'persediaan';
    protected $primaryKey = 'id_persediaan';
    protected $fillable = ['id_barang', 'jumlah_barang'];
    function barang(){
        return $this->hasOne(MBarang::class,'id_barang','id_barang');
    }
}
