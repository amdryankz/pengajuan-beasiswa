<?php

use App\Models\FileRequirement;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\FileRequirementController;
use App\Http\Controllers\UserScholarshipController;

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

Route::middleware('auth:admin')->group(function () {
    Route::resource('/adm/donatur', DonorController::class);
    Route::resource('/adm/berkas', FileRequirementController::class);
    Route::resource('/adm/beasiswa', ScholarshipController::class);
    Route::get('/adm/registrations', [UserScholarshipController::class, 'showRegistrations']);
    Route::get('/adm/registrations/{user_id}/{scholarship_id}/detail', [UserScholarshipController::class, 'showDetail'])->name('admin.scholarship.detail');
    Route::get('/admin/scholarship/download/{file_path}', [UserScholarshipController::class, 'downloadFile'])->name('admin.scholarship.download');


    Route::get('/adm/dashboard', [DashboardController::class, 'index']);
    Route::get('/adm/logout', [AdminAuthController::class, 'logout']);
});

// Rute Admin Authentication
Route::middleware('guest:admin')->group(function () {
    Route::get('/', [UserAuthController::class, 'login']);
    Route::post('/', [UserAuthController::class, 'authenticating']);
    Route::get('/adm', [AdminAuthController::class, 'login'])->name('login');
    Route::post('/adm', [AdminAuthController::class, 'authenticating']);
});

Route::middleware('user.auth')->group(function () {
    Route::get('/mhs/logout', [AdminAuthController::class, 'logout']);
    Route::resource('/mhs/dashboard', UserScholarshipController::class);
});
