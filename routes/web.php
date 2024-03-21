<?php

use App\Models\Menu;
use App\Models\Jenis;
use App\Http\Middleware\cekUserLogin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProdukTitipanController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Login
Route::get('login',[AuthController::class, 'login'])->name('login');
Route::post('/login/cek', [AuthController::class, 'cekLogin'])->name('cekLogin');
Route::get('logout',[AuthController::class, 'logout'])->name('logout');
Route::resource('pemesanan',TransaksiController::class);

Route::group(['middleware' => 'auth'], function(){
    Route::get('/',[HomeController::class, 'Home']);
    Route::get('about',[HomeController::class, 'about']);
    Route::resource('titipan', ProdukTitipanController::class);
    Route::get('export/paket', [ProdukTitipanController::class, 'exportData'])->name('export-produk');
    Route::get('export/jenis', [JenisController::class, 'exportData'])->name('export-jenis');
    Route::get('export/member', [MemberController::class, 'exportData'])->name('export-member');
    Route::get('export/stok', [StokController::class, 'exportData'])->name('export-stok');
    Route::post('import/paket', [ProdukTitipanController::class, 'importData'])->name('import-produk');
    

    // Route untuk admin
    Route::group(['middleware' => 'cekUserLogin:1'], function(){
        Route::resource('pemesanan', TransaksiController::class);
        Route::resource('menu',MenuController::class);
        Route::resource('jenis',JenisController::class);
        Route::resource('stok',StokController::class);
        Route::resource('member',MemberController::class);
        Route::get('nota/{nofaktur}',[TransaksiController::class, 'faktur']);
        Route::resource('report',TransaksiController::class);

    });

    // Route untuk kasir
    Route::group(['middleware' => ['cekUserLogin:2']], function(){
        Route::resource('pemesanan',TransaksiController::class);
        Route::get('nota/{nofaktur}',[TransaksiController::class, 'faktur']);
    });

    // Route untuk owner
    Route::group(['middleware' => ['cekUserLogin:3']], function(){    
        Route::resource('report',TransaksiController::class);
    });
});

