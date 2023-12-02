<?php

use App\Http\Controllers\Api\CAuth;
use App\Http\Controllers\Api\CBarang;
use App\Http\Controllers\Api\CKategori;
use App\Http\Controllers\Api\CPengembalianBarang;
use App\Http\Controllers\Api\CPenjualan;
use App\Http\Controllers\Api\CPersediaan;
use App\Http\Controllers\Api\CReport;
use App\Http\Controllers\Api\CSales;
use App\Http\Controllers\Api\CStatistik;
use App\Http\Controllers\Api\CUser;
use App\Http\Controllers\CUserEpic;
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
    Route::get('check-token-firebase', [CAuth::class,'tokenFCM']);
    Route::post('update-token-firebase', [CAuth::class,'updateTokenFCM']);
    Route::prefix('barang')
    ->name('barang.')
    ->controller(CBarang::class)
    ->group(function(){
        Route::get('list', 'list')->name('list');
        Route::post('update', 'update')->name('update');
        Route::post('edit', 'edit')->name('edit');
        Route::post('create', 'create')->name('create');
        Route::post('delete', 'delete')->name('delete');
        Route::get('list-by-kategori/{id_kategori}', 'getBarangWithKategori');
        Route::get('dropdown-search', 'dropdownSearch');
        Route::get('warning-refill', 'listWarningPersediaan');
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
        Route::get('delete/{id_penjualan}', 'delete')->name('delete');

    });
    Route::prefix('return')
    ->name('return.')
    ->controller(CPengembalianBarang::class)
    ->group(function(){
        Route::get('list', 'list')->name('list');
        Route::post('create', 'create')->name('create');
        Route::post('edit', 'edit')->name('edit');
        Route::post('delete', 'delete')->name('delete');
    });
    Route::prefix('user')
    ->name('user.')
    ->controller(CUser::class)
    ->group(function(){
        Route::get('list', 'list')->name('list');
        Route::post('update', 'update')->name('update');
        Route::post('create', 'create')->name('create');
        Route::post('delete', 'delete')->name('delete');
        Route::post('home', 'home')->name('home');
    });
    Route::prefix('profile')
    ->name('profile.')
    ->controller(CUser::class)
    ->group(function(){
        Route::get('{id_user}', 'profile')->name('profile');
        Route::post('{id_user}/update-foto-profile', 'updateFotoProfile')->name('update-foto-profile');
        Route::post('{id_user}/update', 'updateProfile')->name('update');
    });
    Route::prefix('persediaan')
    ->name('persediaan.')
    ->controller(CPersediaan::class)
    ->group(function(){
        Route::get('list', 'list')->name('list');
        Route::get('list-by-kategori/{id_kategori}', 'listByKategory')->name('list-by-kategori');
    });
    Route::prefix('statistik')
    ->name('statistik.')
    ->controller(CStatistik::class)
    ->group(function(){
        Route::get('penjualan', 'penjualan')->name('penjualan');
    });
    Route::prefix('report')
    ->name('report.')
    ->controller(CReport::class)
    ->group(function(){
        Route::get('barang', 'barang')->name('barang');
    });
});

#FUNCTION
