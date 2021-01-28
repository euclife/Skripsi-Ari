<?php

use App\Http\Controllers\Auth\AuthController;
use Module\AccountController;
use Module\KontrakController;
use Module\BarangController;
use Module\PengirimanController;
use App\Http\Controllers\Module\PerusahaanController;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/Auth/Login', [AuthController::class,"index"])->name('login');
    Route::post('/Auth/Login', [AuthController::class,"login"]);
});


Route::middleware(['auth'])->group(function () {
    Route::get('/', 'PagesController@index')->name("index");

    Route::get('/Auth/Logout', [AuthController::class, 'logout'])->name("logout");

    Route::resource('Account', AccountController::class);
    Route::resource('Kontrak', KontrakController::class);
    Route::resource('Pengiriman', PengirimanController::class);

    Route::post('/Perusahaan', [PerusahaanController::class,"store"])->name("Perusahaan.store");
    Route::get('/Perusahaan', [PerusahaanController::class,"index"])->name("Perusahaan.index");

    Route::get('/Barang', "Module\BarangController@create")->name("Barang.create");
    Route::post('/Barang', "Module\BarangController@store")->name("Barang.store");
});
