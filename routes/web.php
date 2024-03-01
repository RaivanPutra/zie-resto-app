<?php

use App\Models\Menu;
use App\Models\Jenis;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\MemberController;

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


Route::get('/',[HomeController::class, 'Home']);
Route::resource('menu',MenuController::class);
Route::resource('jenis',JenisController::class);
Route::resource('stok',StokController::class);
Route::resource('member',MemberController::class);
Route::get('login',[AuthController::class, 'login'])->name('login');
Route::post('/login/cek', [AuthController::class, 'cekLogin'])->name('cekLogin');
Route::get('logout',[AuthController::class, 'logout'])->name('logout');