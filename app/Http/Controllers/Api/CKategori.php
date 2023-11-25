<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\KategoriRequest;
use App\Models\MKategori;
use App\Repositories\ApiHandle\ApiHandleRepository;
use Illuminate\Http\Request;

class CKategori extends Controller
{
    protected $apiHandleRepository;
    function __construct(ApiHandleRepository $apiHandleRepository){
        $this->apiHandleRepository = $apiHandleRepository;
    }
    function list() {
        return $this->apiHandleRepository->safeApiCall(function(){
            $barang = MKategori::whereUser()->get();
            return responseSuccess($barang);
        });
    }
    function create(KategoriRequest $kategoriRequest) {
        return $this->apiHandleRepository->safeApiCall(function() use ($kategoriRequest){
            $credentials = $kategoriRequest->validated();
            // dd($credentials);
            MKategori::create($credentials);
            return responseSuccess(['message'=>'Sukses Menambahkan Kategori']);
        });

    }
    function update(KategoriRequest $kategoriRequest) {
        return $this->apiHandleRepository->safeApiCall(function() use ($kategoriRequest){
            $credentials = $kategoriRequest->validated();
            // dd($credentials);
            MKategori::find($kategoriRequest->id_kategori)->update($credentials);
            return responseSuccess(['message'=>'Sukses Mengubah Kategori']);
        });
    }
    function delete(){
        return $this->apiHandleRepository->safeApiCall(function(){
            $id_kategori = request('id_kategori');
            // dd($credentials);
            MKategori::find($id_kategori)->delete();
            return responseSuccess(['message'=>'Sukses menghapus Kategori']);
        });
    }
}
