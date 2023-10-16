<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SalesRequest;
use App\Http\Resources\SalesResource;
use App\Models\Sales;
use App\Repositories\ApiHandle\ApiHandleRepository;
use App\Repositories\Sales\SalesRepository;
use App\Repositories\SystemEpic\SystemEpicRepository;
use Illuminate\Http\Request;

class CSales extends Controller
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
    function create(SalesRequest $salesRequest) {
        return $this->apiHandleRepository->safeApiCall(function() use ($salesRequest){
            $credentials = $salesRequest->validated();
            // dd($credentials);
            // dd($this->systemEpicRepository->addSalesAndStock($credentials));
            if($this->systemEpicRepository->addSalesAndStock($credentials)){
                return responseSuccess(['message'=>'Sukses Menambahkan Sales']);
            }else{
                return responseFailed('Kode Barang tidak ditemukan');
            };
        });
    }
    function list() {
        return $this->apiHandleRepository->safeApiCall(function(){
            $sales = Sales::all();
            $sales = SalesResource::collection($sales);
            return responseSuccess($sales);
        });
    }
    function delete($id_sales){
        return $this->apiHandleRepository->safeApiCall(function() use ($id_sales){
            if($this->systemEpicRepository->reduceSalesAndStock($id_sales) == 1){
                return responseSuccess(['message'=>'Sukses Mengahapus Sales']);
            }elseif($this->systemEpicRepository->reduceSalesAndStock($id_sales) == 0){
                return responseFailed('ID Sales tidak ditemukan');
            }else{
                return responseFailed("Jumlah Persediaan tidak mencukupi");
            };
        });
    }

}
