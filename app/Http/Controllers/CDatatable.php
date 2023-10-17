<?php

namespace App\Http\Controllers;

use App\Models\MKelas;
use App\Models\MLatihan;
use App\Models\MMateri;
use App\Models\MSiswa;
use App\Models\NilaiLatihan;
use App\Models\Permainan;
use App\Models\SubMateri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                    <a href="'.route('master.sub-materi.index',$row->id_materi).'" class="btn btn-small btn-warning">Sub</a>
                </div>
            </form>
            ';
        })
        ->rawColumns(['isi','action'])
        ->addIndexColumn()
        ->toJson();
    }
    function subMateri(DataTables $dataTables){
        $idMateri = request()->query('id_materi');
        $subMateri = SubMateri::whereIdMateri($idMateri);
        return $dataTables->of($subMateri)
        ->addColumn('action',function($row){
            return '
            <form action="'.route('master.sub-materi.destroy',[$row->id_materi,$row]).'" method="POST">
                '.csrf_field().'
                <div class="btn-group" role="group">
                    <a href="'.route('master.sub-materi.edit',[$row->id_materi,$row]).'" class="btn btn-small btn-info">Ubah</a>
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
        $mLatihan = MLatihan::groupBy('nomor')->get('nomor');
        $mLatihan = collect($mLatihan->toArray());

        return $dataTables->of($mLatihan)
        ->editColumn('nomor',function($row){
            return 'Latihan '.$row['nomor'];
        })
        ->addColumn('action',function($row){
            return '<a href="'.route('master.latihan.detail',['nomor'=>$row['nomor']]).'" class="btn btn-small btn-info">Lihat</a>';
        })
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->toJson();
    }
    function latihanDetail(DataTables $dataTables){
        $nomor = request()->query('nomor');
        $mLatihan = MLatihan::whereNomor($nomor)->orderBy('urutan','asc')->get();
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
    function nilaiLatihan(DataTables $dataTables){
        $mLatihan = MLatihan::groupBy('nomor')->get('nomor');
        $mLatihan = collect($mLatihan->toArray());

        return $dataTables->of($mLatihan)
        ->editColumn('nomor',function($row){
            return 'Latihan '.$row['nomor'];
        })
        ->addColumn('action',function($row){
            return '<a href="'.route('nilai_latihan.detail',['nomor'=>$row['nomor']]).'" class="btn btn-small btn-info">Lihat</a>';
        })
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->toJson();
    }
    function nilaiLatihanDetail(DataTables $dataTables){
        $nomor = request()->query('nomor');
        // dd($nomor);
        $defaultOrderDirection = 'desc';

        $dataTables = DataTables::of(MSiswa::whereHas('nilaiLatihan', function ($q) use ($nomor) {
            $q->whereNomor($nomor);
        }))
        ->addColumn('nilai', function ($row) use ($nomor) {
            return '<span class="badge text-bg-info fw-bold">' . $row->nilaiLatihan->where('nis',$row->nis)->where('nomor',$nomor)->sum('nilai') . '</span>';
        })
        ->rawColumns(['nilai'])
        ->addIndexColumn();

        // Mendefinisikan pengurutan untuk kolom "nilai"
        $dataTables->orderColumn('nilai', function ($query) use ($defaultOrderDirection) {
            $query->orderBy(function ($query) {
                $query->select(DB::raw('SUM(nilai)'))
                    ->from('nilai_latihan')
                    ->whereColumn('nis', 'siswa.nis');
            },$defaultOrderDirection);
        });
        // $dataTables->order([[3, $defaultOrderDirection]]);

        return $dataTables->toJson();

    }


}


