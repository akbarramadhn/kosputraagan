<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\KamarController as AdminKamarController;
use App\Http\Controllers\Admin\PenyewaController;
use App\Http\Controllers\Admin\SewaController as AdminSewaController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\FeedbackController as KeluhanController;
use App\Http\Controllers\Admin\ProfilController as AdminProfilController;

// Penyewa Controllers
use App\Http\Controllers\Penyewa\ProfilController as PenyewaProfilController;
use App\Http\Controllers\Penyewa\FeedbackController as KeluhanPenyewaController;
use App\Http\Controllers\Penyewa\PerpanjangController;
use App\Http\Controllers\Penyewa\PembayaranController as PenyewaPembayaranController;

// Umum Controller
use App\Http\Controllers\Umum\UmumController;
use App\Http\Controllers\Umum\BookingController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

// Umum Routes
Route::get('/kamar/tipe/{tipe}', [UmumController::class, 'detailTipe'])->name('kamar.detailTipe');
Route::get('/', [UmumController::class, 'index']);
Route::post('/booking', [BookingController::class, 'store'])
    ->middleware('auth')
    ->name('booking.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboard::class, 'dashboard'])->name('dashboard');

        Route::resource('kamar', AdminKamarController::class);
        Route::resource('penyewa', PenyewaController::class)->only(['index']);

        Route::get('/history-pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');

        Route::get('/sewa', [AdminSewaController::class, 'index'])->name('sewa.index');

        Route::get('/keluhan', [KeluhanController::class, 'index'])->name('keluhan.index');
        Route::get('/keluhan/{id}', [KeluhanController::class, 'show'])->name('keluhan.show');
        Route::put('/keluhan/{id}', [KeluhanController::class, 'update'])->name('keluhan.update');

        Route::get('/verifikasi-pembayaran', [PembayaranController::class, 'verifikasiIndex'])->name('pembayaran.verifikasi.index');
        Route::put('/admin/pembayaran/verifikasi/{id}',[PembayaranController::class, 'updateStatus'])->name('pembayaran.verifikasi.update');

        Route::get('/profil', [AdminProfilController::class, 'edit'])->name('profil.edit');
        Route::put('/profil', [AdminProfilController::class, 'update'])->name('profil.update');
    });

// Penyewa Routes
Route::middleware(['auth', 'role:penyewa'])
    ->prefix('penyewa')
    ->name('penyewa.')
    ->group(function () {

        Route::get('/status', [PenyewaPembayaranController::class, 'status'])->name('status');

        Route::get('/profil', [PenyewaProfilController::class, 'profil'])
            ->middleware('penyewa.verified')
            ->name('profil');

        Route::get('/perpanjang', [PerpanjangController::class, 'index'])->name('perpanjang.index');
        Route::get('/perpanjang/create', [PerpanjangController::class, 'create'])->name('perpanjang.create');
        Route::post('/perpanjang/confirm', [PerpanjangController::class, 'confirm'])->name('perpanjang.confirm');

        Route::get('/keluhan', [KeluhanPenyewaController::class, 'index'])->name('keluhan.index');
        Route::get('/keluhan/create', [KeluhanPenyewaController::class, 'create'])->name('keluhan.create');
        Route::post('/keluhan', [KeluhanPenyewaController::class, 'store'])->name('keluhan.store');

        Route::get('/pembayaran', [PenyewaPembayaranController::class, 'create'])
            ->name('pembayaran.form');
        Route::post('/pembayaran', [PenyewaPembayaranController::class, 'store'])
            ->name('pembayaran.store');

    });

require __DIR__ . '/auth.php';