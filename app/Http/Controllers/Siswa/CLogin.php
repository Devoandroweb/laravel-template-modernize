<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\MSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CLogin extends Controller
{

    function index(){
        return view('pages.client.login');
    }
    function authenticated(Request $request){
        $credentials = $request->validate([
            'nama' => ['required'],
            'kelas' => ['required'],
        ]);
        // dd($credentials);
        $siswa = MSiswa::where($credentials)->first();
        // dd($siswa);
        if ($siswa) {
            $request->session()->regenerate();
            // dd(Auth::guard('siswa')->loginUsingId($siswa->id_siswa));
            if(Auth::guard('siswa')->loginUsingId($siswa->id_siswa)){

                return redirect()->intended(route('client.home'));
            }
        }

        return back()->with('message','Nama atau Kelas salah');
    }
    function logout(Request $request){
        Auth::guard('siswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('siswa.login');
    }
}
