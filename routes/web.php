
<?php

use App\Http\Controllers\CDashboard;
use App\Http\Controllers\CDatatable;
use App\Http\Controllers\CLogin;
use App\Http\Controllers\CSiswa;
use App\Http\Controllers\Master\CKelas;
use App\Http\Controllers\Master\CLatihan;
use App\Http\Controllers\Master\CMateri;
use App\Http\Controllers\Master\CPermainan;
use App\Http\Controllers\Siswa\CLogin as SiswaCLogin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [CLogin::class,'index'])->middleware('guest')->name('login');
Route::post('/auth', [CLogin::class,'authenticated']);
Route::get('/', [SiswaCLogin::class,'index'])->middleware('guest')->name('siswa.login');
Route::post('/auth-siswa', [SiswaCLogin::class,'authenticated'])->middleware('guest')->name('siswa.auth');

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', CDashboard::class)->name('dashboard');
    Route::get('/logout', [CLogin::class,'logout']);

    Route::prefix('/master')
    ->name('master.')
    ->group(function(){
        Route::resource('/materi',CMateri::class,['parameters' => ['materi' => 'mMateri']]);
        Route::resource('/latihan',CLatihan::class,['parameters' => ['latihan' => 'mLatihan']]);
        Route::resource('/permainan',CPermainan::class);
    });

    Route::resource('/siswa',CSiswa::class,['parameters' => ['siswa' => 'mSiswa']]);


    Route::prefix('/datatable')
    ->name('datatable.')
    ->group(function(){
        Route::get('/materi',[CDatatable::class,'materi'])->name('materi');
        Route::get('/latihan',[CDatatable::class,'latihan'])->name('latihan');
        Route::get('/permainan',[CDatatable::class,'permainan'])->name('permainan');
        Route::get('/siswa',[CDatatable::class,'siswa'])->name('siswa');
    });
});
