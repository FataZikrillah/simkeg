<?php

use App\Http\Controllers\AuthController;

Route::redirect('/', '/login');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['auth'])->group(function () {

    // --- SHARED ROUTES (Semua Role) ---

    // --- ADMIN ROUTES ---
    Route::middleware(['role:admin'])->prefix('admin')->as('admin.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('anggaran', App\Http\Controllers\Admin\AnggaranController::class);
        Route::get('kegiatan/{kegiatan}/export', [App\Http\Controllers\Admin\KegiatanController::class, 'export'])->name('kegiatan.export');
        Route::resource('kegiatan', App\Http\Controllers\Admin\KegiatanController::class);
        Route::resource('dokumentasi', App\Http\Controllers\Admin\DokumentasiController::class);
        Route::resource('laporan', App\Http\Controllers\Admin\LaporanController::class);
        Route::resource('pengguna', App\Http\Controllers\Admin\UserController::class);

        // Admin Profile
        Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('profile.update.password');
    });

    // --- STAFF ROUTES ---
    Route::middleware(['role:staff'])->prefix('staff')->as('staff.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Staff\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('kegiatan', App\Http\Controllers\Staff\KegiatanController::class);
        Route::resource('anggaran', App\Http\Controllers\Staff\AnggaranController::class);
        Route::resource('dokumentasi', App\Http\Controllers\Staff\DokumentasiController::class);
        Route::resource('laporan', App\Http\Controllers\Staff\LaporanController::class);

        // Staff Profile
        Route::get('/profile', [App\Http\Controllers\Staff\ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile', [App\Http\Controllers\Staff\ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [App\Http\Controllers\Staff\ProfileController::class, 'updatePassword'])->name('profile.update.password');
    });

    // --- PIMPINAN ROUTES ---
    Route::middleware(['role:pimpinan'])->prefix('pimpinan')->as('pimpinan.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Pimpinan\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/kegiatan/export-pdf', [App\Http\Controllers\Pimpinan\KegiatanController::class, 'exportPdf'])->name('kegiatan.export-pdf');
        Route::resource('kegiatan', App\Http\Controllers\Pimpinan\KegiatanController::class)->only(['index', 'show']);
        Route::resource('anggaran', App\Http\Controllers\Pimpinan\AnggaranController::class);
        Route::patch('laporan/{laporan}/approve', [App\Http\Controllers\Pimpinan\LaporanController::class, 'approve'])->name('laporan.approve');
        Route::resource('laporan', App\Http\Controllers\Pimpinan\LaporanController::class);

        // Pimpinan Profile
        Route::get('/profile', [App\Http\Controllers\Pimpinan\ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile', [App\Http\Controllers\Pimpinan\ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [App\Http\Controllers\Pimpinan\ProfileController::class, 'updatePassword'])->name('profile.update.password');
    });
});
