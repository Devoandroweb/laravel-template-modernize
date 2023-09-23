<?php

namespace App\Http\Controllers;

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
        return view('pages.nilai_latihan.index',compact('urlDT','columnDT'));
    }
}
