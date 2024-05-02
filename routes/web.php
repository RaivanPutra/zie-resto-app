<?php

use App\Models\Menu;
use App\Models\Jenis;
use App\Http\Middleware\cekUserLogin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\KategoriController;
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
Route::resource('transaksi',TransaksiController::class);

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::get('/data-penjualan/{lastCount}', [HomeController::class, 'dataPenjualan'])->name('data_penjualan');
    
    Route::resource('titipan', ProdukTitipanController::class);
    // export
    Route::get('export/paket', [ProdukTitipanController::class, 'exportData'])->name('export-produk');
    Route::get('export/jenis', [JenisController::class, 'exportData'])->name('export-jenis');
    Route::get('export/kategori', [KategoriController::class, 'exportData'])->name('export-kategori');
    Route::get('export/member', [MemberController::class, 'exportData'])->name('export-member');
    Route::get('export/menu', [MenuController::class, 'exportData'])->name('export-menu');
    Route::get('export/meja', [MejaController::class, 'exportData'])->name('export-meja');
    Route::get('export/stok', [StokController::class, 'exportData'])->name('export-stok');
    Route::get('export/absensi', [AbsensiController::class, 'exportData'])->name('export-absensi');
    // import
    Route::post('import/paket', [ProdukTitipanController::class, 'importData'])->name('import-produk');
    Route::post('import/jenis', [JenisController::class, 'importData'])->name('import-jenis');
    Route::post('import/kategori', [KategoriController::class, 'importData'])->name('import-kategori');
    Route::post('import/meja', [MejaController::class, 'importData'])->name('import-meja');
    Route::post('import/stok', [StokController::class, 'importData'])->name('import-stok');
    Route::post('import/member', [MemberController::class, 'importData'])->name('import-member');
    Route::post('import/menu', [MenuController::class, 'importData'])->name('import-menu');
    

    // Route untuk admin
    Route::group(['middleware' => 'cekUserLogin:1'], function(){
        Route::resource('transaksi', TransaksiController::class);
        Route::resource('menu',MenuController::class);
        Route::resource('kategori',JenisController::class);
        Route::resource('stok',StokController::class);
        Route::resource('jenis',JenisController::class);
        Route::resource('meja',MejaController::class);
        Route::resource('member',MemberController::class);
        Route::resource('absensi',AbsensiController::class);
        Route::get('nota/{nofaktur}',[TransaksiController::class, 'faktur']);
        Route::resource('report',TransaksiController::class);
        Route::resource('kategori',KategoriController::class);
        Route::resource('Meja',MejaController::class);

    });

    // Route untuk kasir
    Route::group(['middleware' => ['cekUserLogin:2']], function(){
        Route::resource('transaksi',TransaksiController::class);
        Route::get('nota/{nofaktur}',[TransaksiController::class, 'faktur']);
        Route::resource('member',MemberController::class);

    });

    // Route untuk owner
    Route::group(['middleware' => ['cekUserLogin:3']], function(){    
        Route::resource('report',TransaksiController::class);
    });
});

