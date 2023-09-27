<?php

namespace App\Repositories\ApiHandle;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\ApiHandle;

class ApiHandleRepositoryImplement extends Eloquent implements ApiHandleRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct()
    {
        // $this->model = $model;
    }

    // Write something awesome :)

    function safeApiCall(callable $callback) {

        try {
            return $callback();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return responseFailed($th->getMessage());
        }
    }
}
