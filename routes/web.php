<?php

use App\Http\Controllers\CompanyInviteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAuth\AuthenticateSessionController;
use App\Http\Controllers\SuperDashboardController;
use Illuminate\Support\Facades\Route;

// Admin routes
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth:web', 'verified'])->name('dashboard');

Route::middleware('auth:web')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Super Routes
Route::prefix('superadmin')->group(function () {

    Route::get('/login', [AuthenticateSessionController::class,'create'])->name('superadmin.login');

    Route::post('/login', [AuthenticateSessionController::class,'store']);

    Route::middleware('SuperAuth', 'verified')->group(function () {
        Route::get('/', function () {
            return view('superadmin.dashboard');
        })->name('superadmin.dashboard');
        
        Route::get('/invite-company', [CompanyInviteController::class,'index'])->name('superadmin.invite-company');
        Route::post('/invite-company', [CompanyInviteController::class,'create'])->name('superadmin.invite-company');
        Route::post('/logout', [AuthenticateSessionController::class, 'destroy'])
        ->name('superadmin.logout');
    });
});


require __DIR__.'/auth.php';
