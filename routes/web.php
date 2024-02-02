<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\SubBagianController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\SasaranController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\RencanaController;
use App\Http\Controllers\RencanaDetailController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\RealisasiController;
use App\Http\Controllers\LabaRugiController;
use App\Http\Controllers\BebanController;
use App\Http\Controllers\PenggunaController;


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
    
    Route::resource('yys/bagian/{id}/subbagian', SubBagianController::class);
    Route::post('yys/bagian/{id}/subbagian/search', [SubBagianController::class, 'cari'])->name('subbagian.search');
    
    Route::resource('yys/kegiatan', KegiatanController::class);
    Route::post('yys/kegiatan/search', [KegiatanController::class, 'cari'])->name('kegiatan.search');
    
    Route::resource('yys/sasaran', SasaranController::class);
    Route::post('yys/sasaran/search', [SasaranController::class, 'cari'])->name('sasaran.search');

    Route::resource('yys/anggaran', AnggaranController::class);
    Route::post('yys/anggaran/search', [AnggaranController::class, 'cari'])->name('anggaran.search');

    Route::resource('yys/satuan', SatuanController::class);
    Route::post('yys/satuan/search', [SatuanController::class, 'cari'])->name('satuan.search');
    
    Route::resource('yys/pemasukan', PemasukanController::class);
    Route::post('yys/pemasukan/search', [PemasukanController::class, 'cari'])->name('pemasukan.search');

    
    Route::resource('yys/rencana', RencanaController::class);
    Route::post('yys/rencana/search', [RencanaController::class, 'cari'])->name('rencana.search');
    Route::put('yys/rencana/closed/{rencana}', [RencanaController::class, 'closed'])->name('rencana.closed');


    Route::resource('yys/rencana/{rencana_id}/rencana-detail', RencanaDetailController::class)->except(['create','store','destroy','show','update','edit']);
    Route::get('yys/rencana/{rencana_id}/rencana-detail/{subbagian}/create', [RencanaDetailController::class, 'create'])->name('rencana-detail.create');
    Route::post('yys/rencana/{rencana_id}/rencana-detail/{subbagian}/create', [RencanaDetailController::class, 'store'])->name('rencana-detail.store');
    Route::delete('yys/rencana/{rencana_id}/rencana-detail/{subbagian}/create/{rencana_detail}', [RencanaDetailController::class, 'destroy'])->name('rencana-detail.destroy');
    Route::get('yys/rencana/{rencana_id}/rencana-detail/history', [RencanaDetailController::class, 'history'])->name('rencana-detail.history');

    Route::get('yys/rencana/{rencana_id}/realisasi', [RealisasiController::class, 'index'])->name('realisasi.index');
    Route::get('yys/rencana/{rencana_id}/realisasi/create/{kegiatan_id}/{bulan}', [RealisasiController::class, 'create'])->name('realisasi.create');
    Route::post('yys/rencana/{rencana_id}/realisasi/create/{kegiatan_id}/{bulan}', [RealisasiController::class, 'store'])->name('realisasi.store');

    Route::get('yys/laba-rugi', [LabaRugiController::class,'index'])->name('laba-rugi.index');
    Route::post('yys/laba-rugi', [LabaRugiController::class,'search'])->name('laba-rugi.search');

    Route::resource('yys/beban', BebanController::class);
    Route::post('yys/beban/search', [BebanController::class, 'cari'])->name('beban.search');

    Route::resource('yys/pengguna', PenggunaController::class);
    Route::post('yys/pengguna/search', [PenggunaController::class, 'cari'])->name('pengguna.search');
    Route::patch('yys/pengguna/{pengguna}', [PenggunaController::class, 'reset'])->name('pengguna.reset');


    Route::get('yys/ubah-password', [PenggunaController::class, 'saya'])->name('pengguna-aktif.saya');
    Route::put('yys/ubah-password', [PenggunaController::class, 'ubah'])->name('pengguna-aktif.ubah');

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