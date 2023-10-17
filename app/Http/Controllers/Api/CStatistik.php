<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MMateri;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CStatistik extends Controller
{
    function penjualan(){

        // $materi = MMateri::whereIdMateri(1)->with('subMateri')->first();

        // Tanggal awal
        $startDate = Carbon::create(2023, 11, 1); // Gantilah dengan tanggal awal yang Anda butuhkan

        // Tanggal akhir, misalnya sampai minggu ke-4
        $endDate = $startDate->copy()->addWeeks(3); // 3 minggu setelah tanggal awal

        // Array untuk menyimpan tanggal-tanggal setiap minggu
        $weeklyDates = [];

        // Loop untuk mengambil tanggal setiap minggu
        while ($startDate->lte($endDate)) {
            $weeklyDates[] = $startDate->toDateString();
            $startDate->addWeek(); // Geser ke minggu berikutnya
        }
        $result = [];
        // Cetak hasil
        foreach ($weeklyDates as $i => $date) {
            // dd($i);

            $dateSparated = explode("-",$date);
            $dateCreate = Carbon::create($dateSparated[0],$dateSparated[1],$dateSparated[2]);
            $result[] = [$date,$dateCreate->addDays(6)->toDateString()];

        }
        dd($result);
    }
}
