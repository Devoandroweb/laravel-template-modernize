<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MSiswa extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_siswa';
    protected $table = 'siswa';
    protected $fillable = ['nis','nama','kelas'];
}
