<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ApiHandle\ApiHandleRepository;
use App\Repositories\SystemEpic\SystemEpicRepository;
use Illuminate\Http\Request;

class CReport extends Controller
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
    function barang(){
        return $this->apiHandleRepository->safeApiCall(function(){
            // dd($kode_barang);
            $barang =  $this->systemEpicRepository->getReportPenjualan();
            return responseSuccess($barang);
        });
    }
}
