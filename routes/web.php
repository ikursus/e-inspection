<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\Admin\JabatanController;

Route::get('/', [HomeController::class, 'index'])->name('homepage');

// Format: Route::method('uri', [Controller::class, 'method']);
Route::get('/login', [LoginController::class, 'borang'])->name('login');
Route::post('/login', [LoginController::class, 'processLogin'])->name('login.authenticate');

/* Mula Senarai Route untuk pengguna */

Route::middleware(['auth'])->group( function() {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::get('/inspections', [InspectionController::class, 'index'])->name('user.inspections.rekod');
    Route::get('/inspections/new', [InspectionController::class, 'create'])->name('user.inspections.borang');
    Route::post('/inspections/new', [InspectionController::class, 'store'])->name('user.inspections.store');
    Route::get('/inspections/{id}', [InspectionController::class, 'show'])->name('user.inspections.show');
    /* Tamat Senarai Route untuk pengguna */

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');  

} );

Route::middleware(['auth', 'checkAdminRole'])->group(function () {
    
    
    /// Senarai Route untuk admin
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    // Route untuk memaparkan senarai jabatan
    Route::get('/admin/jabatan', [JabatanController::class, 'index'])->name('admin.jabatan.index');

    // Route untuk memaparkan borang tambah rekod jabatan
    Route::get('/admin/jabatan/baru', [JabatanController::class, 'create'])->name('admin.jabatan.create');

    // Route untuk mengambil data daripada borang tambah rekod jabatan
    Route::post('/admin/jabatan/baru', [JabatanController::class, 'store'])->name('admin.jabatan.store');

    // Route untuk paparkan borang edit rekod
    Route::get('/admin/jabatan/{id}/edit', [JabatanController::class, 'edit'])->name('admin.jabatan.edit');

    // Route untuk ambil data daripada borang edit rekod
    Route::put('/admin/jabatan/{id}/edit', [JabatanController::class, 'update'])->name('admin.jabatan.update');

    // Route untuk delete data
    Route::delete('/admin/jabatan/{id}/delete', [JabatanController::class, 'destroy'])->name('admin.jabatan.destroy');

    // Routes untuk Users
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/baru', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users/baru', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}/delete', [UserController::class, 'destroy'])->name('admin.users.destroy');
    
    // Admin Inspections Routes
    Route::get('/admin/inspections', [App\Http\Controllers\Admin\InspectionController::class, 'index'])->name('admin.inspections.index');
    Route::get('/admin/inspections/export', [App\Http\Controllers\Admin\InspectionController::class, 'export'])->name('admin.inspections.export');
    Route::get('/admin/inspections/pdf', [App\Http\Controllers\Admin\InspectionController::class, 'pdf'])->name('admin.inspections.pdf');
    Route::get('/admin/inspections/{id}', [App\Http\Controllers\Admin\InspectionController::class, 'show'])->name('admin.inspections.show');
    Route::delete('/admin/inspections/{id}', [App\Http\Controllers\Admin\InspectionController::class, 'destroy'])->name('admin.inspections.destroy');   
        
});

Route::get('/artisan/migrate', function () {
    Artisan::call('migrate', ['--force' => true]);
    Artisan::call('db:seed', ['--force' => true]);
});