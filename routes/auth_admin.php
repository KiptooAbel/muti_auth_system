<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisteredAdminController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredAdminController::class, 'create'])
                ->name('AdminRegister');

    Route::post('register', [RegisteredAdminController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])
                ->name('AdminLogin');

    Route::post('login', [LoginController::class, 'store']);

});

Route::middleware('auth:admin')->group(function () {
 
    Route::get('admin/dashboard', function () {
        return Inertia::render('Admin/AdminDashboard');
    })->name('AdminDashboard');

});

Route::middleware('auth:admin')->group(function () {
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
    Route::post('admin/logout', [LoginController::class, 'destroy'])
    ->name('admin.logout');
}); 
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
->name('logout');
