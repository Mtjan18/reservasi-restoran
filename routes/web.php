<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TableController;

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/
// Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');
// Form Reservasi
Route::get('/reserve', [ReservationController::class, 'create'])->name('reservation.create');
Route::post('/reservation/check', [ReservationController::class, 'checkAvailability'])->name('reservation.check');
Route::get('/reservation/confirmation', [ReservationController::class, 'confirmation'])->name('reservation.confirmation');
Route::post('/reservation/store', [ReservationController::class, 'store'])->name('reservation.store');
Route::get('/reservation/success/{code}', function ($code) {
    return view('reservation.success', compact('code'));
})->name('reservation.success');

// Group Route untuk Manajemen Reservasi Pelanggan (Check Booking)
Route::get('/check-booking', [ReservationController::class, 'checkForm'])->name('booking.check.form');
Route::post('/check-booking', [ReservationController::class, 'checkResult'])->name('booking.check.result');
Route::get('/reservation/detail/{id}', [ReservationController::class, 'detail'])->name('booking.detail'); 
Route::middleware('web')->prefix('reservation')->group(function () {
    Route::get('/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservation.edit');
    Route::put('/{reservation}', [ReservationController::class, 'update'])->name('reservation.update');
    Route::put('/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservation.cancel');
});

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [LoginController::class, 'login'])->name('admin.login.attempt');
Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');


/*
|--------------------------------------------------------------------------
| Admin Dashboard & Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Reservations List (Laporan Reservasi) <-- INI YANG MEMPERBAIKI ERROR
    Route::get('/reservations', [DashboardController::class, 'reservationsList'])->name('reservations.list');

    // CRUD Meja (Table Management)
    Route::resource('tables', TableController::class);

    // Laporan Reservasi (ReportController)
    Route::get('/reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
});