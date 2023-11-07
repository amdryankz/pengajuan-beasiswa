<?php

use App\Models\FileRequirement;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AplicantController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\FileRequirementController;
use App\Http\Controllers\SpecScholarshipController;
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

Route::middleware('auth:admin')->group(function () {
    Route::resource('/adm/donatur', DonorController::class);
    Route::resource('/adm/berkas', FileRequirementController::class);
    Route::resource('/adm/beasiswa', ScholarshipController::class);
    Route::get('/adm/registrations', [UserScholarshipController::class, 'showRegistrations']);
    Route::get('/adm/registrations/{user_id}/{scholarship_id}/detail', [UserScholarshipController::class, 'showDetail'])->name('admin.scholarship.detail');
    Route::get('/adm/scholarship/download/{file_path}', [UserScholarshipController::class, 'downloadFile'])->name('admin.scholarship.download');
    Route::post('/adm/scholarship/validate/{scholarship_id}', [UserScholarshipController::class, 'validateFile'])->name('admin.scholarship.validate');
    Route::post('/adm/scholarship/cancel-validation/{scholarship_id}', [UserScholarshipController::class, 'cancelValidation'])->name('admin.scholarship.cancelValidation');
    Route::resource('adm/khusus', SpecScholarshipController::class);
    Route::get('/adm/khusus/{scholarship_data_id}/list', [SpecScholarshipController::class, 'showList'])->name('khusus.listStudents');
    Route::get('/adm/access', [AdminAuthController::class, 'index'])->name('access.index');
    Route::get('/adm/access/create', [AdminAuthController::class, 'create'])->name('access.create');
    Route::post('/adm/access', [AdminAuthController::class, 'store'])->name('access.store');
    Route::get('/adm/access/{id}/edit', [AdminAuthController::class, 'edit'])->name('access.edit');
    Route::put('/adm/access/{id}', [AdminAuthController::class, 'update'])->name('access.update');
    Route::delete('/adm/access/{id}', [AdminAuthController::class, 'destroy'])->name('access.destroy');
    Route::get('/adm/aplicant', [AplicantController::class, 'index'])->name('aplicant.index');
    Route::get('/adm/passfile', [AplicantController::class, 'indexPass'])->name('passfile.index');

    Route::get('/adm/dashboard', [DashboardController::class, 'index']);
    Route::get('/adm/logout', [AdminAuthController::class, 'logout']);
});

// Rute Admin Authentication
Route::middleware('guest:admin')->group(function () {
    Route::get('/adm', [AdminAuthController::class, 'login'])->name('login');
    Route::post('/adm', [AdminAuthController::class, 'authenticating']);
});

Route::get('/', [UserAuthController::class, 'login'])->name('loginUser');
Route::post('/', [UserAuthController::class, 'authenticating']);

Route::get('/mhs/logout', [AdminAuthController::class, 'logout']);
Route::resource('/mhs/dashboard', UserScholarshipController::class);
