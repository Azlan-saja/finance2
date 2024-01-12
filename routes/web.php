<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BagianController;

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

Auth::routes([
  'register' => false,
  'reset' => false,
  'verify' => false,
]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth', 'user-access:YYS'])->group(function () {
    Route::get('/yys/home', [HomeController::class, 'index'])->name('YYS.home');
    Route::resource('yys/bagian', BagianController::class);
    Route::post('/yys/bagian/search', [BagianController::class, 'cari'])->name('bagian.search');

});

Route::middleware(['auth', 'user-access:SD'])->group(function () {
    Route::get('/sd/home', [HomeController::class, 'SDHome'])->name('SD.home');
});

Route::middleware(['auth', 'user-access:RA'])->group(function () {
    // Route::get('/ra/home', [HomeController::class, 'RAHome'])->name('RA.home');
});

Route::middleware(['auth', 'user-access:SMP'])->group(function () {
    // Route::get('/smp/home', [HomeController::class, 'SMPHome'])->name('SMP.home');
});

Route::middleware(['auth', 'user-access:YYS'])->group(function () {
    // Route::get('/yys/home', [HomeController::class, 'YYSHome'])->name('YYS.home');
});