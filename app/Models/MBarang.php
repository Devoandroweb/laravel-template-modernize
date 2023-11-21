<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\SystemEpicRepository;
class MBarang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $fillable = ['kode_barang','nama_barang', 'satuan', 'id_kategori', 'minimal_persediaan'];
    // protected $systemEpicRepository;
    
    function kategori(){
        return $this->hasOne(MKategori::class,'id_kategori','id_kategori');
    }
    function persediaan(){
        return $this->hasOne(Persediaan::class,'id_barang');
    }
    function persediaanMany(){
        return $this->hasMany(Persediaan::class,'id_barang');
    }
    function penjualanMany(){
        return $this->hasMany(Penjualan::class,'id_barang');
    }
    function pengembalianMany(){
        return $this->hasMany(PengembalianBarang::class,'id_barang');
    }
    function salesMany(){
        return $this->hasMany(Sales::class,'id_barang');
    }

    # DEFAULT FUNCTION #
    protected static function boot()
    {
        parent::boot();
        whereCreatedBy();
    }
}
