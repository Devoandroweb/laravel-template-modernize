<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengembalianBarang extends Model
{
    use HasFactory;
    protected $table = 'pengembalian_barang';
    protected $primaryKey = 'id_data_pengembalian_barang';
    protected $fillable = ['kode_barang', 'jumlah_barang', 'tanggal_pengembalian'];
}
