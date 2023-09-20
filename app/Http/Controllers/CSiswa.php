<?php

namespace App\Http\Controllers;

use App\Models\MSiswa;
use Illuminate\Http\Request;

class CSiswa extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urlDT = siswaDT()['url'];
        $columnDT = siswaDT()['column'];
        return view('pages.siswa.index',compact('urlDT','columnDT'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mSiswa = null;
        $titleContent = 'Tambah Siswa';
        return view('pages.siswa.form',compact('mSiswa','titleContent'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MSiswa $mSiswa)
    {

        $mSiswa->updateOrCreate([
            'id_siswa'=>$request->id_siswa
        ],[
            'nis'=>$request->nis,
            'nama'=>$request->nama,
            'kelas'=>$request->kelas,
            'jk'=>$request->jk,
        ]);
        if($request->id_siswa){
            return to_route('siswa.index')->with('message','Sukses Mengubah Siswa');
        }else{
            return to_route('siswa.index')->with('message','Sukses Menambahkan Siswa');

        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MSiswa  $mSiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(MSiswa $mSiswa)
    {
        $titleContent = 'Edit Siswa';
        return view('pages.siswa.form',compact('mSiswa','titleContent'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MSiswa  $mSiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(MSiswa $mSiswa)
    {
        $mSiswa->delete();
        return to_route('siswa.index')->with('message','Sukses Menhapus Siswa');
    }
}
