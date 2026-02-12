<?php

use App\Http\Controllers\CompanyInviteController;
use App\Http\Controllers\SuperAuth\AuthenticatedSessionController;
use App\Http\Controllers\SuperDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthenticatedSessionController::class,'create'])->name(SUPER . '.login');
Route::post('/login', [AuthenticatedSessionController::class,'store']);

Route::get('/', [SuperDashboardController::class,'index'])->middleware('SuperAuth')->name(SUPER . '.dashboard');

Route::middleware('SuperAuth')->group(function () {
    Route::get('/invite-company', [CompanyInviteController::class,'create'])->name(SUPER . '.invite-company.create');
    Route::post('/invite-company', [CompanyInviteController::class,'store'])->name(SUPER . '.invite-company.store');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name(SUPER . '.logout');
});