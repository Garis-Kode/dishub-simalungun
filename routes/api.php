<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CollectionController;

Route::get('/kecamatan', [CollectionController::class, 'kecamatan'])->name('kecamatan');
Route::get('/kecamatan/{id}', [CollectionController::class, 'kelurahan'])->name('kelurahan');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
