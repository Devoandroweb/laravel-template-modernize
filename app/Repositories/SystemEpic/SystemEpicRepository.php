<?php

namespace App\Repositories\SystemEpic;

use LaravelEasyRepository\Repository;

interface SystemEpicRepository extends Repository{

    // Write something awesome :)
    function addSalesAndStock($credentials);
    function addPenjualanAndReduceStock($credentials);
    function addReturnBarangAndStock($credentials) ;
    function reduceSalesAndStock($id_sales);
    function reducePenjualanAndStock($id_penjualan);
    function getStatistic();
    function getReportPenjualan();
}
