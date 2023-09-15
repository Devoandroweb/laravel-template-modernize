<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\MMateri;
use Illuminate\Http\Request;

class CMateri extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urlDT = materiDT()['url'];
        $columnDT = materiDT()['column'];
        return view('pages.master.materi.index',compact('urlDT','columnDT'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mMateri = null;
        $titleContent = 'Tambah Materi';
        return view('pages.master.materi.form',compact('mMateri','titleContent'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MMateri $mMateri)
    {

        $mMateri->updateOrCreate([
            'id_materi'=>$request->id_materi
        ],[
            'judul'=>$request->judul,
            'isi'=>$request->isi,
        ]);
        if($request->id_materi){
            return to_route('master.materi.index')->with('message','Sukses Mengubah Materi');
        }else{
            return to_route('master.materi.index')->with('message','Sukses Menambahkan Materi');

        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MMateri  $mMateri
     * @return \Illuminate\Http\Response
     */
    public function edit(MMateri $mMateri)
    {
        $titleContent = 'Edit Materi';
        return view('pages.master.materi.form',compact('mMateri','titleContent'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MMateri  $mMateri
     * @return \Illuminate\Http\Response
     */
    public function destroy(MMateri $mMateri)
    {
        $mMateri->delete();
        return to_route('master.materi.index')->with('message','Sukses Menhapus Materi');
    }
}
