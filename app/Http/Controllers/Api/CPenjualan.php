<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenjualanRequest;
use App\Http\Resources\PenjualanResource;
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
            $result = $this->systemEpicRepository->addPenjualanAndReduceStock($credentials);
            if($result == 0){
                $this->systemEpicRepository->pushNotifWarningRefill(request()->user()?->id_user);
                return responseSuccess(['message'=>'Jumlah Barang tidak mencukupi']);
            }elseif($result){
                return responseSuccess(['message'=>'Sukses Menambahkan Penjualan']);
            }else{
                return responseFailed('ID Barang tidak ditemukan');
            };
        });
    }
    function list() {
        return $this->apiHandleRepository->safeApiCall(function(){
            $penjualan = Penjualan::whereUser()->get();
            $penjualan = PenjualanResource::collection($penjualan);
            return responseSuccess($penjualan);
        });
    }
    function delete($id_penjualan){
        return $this->apiHandleRepository->safeApiCall(function() use ($id_penjualan){
            if($this->systemEpicRepository->reducePenjualanAndStock($id_penjualan) == 1){
                return responseSuccess(['message'=>'Sukses Mengahapus Penjualan']);
            }else{
                return responseFailed("Sukses Mengahapus Penjualan");
            };
        });
    }
}
