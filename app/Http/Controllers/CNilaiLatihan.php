<?php

namespace App\Http\Controllers;

use App\Models\NilaiLatihan;
use Illuminate\Http\Request;

class CNilaiLatihan extends Controller
{
    function index(){
        $urlDT = nilaiLatihanDT()['url'];
        $columnDT = nilaiLatihanDT()['column'];
        return view('pages.nilai_latihan.index',compact('urlDT','columnDT'));
    }
    function detail($nomor){
        $urlDT = nilaiLatihanDetailDT()['url']."?nomor=".$nomor;
        // dd($urlDT);
        $columnDT = nilaiLatihanDetailDT()['column'];
        return view('pages.nilai_latihan.detail',compact('urlDT','columnDT','nomor'));
    }
    function reset($nomor){
        NilaiLatihan::whereNomor($nomor)->delete();
        return to_route('nilai_latihan.detail',$nomor);
    }
}
