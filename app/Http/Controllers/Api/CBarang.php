<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BarangRequest;
use App\Models\MBarang;
use App\Repositories\ApiHandle\ApiHandleRepository;
use Illuminate\Http\Request;

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
            MBarang::create($credentials);
            return responseSuccess(['message'=>'Sukses Menambahkan Barang']);
        });

    }
    function update(BarangRequest $barangRequest) {
        return $this->apiHandleRepository->safeApiCall(function() use ($barangRequest){
            $credentials = $barangRequest->validated();
            // dd($credentials);
            MBarang::whereKodeBarang($barangRequest->kode_barang)->update($credentials);
            return responseSuccess(['message'=>'Sukses Mengubah Barang']);
        });
    }
    function delete(){
        return $this->apiHandleRepository->safeApiCall(function(){
            $kode_barang = request('kode_barang');
            // dd($kode_barang);
            MBarang::whereKodeBarang($kode_barang)->delete();
            return responseSuccess(['message'=>'Sukses Menghapus Barang']);
        });
    }

}
