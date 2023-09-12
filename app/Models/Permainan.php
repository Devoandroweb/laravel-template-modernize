<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permainan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_permainan';
    protected $table = 'permainan';
    protected $fillable = ['image','pertanyaan'];
}
