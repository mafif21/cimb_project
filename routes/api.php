<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;

Route::get('/branches', [ApiController::class, 'getBranches'])->name('api.branches');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
