<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\MLatihan;
use App\Models\NilaiLatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CLatihan extends Controller
{
    function index(){
        $latihan = MLatihan::groupBy('nomor')->orderBy('nomor','asc')->get('nomor');
        return view('pages.client.latihan',compact('latihan'));
    }
    function detail($nomor){
        $nis = Auth::guard('siswa')->user()->nis;
        // dd($nis);
        $semuaLatihan = MLatihan::whereNomor($nomor)->get();
        $latihanStepAkhir = $semuaLatihan->count();
        // dd($nomor == $latihanStepAkhir);
        if($nomor == $latihanStepAkhir){
            $nextButton = false;
        }else{
            $nextButton = true;
        }

        $urutan = NilaiLatihan::whereNis($nis)->whereNomor($nomor)->max('urutan');
        if($urutan){
            $urutan = $urutan+1;
        }else{
            $urutan = 1;
        }
        $latihan = MLatihan::whereNomor($nomor)->whereUrutan($urutan)->first();
        return view('pages.client.latihan-detail',compact('latihan','latihanStepAkhir','nextButton'));
    }
    function next(){
        
    }
}
