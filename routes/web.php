<?php

use App\Http\Controllers\MerkController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\ModelMobilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiSewaController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::get('/test', function () {
//     return view('management_mobil.input_data_mobil');
// });

Route::middleware('auth')->group(function () {

    //data mobil
    Route::get('/info-data-mobil', [MobilController::class, 'index'])->name('info-data-mobil');
    Route::get('/get-data-mobil/{id}', [MobilController::class, 'getMobil'])->name('get-data-mobil');
    Route::post('/info-data-mobil', [MobilController::class, 'store'])->name('info-data-mobil.store');
    Route::put('/info-data-mobil/{id}', [MobilController::class, 'update'])->name('get-data-mobil.update');
    Route::delete('/info-data-mobil/{id}', [MobilController::class, 'destroy'])->name('get-data-mobil.destroy');

    //Master Merk
    Route::get('/merk', [MerkController::class, 'index'])->name('merk');
    Route::get('/get-merk/{id}', [MerkController::class, 'getMerk'])->name('get-merk');
    Route::post('/merk', [MerkController::class, 'store'])->name('merk.store');
    Route::put('/merk/{id}', [MerkController::class, 'update'])->name('merk.update');
    Route::delete('/merk/{id}', [MerkController::class, 'destroy'])->name('merk.destroy');

    //Master Model
    Route::get('/model', [ModelMobilController::class, 'index'])->name('model');
    Route::get('/get-model/{id}', [ModelMobilController::class, 'getmodel'])->name('get-model');
    Route::post('/model', [ModelMobilController::class, 'store'])->name('model.store');
    Route::put('/model/{id}', [ModelMobilController::class, 'update'])->name('model.update');
    Route::delete('/model/{id}', [ModelMobilController::class, 'destroy'])->name('model.destroy');

    //Pinjam Mobil
    Route::get('/pinjam-mobil', [TransaksiSewaController::class, 'pinjam_index'])->name('pinjam-mobil');
    Route::get('/pinjam-mobil/{id}', [TransaksiSewaController::class, 'getTarif'])->name('getTarif');
    Route::get('/data-kendaraan', [TransaksiSewaController::class, 'getDataKendaraan'])->name('getDataKendaraan');
    Route::post('/pinjam-mobil', [TransaksiSewaController::class, 'store'])->name('pinjam-mobil.store');
    Route::delete('/pinjam-mobil/{id}', [TransaksiSewaController::class, 'destroy'])->name('pinjam-mobil.destroy');


    //Kembalikan Mobil
    Route::get('/retur-mobil', [TransaksiSewaController::class, 'retur_mobil'])->name('retur-mobil');
    Route::get('/retur-mobil-history', [TransaksiSewaController::class, 'retur_mobil_history'])->name('retur-mobil-history');
    Route::put('/retur-mobil/{id}', [TransaksiSewaController::class, 'kembalikan_mobil'])->name('retur-mobil.update');
});

require __DIR__ . '/auth.php';
