<?php

use App\Models\FileRequirement;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScholarshipController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::resource('/donatur', DonorController::class)->middleware('auth:admin');
// Route::resource('/berkas', FileRequirementController::class)->middleware('auth:admin');
// Route::resource('/beasiswa', ScholarshipController::class)->middleware('auth:admin');

// Route::get('/adm', [AdminAuthController::class, 'login'])->name('login')->middleware('guest:admin');
// Route::post('/adm', [AdminAuthController::class, 'authenticating'])->middleware('guest:admin');

// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth:admin');
// Route::get('/logout', [AdminAuthController::class, 'logout'])->middleware('auth:admin');

Route::redirect('/', '/adm');

Route::middleware('auth:admin')->group(function () {
    Route::resource('/donatur', DonorController::class);
    Route::resource('/berkas', FileRequirementController::class);
    Route::resource('/beasiswa', ScholarshipController::class);

    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/logout', [AdminAuthController::class, 'logout']);
});

// Rute Admin Authentication
Route::middleware('guest:admin')->group(function () {
    Route::get('/adm', [AdminAuthController::class, 'login'])->name('login');
    Route::post('/adm', [AdminAuthController::class, 'authenticating']);
});
