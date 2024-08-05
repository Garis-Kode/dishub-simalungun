<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('layouts.app');
});


Route::prefix('/auth')->middleware(['guest'])->group(function () {
    Route::get('/register/kecamatan', [AuthController::class, 'registerDistrict'])->name('register.district');
    Route::post('/register/kecamatan', [AuthController::class, 'registerDistrictSubmit'])->name('register.district.submit');
    Route::get('/register/kelurahan', [AuthController::class, 'registerVillage'])->name('register.village');
    Route::post('/register/kelurahan', [AuthController::class, 'registerVillageSubmit'])->name('register.village.submit');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');
    Route::get('/forgot-password', [AuthController::class, 'forgot'])->name('forgot');
    Route::post('/forgot-password', [AuthController::class, 'forgotSubmit'])->name('forgot.submit');
    Route::get('/forget/{token}/reset', [AuthController::class, 'reset'])->name('reset');
    Route::post('/forget/{token}/reset', [AuthController::class, 'resetSubmit'])->name('reset.submit');
});
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('/profile')->middleware(['auth'])->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile');
    Route::post('/', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('/signin-method', [ProfileController::class, 'signinUpdate'])->name('profile.signin');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
});

Route::prefix('/user')->middleware(['auth'])->group(function () {
    Route::get('/pending', [UserController::class, 'pending'])->name('user.pending');
    Route::get('/pending/data', [UserController::class, 'pendingData'])->name('user.pending.data');
    Route::post('/active', [UserController::class, 'active'])->name('user.active');
});
