<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\MMateri;
use Illuminate\Http\Request;

class CMateri extends Controller
{
    function index(){
        $materi = MMateri::orderBy('judul')->get();
        return view('pages.client.materi',compact('materi'));
    }
    function show($id_materi){
        $materi = MMateri::whereIdMateri($id_materi)->first();
        return view('pages.client.materi-detail',compact('materi'));
    }
}
