<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SalesRequest;
use App\Models\Sales;
use App\Repositories\ApiHandle\ApiHandleRepository;
use App\Repositories\Sales\SalesRepository;
use Illuminate\Http\Request;

class CSales extends Controller
{
    protected $salesRepository;
    protected $apiHandleRepository;
    function __construct(
        SalesRepository $salesRepository,
        ApiHandleRepository $apiHandleRepository
        ){
        $this->salesRepository = $salesRepository;
        $this->apiHandleRepository = $apiHandleRepository;
    }
    function create(SalesRequest $salesRequest) {
        return $this->apiHandleRepository->safeApiCall(function() use ($salesRequest){
            $credentials = $salesRequest->validated();
            $this->salesRepository->addSalesAndStock($credentials);
            return responseSuccess(['message'=>'Sukses Menambahkan Sales']);
        });

    }

}
