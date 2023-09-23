
<?php

use App\Http\Controllers\CDashboard;
use App\Http\Controllers\CDatatable;
use App\Http\Controllers\CLogin;
use App\Http\Controllers\CNilaiLatihan;
use App\Http\Controllers\CSiswa;
use App\Http\Controllers\Master\CKelas;
use App\Http\Controllers\Master\CLatihan;
use App\Http\Controllers\Master\CMateri;
use App\Http\Controllers\Master\CPermainan;
use App\Http\Controllers\Siswa\CHome;
use App\Http\Controllers\Siswa\CLogin as SiswaCLogin;
use App\Http\Controllers\Siswa\CMateri as SiswaMateri;
use App\Http\Controllers\Siswa\CLatihan as SiswaLatihan;
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

Route::get('/admin', [CLogin::class,'index'])->middleware('guest')->name('admin');
Route::post('/auth', [CLogin::class,'authenticated']);
Route::get('/', [SiswaCLogin::class,'index'])->middleware('guest:siswa')->name('siswa.login');
Route::post('/auth-siswa', [SiswaCLogin::class,'authenticated'])->middleware('guest')->name('siswa.auth');

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', CDashboard::class)->name('dashboard');
    Route::get('/logout', [CLogin::class,'logout']);

    Route::prefix('/master')
    ->name('master.')
    ->group(function(){
        Route::resource('/materi',CMateri::class,['parameters' => ['materi' => 'mMateri']]);
        Route::resource('/latihan',CLatihan::class,['parameters' => ['latihan' => 'mLatihan']]);
        Route::get('/latihan-detail/{nomor}',[CLatihan::class,'detail'])->name('latihan.detail');
        Route::resource('/permainan',CPermainan::class);
    });

    Route::prefix('/nilai_latihan')
    ->name('nilai_latihan.')
    ->controller(CNilaiLatihan::class)
    ->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/detail/{nomor}','detail')->name('detail');
        Route::get('/reset/{nomor}','reset')->name('reset');
    });

    Route::resource('/siswa',CSiswa::class,['parameters' => ['siswa' => 'mSiswa']]);


    Route::prefix('/datatable')
    ->name('datatable.')
    ->group(function(){
        Route::get('/materi',[CDatatable::class,'materi'])->name('materi');
        Route::get('/latihan',[CDatatable::class,'latihan'])->name('latihan');
        Route::get('/latihan-detail',[CDatatable::class,'latihanDetail'])->name('latihan.detail');
        Route::get('/permainan',[CDatatable::class,'permainan'])->name('permainan');
        Route::get('/siswa',[CDatatable::class,'siswa'])->name('siswa');
        Route::get('/nilai-latihan',[CDatatable::class,'nilaiLatihan'])->name('nilai_latihan');
        Route::get('/nilai-latihan/detail',[CDatatable::class,'nilaiLatihanDetail'])->name('nilai_latihan.detail');
    });
});

Route::middleware('auth:siswa')->group(function(){
    Route::prefix('/client')
        ->name('client.')
        ->group(function(){
            Route::get('/logout',[SiswaCLogin::class,'logout'])->name('logout');
            Route::get('/home',CHome::class)->name('home');
            Route::get('/materi',[SiswaMateri::class,'index'])->name('materi');
            Route::get('/latihan',[SiswaLatihan::class,'index'])->name('latihan');
            Route::get('/latihan/detail/{nomor}',[SiswaLatihan::class,'detail'])->name('latihan.detail');
            Route::get('/latihan/next/{nomor}',[SiswaLatihan::class,'next'])->name('latihan.next');
            Route::get('/latihan/thankyu',[SiswaLatihan::class,'thankyu'])->name('latihan.thankyu');
            Route::get('/materi-detail/{mmateri}',[SiswaMateri::class,'show'])->name('materi.detail');
        });
});
