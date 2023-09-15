<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Permainan;
use Illuminate\Http\Request;

class CPermainan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urlDT = permainanDT()['url'];
        $columnDT = permainanDT()['column'];
        return view('pages.master.permainan.index',compact('urlDT','columnDT'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permainan = null;
        $titleContent = 'Tambah Permainan';
        return view('pages.master.permainan.form',compact('permainan','titleContent'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Permainan $permainan)
    {
        $data = $request->except('_token','_method');
        // dd($request->hasFile('image'));
        if($request->hasFile('image')){
            $data['image'] = uploadFile(public_path('/images/permainan'),$request->file('image'));
        }
        $permainan->updateOrCreate([
            'id_permainan'=>$request->id_permainan
        ],$data);
        if($request->id_permainan){
            return to_route('master.permainan.index')->with('message','Sukses Mengubah Permainan');
        }else{
            return to_route('master.permainan.index')->with('message','Sukses Menambahkan Permainan');

        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permainan  $permainan
     * @return \Illuminate\Http\Response
     */
    public function edit(Permainan $permainan)
    {
        $titleContent = 'Edit Permainan';
        return view('pages.master.permainan.form',compact('permainan','titleContent'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permainan  $permainan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permainan $permainan)
    {
        $permainan->delete();
        return to_route('master.permainan.index')->with('message','Sukses Menhapus Permainan');
    }
}
