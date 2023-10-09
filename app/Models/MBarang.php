<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MBarang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $fillable = ['kode_barang','nama_barang', 'satuan', 'id_kategori', 'minimal_persediaan'];
    function kategori(){
        return $this->hasOne(MKategori::class,'id_kategori','id_kategori');
    }
    function persediaan(){
        return $this->hasOne(Persediaan::class,'id_barang');
    }
}
