<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShortUrlController;
use Illuminate\Support\Facades\Route;

// Admin routes
Route::get('/', [DashboardController::class,'index'])->middleware(['auth:web', 'verified'])->name('dashboard');
Route::get('/pr/{short_code}', [ShortUrlController::class, 'findShortCode'])->name('find.shortcode');


Route::middleware('auth:web')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('shorturls', ShortUrlController::class)->except(['show', 'destroy', 'edit', 'update']);
});

//Super Routes
Route::prefix('superadmin')->group(function () {

    require __DIR__ .'/superadmin.php';
});


require __DIR__.'/auth.php';
