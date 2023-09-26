<?php

namespace App\Repositories\Sales;

use LaravelEasyRepository\Repository;

interface SalesRepository extends Repository{

    // Write something awesome :)
    function addSalesAndStock($credentials);
}
