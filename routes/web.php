<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\Admin\JabatanController;

Route::get('/', [HomeController::class, 'index'])->name('homepage');

// Format: Route::method('uri', [Controller::class, 'method']);
Route::get('/login', [LoginController::class, 'borang'])->name('login');
Route::post('/login', [LoginController::class, 'processLogin'])->name('login.authenticate');

/* Mula Senarai Route untuk pengguna */

Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');

Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');

Route::get('/inspections', [InspectionController::class, 'index'])->name('user.inspections.rekod');

Route::get('/inspections/new', [InspectionController::class, 'create'])->name('user.inspections.borang');
Route::post('/inspections/new', [InspectionController::class, 'store'])->name('user.inspections.store');

/* Tamat Senarai Route untuk pengguna */

Route::get('/contoh', [HomeController::class, 'contoh'])->name('contoh');


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
