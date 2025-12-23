<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\KamarController as AdminKamarController;
use App\Http\Controllers\Admin\PenyewaController;
use App\Http\Controllers\Admin\SewaController as AdminSewaController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\FeedbackController as KeluhanController;
use App\Http\Controllers\Admin\ProfilController as AdminProfilController;

use App\Http\Controllers\Penyewa\ProfilController as PenyewaProfilController;
use App\Http\Controllers\Penyewa\FeedbackController as KeluhanPenyewaController;
use App\Http\Controllers\Penyewa\PerpanjangController;
use App\Http\Controllers\Penyewa\KamarController as PenyewaKamarController;
use App\Http\Controllers\Penyewa\SewaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboard::class, 'index'])
        ->name('admin.dashboard');
});

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('kamar', AdminKamarController::class);
        Route::resource('penyewa', PenyewaController::class)->only(['index']);
        Route::get('/history-pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
        Route::get('/sewa', [AdminSewaController::class, 'index']) ->name('sewa.index');
        Route::get('/keluhan', [KeluhanController::class, 'index'])->name('keluhan.index');
        Route::get('/keluhan/{id}', [KeluhanController::class, 'show'])->name('keluhan.show');
        Route::put('/keluhan/{id}', [KeluhanController::class, 'update'])->name('keluhan.update');
        Route::get('/verifikasi-pembayaran', [PembayaranController::class, 'verifikasiIndex'])->name('pembayaran.verifikasi.index');
        Route::get('/verifikasi-pembayaran/{id}', [PembayaranController::class, 'verifikasiShow'])->name('pembayaran.verifikasi.show');
        Route::put('/verifikasi-pembayaran/{id}', [PembayaranController::class, 'verifikasiUpdate'])->name('pembayaran.verifikasi.update');
        Route::get('/profil', [AdminProfilController::class, 'edit'])->name('profil.edit');
        Route::put('/profil', [AdminProfilController::class, 'update'])->name('profil.update');
    });

Route::middleware(['auth', 'role:penyewa'])
    ->prefix('penyewa')
    ->name('penyewa.')
    ->group(function () {
        Route::get('/profil', [PenyewaProfilController::class, 'profil'])->name('profil');
        Route::get('/kamar', [PenyewaKamarController::class, 'index'])->name('kamar.index');
        Route::post('/sewa/{kamar}', [SewaController::class, 'store'])->name('sewa.store');
        Route::get('/perpanjang', [PerpanjangController::class, 'index'])->name('perpanjang.index');
        Route::get('/perpanjang/create', [PerpanjangController::class, 'create'])->name('perpanjang.create');
        Route::post('/perpanjang/confirm', [PerpanjangController::class, 'confirm'])->name('perpanjang.confirm');
        Route::get('/keluhan', [KeluhanPenyewaController::class, 'index'])->name('keluhan.index');
        Route::get('/keluhan/create', [KeluhanPenyewaController::class, 'create'])->name('keluhan.create');
        Route::post('/keluhan', [KeluhanPenyewaController::class, 'store'])->name('keluhan.store');

    });

require __DIR__ . '/auth.php';
