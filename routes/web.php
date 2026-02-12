<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Admin routes
Route::get('/', [DashboardController::class,'index'])->middleware(['auth:web', 'verified'])->name('dashboard');
Route::get('/pr/{short_code}', [ShortUrlController::class, 'findShortCode'])->name('find.shortcode');

Route::middleware('auth:web')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Invite memeber and admin
    Route::get('/invite-user', [UserController::class, 'create'])->name('invite-user.create');
    Route::post('/invite-user', [UserController::class, 'store'])->name('invite-user.store');

    Route::resource('shorturls', ShortUrlController::class)->only(['create', 'store']);
});

//Super Routes
Route::prefix('superadmin')->group(function () {

    require __DIR__ .'/superadmin.php';
});


require __DIR__.'/auth.php';
