<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PersediaanByKategoriResource;
use App\Http\Resources\PersediaanResource;
use App\Models\MBarang;
use App\Models\MKategori;
use App\Models\Persediaan;
use App\Repositories\ApiHandle\ApiHandleRepository;
use Illuminate\Http\Request;

class CPersediaan extends Controller
{
    protected $apiHandleRepository;
    function __construct(ApiHandleRepository $apiHandleRepository){
        $this->apiHandleRepository = $apiHandleRepository;
    }
    function listByKategory($id_kategori) {
        return $this->apiHandleRepository->safeApiCall(function()use($id_kategori){
            $kategori = MKategori::whereIdKategori($id_kategori)->get();
            $persediaan = PersediaanByKategoriResource::collection($kategori);
            // dd($kategori);
            return responseSuccess($persediaan);
        });
    }
    function list() {
        return $this->apiHandleRepository->safeApiCall(function(){
            $persediaan = Persediaan::all();
            $persediaan = PersediaanResource::collection($persediaan);
            return responseSuccess($persediaan);
        });
    }

}
