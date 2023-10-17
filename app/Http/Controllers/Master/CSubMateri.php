<?php

namespace App\Http\Controllers\Master;
use App\Http\Controllers\Controller;
use App\Models\SubMateri;
use Illuminate\Http\Request;

class CSubMateri extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_materi)
    {
        $urlDT = subMateriDT()['url']."?id_materi=".$id_materi;
        $columnDT = subMateriDT()['column'];
        return view('pages.master.sub_materi.index',compact('urlDT','columnDT','id_materi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_materi)
    {
        $subMateri = null;
        $idMateri = $id_materi;
        $titleContent = 'Tambah Sub Materi';
        return view('pages.master.sub_materi.form',compact('subMateri','idMateri','titleContent'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id_materi,Request $request, SubMateri $subMateri)
    {

        $subMateri->updateOrCreate([
            'id_sub_materi'=>$request->id_sub_materi
        ],[
            'id_materi'=>$id_materi,
            'judul'=>$request->judul,
            'isi'=>$request->isi,
        ]);
        if($request->id_sub_materi){
            return to_route('master.sub-materi.index',$id_materi)->with('message','Sukses Mengubah Sub Materi');
        }else{
            return to_route('master.sub-materi.index',$id_materi)->with('message','Sukses Menambahkan Sub Materi');

        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubMateri  $subMateri
     * @return \Illuminate\Http\Response
     */
    public function edit($id_materi,SubMateri $subMateri)
    {
        $titleContent = 'Edit Sub Materi';
        $idMateri = $id_materi;
        return view('pages.master.sub_materi.form',compact('subMateri','idMateri','titleContent'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubMateri  $subMateri
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_materi,SubMateri $subMateri)
    {
        $subMateri->delete();
        return to_route('master.sub-materi.index',$id_materi)->with('message','Sukses Menhapus Sub Materi');
    }
}
