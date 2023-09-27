<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenjualanRequest;
use App\Models\Penjualan;
use App\Repositories\ApiHandle\ApiHandleRepository;
use App\Repositories\SystemEpic\SystemEpicRepository;
use Illuminate\Http\Request;

class CPenjualan extends Controller
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
    function create(PenjualanRequest $penjualanRequest) {
        return $this->apiHandleRepository->safeApiCall(function() use ($penjualanRequest){
            $credentials = $penjualanRequest->validated();
            if($this->systemEpicRepository->addPenjualanAndReduceStock($credentials)){
                return responseSuccess(['message'=>'Sukses Menambahkan Penjualan']);
            }else{
                return responseFailed('Kode Barang tidak ditemukan');
            };
        });
    }
    function list() {
        return $this->apiHandleRepository->safeApiCall(function(){
            $barang = Penjualan::all();
            return responseSuccess($barang);
        });
    }
}
