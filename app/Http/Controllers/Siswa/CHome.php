<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CHome extends Controller
{
    function __invoke(){
        $siswa = Auth::guard('siswa')->user();
        return view('pages.client.home',compact('siswa'));
    }
}
