<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persediaan extends Model
{
    use HasFactory;
    protected $table = 'persediaan';
    protected $primaryKey = 'id_persediaan';
    protected $fillable = ['kode_barang', 'jumlah_barang'];
}
