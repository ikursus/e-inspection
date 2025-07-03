<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InspectionController;

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

