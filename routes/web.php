<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/register/save', 'registerSave')->name('register.save');
    Route::get('/login', 'login')->name('login');
    Route::post('/login/save', 'loginSave')->name('login.save');
    Route::get('/logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'home'])->name('home');

     // ----------------- activity management -----------------
    Route::get('/activity_management', [ActivityController::class, 'index'])->name('user.activity_management');
});

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    
    // ----------------- user management -----------------
    Route::get('/admin/user_management', [UserController::class, 'index'])->name('admin.user_management');
    Route::put('/admin/user_management/{id}/update', [UserController::class, 'update'])->name('admin.user_management.update');
    Route::delete('/admin/user_management/{id}/destroy', [UserController::class, 'destroy'])->name('admin.user_management.destroy');
    Route::post('/admin/user_management/store', [UserController::class, 'store'])->name('admin.user_management.store');
    
    // ----------------- activity management -----------------
    Route::get('/admin/activity_management', [ActivityController::class, 'index'])->name('admin.activity_management');
});

Route::middleware(['auth', 'user-access:admin'],['auth', 'user-access:user'])->group(function () {
    Route::put('/process/activity_management/{id}/update', [ActivityController::class, 'update'])->name('activity_management.update');
    Route::delete('/process/activity_management/{id}/destroy', [ActivityController::class, 'destroy'])->name('activity_management.destroy');
    Route::post('/process/activity_management/store', [ActivityController::class, 'store'])->name('activity_management.store');
});


