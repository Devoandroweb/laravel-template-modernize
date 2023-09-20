<?php

namespace App\Http\Controllers;

use App\Models\MKelas;
use App\Models\MLatihan;
use App\Models\MMateri;
use App\Models\MSiswa;
use App\Models\Permainan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CDatatable extends Controller
{
    function materi(DataTables $dataTables){
        $mMateri = MMateri::all();
        return $dataTables->of($mMateri)
        ->addColumn('action',function($row){
            return '
            <form action="'.route('master.materi.destroy',$row).'" method="POST">
                '.csrf_field().'
                <div class="btn-group" role="group">
                    <a href="'.route('master.materi.edit',$row).'" class="btn btn-small btn-info">Ubah</a>
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" class="btn btn-small btn-danger" value="Hapus">
                </div>
            </form>
            ';
        })
        ->rawColumns(['isi','action'])
        ->addIndexColumn()
        ->toJson();
    }
    function latihan(DataTables $dataTables){
        $mLatihan = MLatihan::all();
        return $dataTables->of($mLatihan)
        ->addColumn('action',function($row){
            return '
            <form action="'.route('master.latihan.destroy',$row).'" method="POST">
                '.csrf_field().'
                <div class="btn-group" role="group">
                    <a href="'.route('master.latihan.edit',$row).'" class="btn btn-small btn-info">Ubah</a>
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" class="btn btn-small btn-danger" value="Hapus">
                </div>
            </form>
            ';
        })
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->toJson();
    }
    function permainan(DataTables $dataTables){
        $permainan = Permainan::all();
        return $dataTables->of($permainan)
        ->addColumn('gambar',function($row){
            return '<img id="image" src="'.$row->imageSrc().'"  style="width: 200px; height:200px" class="shadow mb-4 img-fluid" alt="">';

        })
        ->addColumn('action',function($row){
            return '
            <form action="'.route('master.permainan.destroy',$row).'" method="POST">
                '.csrf_field().'
                <div class="btn-group" role="group">
                    <a href="'.route('master.permainan.edit',$row).'" class="btn btn-small btn-info">Ubah</a>
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" class="btn btn-small btn-danger" value="Hapus">
                </div>
            </form>
            ';
        })
        ->rawColumns(['action','gambar'])
        ->addIndexColumn()
        ->toJson();
    }
    function siswa(DataTables $dataTables){
        $mSiswa = MSiswa::all();
        return $dataTables->of($mSiswa)
        ->editColumn('kelas',function($row){
            return "Kelas ".$row->kelas;
        })
        ->editColumn('jk',function($row){
            if($row->jk == 'L'){
                return 'Laki-laki';
            }elseif($row->jk == 'P'){
                return 'Perempuan';
            }else{
                return "-";
            }
        })
        ->addColumn('action',function($row){
            return '
            <form action="'.route('siswa.destroy',$row).'" method="POST">
                '.csrf_field().'
                <div class="btn-group" role="group">
                    <a href="'.route('siswa.edit',$row).'" class="btn btn-small btn-info">Ubah</a>
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" class="btn btn-small btn-danger" value="Hapus">
                </div>
            </form>
            ';
        })
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->toJson();
    }

}

