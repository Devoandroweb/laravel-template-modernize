<?php

namespace App\Repositories\ApiHandle;

use LaravelEasyRepository\Repository;

interface ApiHandleRepository extends Repository{

    // Write something awesome :)
    function safeApiCall(callable $callback);
}
