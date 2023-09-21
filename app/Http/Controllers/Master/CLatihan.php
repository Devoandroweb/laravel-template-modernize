<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\MLatihan;
use Illuminate\Http\Request;

class CLatihan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urlDT = latihanDT()['url'];
        $columnDT = latihanDT()['column'];
        return view('pages.master.latihan.index',compact('urlDT','columnDT'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mLatihan = null;
        $titleContent = 'Tambah Latihan';
        return view('pages.master.latihan.form',compact('mLatihan','titleContent'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MLatihan $mLatihan)
    {

        $data = $mLatihan->updateOrCreate([
            'id_latihan'=>$request->id_latihan
        ],$request->except('_token','_method'));
        if($request->id_latihan){
            return to_route('master.latihan.detail',$data->nomor)->with('message','Sukses Mengubah Latihan');
        }else{
            return to_route('master.latihan.detail',$data->nomor)->with('message','Sukses Menambahkan Latihan');

        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MLatihan  $mLatihan
     * @return \Illuminate\Http\Response
     */
    public function edit(MLatihan $mLatihan)
    {
        $titleContent = 'Edit Latihan';
        return view('pages.master.latihan.form',compact('mLatihan','titleContent'));
    }
    public function detail($nomor)
    {
        $titleContent = 'Detail Latihan';
        $urlDT = latihanDetailDT()['url']."?nomor=".$nomor;
        $columnDT = latihanDetailDT()['column'];
        return view('pages.master.latihan.detail',compact('urlDT','columnDT','titleContent','nomor'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MLatihan  $mLatihan
     * @return \Illuminate\Http\Response
     */
    public function destroy(MLatihan $mLatihan)
    {
        $mLatihan->delete();
        return to_route('master.latihan.detail',$mLatihan->nomor)->with('message','Sukses Menhapus Latihan');
    }
}
