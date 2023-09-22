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


        $urutan = NilaiLatihan::whereNis($nis)->whereNomor($nomor)->max('urutan');
        if($urutan){
            $urutan = $urutan+1;
        }else{
            $urutan = 1;
        }

        if($urutan == $latihanStepAkhir){
            $nextButton = false;
        }else{
            $nextButton = true;
        }

        $latihan = MLatihan::whereNomor($nomor)->whereUrutan($urutan)->first();

        return view('pages.client.latihan-detail',compact('latihan','latihanStepAkhir','nextButton','nis'));
    }
    function next($nomor){
        $nis = Auth::guard('siswa')->user()->nis;

        $jawaban = request()->query('jawaban');
        $urutan = request()->query('urutan');
        $selesai = request()->query('selesai');
        if($jawaban){
            $nilai = 0;
            # Cek kebenaran jawaban
            $urutan = $urutan-1;
            $kunciJawaban = MLatihan::whereNomor($nomor)->whereUrutan($urutan)->first();
            // dd($jawaban,$kunciJawaban?->jawaban);
            if($jawaban == $kunciJawaban?->jawaban){
                $nilai = $kunciJawaban->bobot;
            }

            NilaiLatihan::updateOrCreate([
                'nis'=>$nis,
                'nomor'=>$nomor,
                'urutan'=>$urutan,
                'nilai'=>$nilai
            ]);
        }
        if($selesai){
            return to_route('client.latihan.thankyu');
        }
        return to_route('client.latihan.detail',$nomor);
    }
    function thankyu(){
        return view('pages.client.thankyu');
    }
}
