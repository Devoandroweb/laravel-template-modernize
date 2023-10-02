<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Persediaan;
use App\Repositories\ApiHandle\ApiHandleRepository;
use Illuminate\Http\Request;

class CPersediaan extends Controller
{
    protected $apiHandleRepository;
    function __construct(ApiHandleRepository $apiHandleRepository){
        $this->apiHandleRepository = $apiHandleRepository;
    }
    function list() {
        return $this->apiHandleRepository->safeApiCall(function(){
            $persediaan = Persediaan::all();
            return responseSuccess($persediaan);
        });
    }
}
