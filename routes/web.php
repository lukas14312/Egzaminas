<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrekeController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PrekeController::class, 'index'])->name('prekes.index');

// Dashboard page for authenticated users only
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated routes that require login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
    Route::resource('prekes', PrekeController::class);
    Route::get('/generate-pdf', [PDFController::class, 'generatePDF'])->name('prekes.generate-pdf');
});


Route::get('/home', [HomeController::class, 'index'])->name('home');


require __DIR__.'/auth.php';
