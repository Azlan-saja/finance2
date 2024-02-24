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
use App\Http\Controllers\LaporanController;

use App\Http\Controllers\UserPenggunaController;
use App\Http\Controllers\UserRABController;
use App\Http\Controllers\UserRealisasiController;
use App\Http\Controllers\UserBebanController;
use App\Http\Controllers\UserPemasukanController;


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
    Route::put('yys/rencana/closed/{rencana}/rencana', [RencanaController::class, 'closed_rencana'])->name('rencana.closed.rencana');
    Route::put('yys/rencana/closed/{rencana}/realisasi', [RencanaController::class, 'closed_realisasi'])->name('rencana.closed.realisasi');


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
    Route::patch('yys/pengguna/reset/{pengguna}', [PenggunaController::class, 'reset'])->name('pengguna.reset');


    Route::get('yys/ubah-password', [PenggunaController::class, 'saya'])->name('pengguna-aktif.saya');
    Route::put('yys/ubah-password', [PenggunaController::class, 'ubah_saya'])->name('pengguna-aktif.ubah');
   
    Route::get('yys/ubah-akun', [PenggunaController::class, 'akun'])->name('pengguna-aktif.akun');
    Route::put('yys/ubah-akun', [PenggunaController::class, 'ubah_akun'])->name('pengguna-aktif.ubah-akun');


});


Route::middleware(['auth', 'user-access:RA|SD|SMP'])->group(function () {
    Route::get('/home', [HomeController::class, 'user'])->name('USER.home');

    Route::get('ubah-password', [UserPenggunaController::class, 'saya'])->name('user.pengguna-aktif.saya');
    Route::put('ubah-password', [UserPenggunaController::class, 'ubah_saya'])->name('user.pengguna-aktif.ubah');
   
    Route::get('ubah-akun', [UserPenggunaController::class, 'akun'])->name('user.pengguna-aktif.akun');   
    Route::put('ubah-akun', [UserPenggunaController::class, 'ubah_akun'])->name('user.pengguna-aktif.ubah-akun');

    Route::get('rencana', [UserRABController::class, 'index'])->name('user.rencana.index');
    Route::post('rencana/search', [UserRABController::class, 'cari'])->name('user.rencana.search');

    // Route::resource('rencana/{rencana_id}/rencana-detail', RencanaDetailController::class)->except(['create','store','destroy','show','update','edit']);
    Route::get('rencana/{rencana_id}/rencana-detail', [UserRABController::class, 'detail'])->name('user.rencana-detail.index');
    Route::post('rencana/{rencana_id}/rencana-detail', [UserRABController::class, 'closed'])->name('user.rencana-detail.closed');
    Route::get('rencana/{rencana_id}/rencana-detail/history', [UserRABController::class, 'history'])->name('user.rencana-detail.history');
    Route::get('rencana/{rencana_id}/rencana-detail/{subbagian}/create', [UserRABController::class, 'create'])->name('user.rencana-detail.create');
    Route::post('rencana/{rencana_id}/rencana-detail/{subbagian}/create', [UserRABController::class, 'store'])->name('user.rencana-detail.store');
    Route::delete('rencana/{rencana_id}/rencana-detail/{subbagian}/create/{rencana_detail}', [UserRABController::class, 'destroy'])->name('user.rencana-detail.destroy');

    Route::get('rencana/{rencana_id}/realisasi', [UserRealisasiController::class, 'index'])->name('user.realisasi.index');
    Route::get('rencana/{rencana_id}/realisasi/create/{kegiatan_id}/{bulan}', [UserRealisasiController::class, 'create'])->name('user.realisasi.create');
    Route::post('rencana/{rencana_id}/realisasi/create/{kegiatan_id}/{bulan}', [UserRealisasiController::class, 'store'])->name('user.realisasi.store');

    Route::get('laba-rugi', [LabaRugiController::class,'index'])->name('user.laba-rugi.index');
    Route::post('laba-rugi', [LabaRugiController::class,'search'])->name('user.laba-rugi.search');
   
    Route::resource('pemasukan', UserPemasukanController::class)->names([
        'index' => 'user.pemasukan.index',
        'create' => 'user.pemasukan.create',
        'store' => 'user.pemasukan.store',
        'show' => 'user.pemasukan.show',
        'edit' => 'user.pemasukan.edit',
        'update' => 'user.pemasukan.update',
        'destroy' => 'user.pemasukan.destroy',
    ]);
    Route::post('pemasukan/search', [UserPemasukanController::class, 'cari'])->name('user.pemasukan.search');

    Route::resource('beban', UserBebanController::class)->names([
        'index' => 'user.beban.index',
        'create' => 'user.beban.create',
        'store' => 'user.beban.store',
        'show' => 'user.beban.show',
        'edit' => 'user.beban.edit',
        'update' => 'user.beban.update',
        'destroy' => 'user.beban.destroy',
    ]);
    Route::post('beban/search', [UserBebanController::class, 'cari'])->name('user.beban.search');


});

Route::middleware(['auth', 'user-access:RA|SD|SMP|YYS'])->group(function () {
    Route::get('yys/laporan/bagian', [LaporanController::class, 'bagian'])->name('laporan.bagian');
    Route::get('yys/laporan/kegiatan', [LaporanController::class, 'kegiatan'])->name('laporan.kegiatan');
    Route::get('yys/laporan/sasaran', [LaporanController::class, 'sasaran'])->name('laporan.sasaran');
    Route::get('yys/laporan/anggaran', [LaporanController::class, 'anggaran'])->name('laporan.anggaran');
    Route::get('yys/laporan/satuan', [LaporanController::class, 'satuan'])->name('laporan.satuan');
    Route::get('yys/laporan/pemasukan', [LaporanController::class, 'pemasukan'])->name('laporan.pemasukan');
    Route::get('yys/laporan/rencana', [LaporanController::class, 'rencana'])->name('laporan.rencana');
    Route::get('yys/laporan/rencana/{rencana_id}/rencana-detail', [LaporanController::class, 'rencana_detail'])->name('laporan.rencana-detail');
    Route::get('yys/laporan/rencana/{rencana_id}/realisasi', [LaporanController::class, 'realisasi'])->name('laporan.realisasi');
    Route::post('yys/laporan/laba-rugi', [LaporanController::class, 'laba_rugi'])->name('laporan.laba-rugi');
    Route::get('yys/laporan/beban', [LaporanController::class, 'beban'])->name('laporan.beban');
    Route::get('yys/laporan/pengguna', [LaporanController::class, 'pengguna'])->name('laporan.pengguna');
    Route::get('bukti/file/pdf/{file}', [LaporanController::class, 'file_pdf'])->name('laporan.bukti');
});
