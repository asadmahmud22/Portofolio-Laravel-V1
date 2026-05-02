<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AchievementController; // Tambahkan import

// ================= PUBLIC =================
Route::get('/',             [PublicController::class, 'index'])->name('home');
Route::get('/about',        [PublicController::class, 'about'])->name('about');
Route::get('/skills',       [PublicController::class, 'skills'])->name('skills');
Route::get('/achievements', [PublicController::class, 'achievements'])->name('achievements');
Route::get('/projects',     [PublicController::class, 'projects'])->name('projects');
Route::get('/contact',      [PublicController::class, 'contact'])->name('contact');
Route::post('/contact',     [PublicController::class, 'sendMessage'])->name('contact.send');

// ================= AUTH =================
require __DIR__.'/auth.php';

// ================= ADMIN =================
use App\Http\Controllers\Admin\AdminController;

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // redirect /admin → dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('dashboard');

    // profile (halaman)
    Route::get('/profile', [AdminController::class, 'profile'])
        ->name('profile');

    // projects (CRUD)
    Route::resource('/projects', ProjectController::class);

    // achievements (CRUD) - TAMBAHKAN DI SINI
    Route::resource('/achievements', AchievementController::class);

    // statistics
    Route::get('/statistics', [AdminController::class, 'statistics'])
        ->name('statistics');

    // settings
    Route::get('/settings', [AdminController::class, 'settings'])
        ->name('settings');
});