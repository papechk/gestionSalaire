<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

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
Route::get('/',[AuthController::class, 'login'])->name('login');
Route::post('/',[AuthController::class, 'handleLogin'])->name('handleLogin');

Route::get('/dashboard',[AppController::class, 'index'])->name('dashboard')->middleware('auth');
