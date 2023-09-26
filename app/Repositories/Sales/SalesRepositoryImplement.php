<?php

namespace App\Repositories\Sales;

use App\Models\Persediaan;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Sales;

class SalesRepositoryImplement extends Eloquent implements SalesRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Sales|mixed $sales;
    */
    protected $sales;

    public function __construct(Sales $sales)
    {
        $this->sales = $sales;
    }
    function addSalesAndStock($credentials) {
        $kodeBarang = $credentials['kode_barang'];
        $persediaan = Persediaan::whereKodeBarang($kodeBarang)->first();
        if($persediaan){
            $persediaan->jumlah_barang += (int)$credentials->jumlah_sales;
            $this->sales->create($credentials);
        }else{
            return responseFailed('Kode Barang tidak ditemukan');
        }
    }
    // Write something awesome :)
}
