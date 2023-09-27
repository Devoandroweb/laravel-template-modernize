<?php

namespace App\Repositories\SystemEpic;

use LaravelEasyRepository\Repository;

interface SystemEpicRepository extends Repository{

    // Write something awesome :)
    function addSalesAndStock($credentials);
    function addPenjualanAndReduceStock($credentials);
    function addReturnBarangAndStock($credentials) ;
}
