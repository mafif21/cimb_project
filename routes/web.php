<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [LandingController::class, 'index'])->name('index');
Route::get('/test', [LandingController::class, 'test'])->name('test');

Route::middleware('auth')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('branch', BranchController::class);
    Route::get('/wibs', function () {
        return view('admin.wibs.index');
    })->name('wibs.index');
});

require __DIR__ . '/auth.php';
