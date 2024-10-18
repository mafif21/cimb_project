<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;

Route::get('/branches', [ApiController::class, 'getBranches'])->name('api.branches');
Route::post('/askbot', [ApiController::class, 'askChatBot'])->name('api.askbot');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
