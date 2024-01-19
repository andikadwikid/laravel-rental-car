<?php

use App\Http\Controllers\MerkController;
use App\Http\Controllers\ModelMobilController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('test');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/test', function () {
    return view('management_mobil.input_data_mobil');
});

Route::get('/info-data-mobil', function () {
    return view('management_mobil.info_data_mobil');
})->name('info-data-mobil');

//Master Merk
Route::get('/merk', [MerkController::class, 'index'])->name('merk');
Route::get('/get-merk', [MerkController::class, 'getData'])->name('get-merk');

//Master Model
Route::get('/model', [ModelMobilController::class, 'index'])->name('model');
Route::get('/get-model', [ModelMobilController::class, 'getData'])->name('get-model');

require __DIR__ . '/auth.php';
