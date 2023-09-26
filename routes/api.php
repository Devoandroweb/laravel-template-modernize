<?php

use App\Http\Controllers\Api\CAuth;
use App\Http\Controllers\Api\CBarang;
use App\Http\Controllers\Api\CKategori;
use App\Http\Controllers\Api\CUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth', [CAuth::class,'authenticated']);
Route::middleware('auth:sanctum')->group(function(){
    Route::get('logout', [CAuth::class,'logout']);
    Route::prefix('barang')
    ->name('barang.')
    ->controller(CBarang::class)
    ->group(function(){
        CRUD();
    });
    Route::prefix('kategori')
    ->name('kategori.')
    ->controller(CKategori::class)
    ->group(function(){
        CRUD();
    });
    Route::prefix('user')
    ->name('user.')
    ->controller(CUser::class)
    ->group(function(){
        CRUD();
    });
});

#FUNCTION
function CRUD(){
    Route::get('list', 'list')->name('list');
    Route::post('update', 'update')->name('update');
    Route::post('create', 'create')->name('create');
    Route::post('delete', 'delete')->name('delete');
}
