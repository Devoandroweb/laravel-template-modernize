<?php

namespace App\Repositories\SystemEpic;

use App\Models\PengembalianBarang;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\SystemEpic;
use App\Models\Penjualan;
use App\Models\Persediaan;
use App\Models\Sales;
class SystemEpicRepositoryImplement extends Eloquent implements SystemEpicRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Sales|mixed $sales;
    */
    protected $sales;
    protected $persediaan;
    protected $penjualan;
    protected $pengembalianBarang;

    public function __construct(
        Sales $sales,
        Persediaan $persediaan,
        Penjualan $penjualan,
        PengembalianBarang $pengembalianBarang
    )
    {
        $this->sales = $sales;
        $this->penjualan = $penjualan;
        $this->persediaan = $persediaan;
        $this->pengembalianBarang = $pengembalianBarang;
    }
    function addSalesAndStock($credentials) {
        $kodeBarang = $credentials['kode_barang'];
        $persediaan = $this->persediaan->whereKodeBarang($kodeBarang)->first();

        if($persediaan){
            $persediaan->jumlah_barang += (int)$credentials['jumlah_sales'];
            $this->sales->create($credentials);
            $persediaan->update();
            return true;
        }else{
            return false;
        }
    }
    function addPenjualanAndReduceStock($credentials) {
        $kodeBarang = $credentials['kode_barang'];
        $persediaan = $this->persediaan->whereKodeBarang($kodeBarang)->first();
        if($persediaan){
            $persediaan->jumlah_barang -= (int)$credentials['jumlah_penjualan'];
            $this->penjualan->create($credentials);
            $persediaan->update();
            return true;
        }else{
            return false;
        }
    }
    function addReturnBarangAndStock($credentials) {
        $kodeBarang = $credentials['kode_barang'];
        $persediaan = $this->persediaan->whereKodeBarang($kodeBarang)->first();

        if($persediaan){
            $persediaan->jumlah_barang += (int)$credentials['jumlah_barang'];
            $this->pengembalianBarang->create($credentials);
            $persediaan->update();
            return true;
        }else{
            return false;
        }
    }
}
