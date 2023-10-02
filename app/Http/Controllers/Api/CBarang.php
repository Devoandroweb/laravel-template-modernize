<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BarangRequest;
use App\Models\MBarang;
use App\Models\Persediaan;
use App\Repositories\ApiHandle\ApiHandleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CBarang extends Controller
{
    protected $apiHandleRepository;
    function __construct(ApiHandleRepository $apiHandleRepository){
        $this->apiHandleRepository = $apiHandleRepository;
    }
    function list() {
        return $this->apiHandleRepository->safeApiCall(function(){
            $barang = MBarang::all();
            return responseSuccess($barang);
        });
    }
    function create(BarangRequest $barangRequest) {
        return $this->apiHandleRepository->safeApiCall(function() use ($barangRequest){
            $credentials = $barangRequest->validated();
            // dd($credentials);
            DB::transaction(function() use ($credentials) {
                MBarang::create($credentials);
                Persediaan::create([
                    'kode_barang' => $credentials['kode_barang'],
                ]);
            });
            DB::commit();
            return responseSuccess(['message'=>'Sukses Menambahkan Barang']);
        });

    }
    function update(BarangRequest $barangRequest) {
        return $this->apiHandleRepository->safeApiCall(function() use ($barangRequest){
            $credentials = $barangRequest->validated();
            MBarang::whereIdBarang($credentials->id_barang)->update($credentials);
            if(isset($credentials['kode_barang'])){
                Persediaan::whereKodeBarang($barangRequest->kode_barang)->update([
                    'kode_barang' => $credentials['kode_barang'],
                ]);
            }
            return responseSuccess(['message'=>'Sukses Mengubah Barang']);
        });
    }
    function delete(){
        return $this->apiHandleRepository->safeApiCall(function(){
            $kode_barang = request('kode_barang');
            // dd($kode_barang);

            MBarang::whereKodeBarang($kode_barang)->delete();
            Persediaan::whereKodeBarang($kode_barang)->delete();

            return responseSuccess(['message'=>'Sukses Menghapus Barang']);
        });
    }
    function getBarangWithKategori($id_kategori){
        return $this->apiHandleRepository->safeApiCall(function()use($id_kategori){
            // dd($kode_barang);
            $barang = MBarang::whereIdKategori($id_kategori)->get();
            return responseSuccess($barang);
        });
    }

}
