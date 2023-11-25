<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenjualanRequest;
use App\Http\Requests\ReturnBarangRequest;
use App\Http\Resources\PengembalianBarangResource;
use App\Models\PengembalianBarang;
use App\Repositories\ApiHandle\ApiHandleRepository;
use App\Repositories\SystemEpic\SystemEpicRepository;
use Illuminate\Http\Request;

class CPengembalianBarang extends Controller
{
    protected $systemEpicRepository;
    protected $apiHandleRepository;
    function __construct(
        SystemEpicRepository $systemEpicRepository,
        ApiHandleRepository $apiHandleRepository
        ){
        $this->systemEpicRepository = $systemEpicRepository;
        $this->apiHandleRepository = $apiHandleRepository;
    }
    function create(ReturnBarangRequest $returnBarangRequest) {
        return $this->apiHandleRepository->safeApiCall(function() use ($returnBarangRequest){
            $credentials = $returnBarangRequest->validated();
            if($this->systemEpicRepository->addReturnBarangAndStock($credentials)){
                return responseSuccess(['message'=>'Sukses Menambahkan Pemngembalian']);
            }else{
                return responseFailed('Kode Barang tidak ditemukan');
            };
        });

    }
    function list() {
        return $this->apiHandleRepository->safeApiCall(function(){
            $pengembalian = PengembalianBarang::whereHas('barang')->whereUser()->get();

            $pengembalian = PengembalianBarangResource::collection($pengembalian);
            return responseSuccess($pengembalian);
        });
    }
    function delete() {
        return $this->apiHandleRepository->safeApiCall(function(){
            PengembalianBarang::where('id_data_pengembalian_barang',request()->id_data_pengembalian_barang)->delete();
            return responseSuccess(['message'=>'Sukses Menghapus Pemngembalian']);
        });
    }

}
