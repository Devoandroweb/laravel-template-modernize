<?php

namespace App\Http\Controllers;

use App\Models\MSiswa;
use Illuminate\Http\Request;

class CDashboard extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $siswaL = MSiswa::whereJk('L')->get()->count();
        $siswaP = MSiswa::whereJk('P')->get()->count();
        $siswaTerkahirLogin = MSiswa::whereNotNull('terakhir_login')->orderBy('terakhir_login','desc')->limit(5)->get();
        return view('pages.dashboard.index',compact('siswaL','siswaP','siswaTerkahirLogin'));
    }
}
