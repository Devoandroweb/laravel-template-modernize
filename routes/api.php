<?php

use App\Http\Controllers\Api\CAuth;
use App\Http\Controllers\Api\CBarang;
use App\Http\Controllers\Api\CKategori;
use App\Http\Controllers\Api\CPengembalianBarang;
use App\Http\Controllers\Api\CPenjualan;
use App\Http\Controllers\Api\CPersediaan;
use App\Http\Controllers\Api\CSales;
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
        Route::get('list', 'list')->name('list');
    Route::post('update', 'update')->name('update');
    Route::post('create', 'create')->name('create');
    Route::post('delete', 'delete')->name('delete');
        Route::get('based-on-kategori/{id_kategori}', 'getBarangWithKategori');
    });
    Route::prefix('kategori')
    ->name('kategori.')
    ->controller(CKategori::class)
    ->group(function(){
        Route::get('list', 'list')->name('list');
    Route::post('update', 'update')->name('update');
    Route::post('create', 'create')->name('create');
    Route::post('delete', 'delete')->name('delete');
    });
    Route::prefix('sales')
    ->name('sales.')
    ->controller(CSales::class)
    ->group(function(){
        Route::get('list', 'list')->name('list');
        Route::post('create', 'create')->name('create');
        Route::get('delete/{id_sales}', 'delete')->name('delete');
    });
    Route::prefix('penjualan')
    ->name('penjualan.')
    ->controller(CPenjualan::class)
    ->group(function(){
        Route::get('list', 'list')->name('list');
        Route::post('create', 'create')->name('create');
    });
    Route::prefix('return')
    ->name('return.')
    ->controller(CPengembalianBarang::class)
    ->group(function(){
        Route::get('list', 'list')->name('list');
        Route::post('create', 'create')->name('create');
    });
    Route::prefix('user')
    ->name('user.')
    ->controller(CUser::class)
    ->group(function(){
        Route::get('list', 'list')->name('list');
    Route::post('update', 'update')->name('update');
    Route::post('create', 'create')->name('create');
    Route::post('delete', 'delete')->name('delete');
    });
    Route::prefix('persediaan')
    ->name('persediaan.')
    ->controller(CPersediaan::class)
    ->group(function(){
        Route::get('list', 'list')->name('list');
    });
});

#FUNCTION
