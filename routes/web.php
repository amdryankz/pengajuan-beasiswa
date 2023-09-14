<?php

use App\Models\FileRequirement;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileRequirementController;

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

Route::get('/dashboard/donatur', [DonorController::class, 'index']);
Route::get('/dashboard/berkas', [FileRequirementController::class, 'index']);

Route::get('/adm', [AdminAuthController::class, 'login'])->name('login')->middleware('guest:admin');
Route::post('/adm', [AdminAuthController::class, 'authenticating'])->middleware('guest:admin');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth:admin');
Route::get('/logout', [AdminAuthController::class, 'logout'])->middleware('auth:admin');
