<?php

namespace App\Models;

use App\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengembalianBarang extends Model
{
    use HasFactory,CreatedBy;
    protected $table = 'pengembalian_barang';
    protected $primaryKey = 'id_data_pengembalian_barang';
    protected $fillable = ['id_barang', 'jumlah_barang', 'tanggal_pengembalian'];
    function barang(){
        return $this->hasOne(MBarang::class,'id_barang','id_barang');
    }
}
