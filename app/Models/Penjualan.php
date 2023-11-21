<?php

namespace App\Models;

use App\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory,CreatedBy;
    protected $table = 'penjualan';
    protected $primaryKey = 'id_penjualan';
    protected $fillable = ['id_barang', 'tanggal_penjualan', 'jumlah_penjualan'];
    function barang(){
        return $this->hasOne(MBarang::class,'id_barang','id_barang');
    }
}
