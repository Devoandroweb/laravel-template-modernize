<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\MMateri;
use App\Models\SubMateri;
use Illuminate\Http\Request;

class CMateri extends Controller
{
    function index(){
        $materi = MMateri::orderBy('judul')->get();
        return view('pages.client.materi',compact('materi'));
    }
    function show(MMateri $mmateri){
        $materi = $mmateri;
        return view('pages.client.materi-detail',compact('materi'));
    }
    function showSub(MMateri $mmateri,$id_sub_materi){
        $subMateri = SubMateri::whereIdSubMateri($id_sub_materi)->whereIdMateri($mmateri->id_materi)->first();
        return view('pages.client.sub-materi-detail',compact('subMateri','mmateri'));
    }

}
