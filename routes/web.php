<?php

use App\Models\FileRequirement;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AplicantController;
use App\Http\Controllers\PassFileController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminAuthController;
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
    // Donatur
    Route::resource('/adm/donatur', DonorController::class);

    // Berkas
    Route::resource('/adm/berkas', FileRequirementController::class);

    // Pengelolaan
    Route::resource('/adm/beasiswa', ScholarshipController::class);

    // Beasiswa khusus
    Route::resource('adm/khusus', SpecScholarshipController::class);
    Route::get('/adm/khusus/{scholarship_data_id}/list', [SpecScholarshipController::class, 'showList'])->name('khusus.listStudents');

    // Pendaftar Beasiswa
    Route::get('/adm/registrations', [UserScholarshipController::class, 'showScholarships'])->name('registrations.list');
    Route::get('/adm/registrations/{scholarship_id}', [UserScholarshipController::class, 'showRegistrationsByScholarship'])->name('registrations.index');
    Route::get('/adm/registrations/{user_id}/{scholarship_id}/detail', [UserScholarshipController::class, 'showDetail'])->name('admin.scholarship.detail');
    Route::get('/adm/scholarship/download/{file_path}', [UserScholarshipController::class, 'downloadFile'])->name('admin.scholarship.download');
    Route::post('/adm/scholarship/validate/{scholarship_id}', [UserScholarshipController::class, 'validateFile'])->name('admin.scholarship.validate');
    Route::post('/adm/scholarship/cancel-validation/{scholarship_id}', [UserScholarshipController::class, 'cancelValidation'])->name('admin.scholarship.cancelValidation');
    Route::get('/adm/scholarship/{user_id}/{scholarship_id}/pdf', [UserScholarshipController::class, 'generatePDF'])->name('admin.scholarship.pdf');

    // Access login admin
    Route::get('/adm/access', [AdminAuthController::class, 'index'])->name('access.index');
    Route::get('/adm/access/create', [AdminAuthController::class, 'create'])->name('access.create');
    Route::post('/adm/access', [AdminAuthController::class, 'store'])->name('access.store');
    Route::get('/adm/access/{id}/edit', [AdminAuthController::class, 'edit'])->name('access.edit');
    Route::put('/adm/access/{id}', [AdminAuthController::class, 'update'])->name('access.update');
    Route::delete('/adm/access/{id}', [AdminAuthController::class, 'destroy'])->name('access.destroy');

    // Kelulusan beasiswa
    Route::get('/adm/passfile', [PassFileController::class, 'index'])->name('passfile.index');
    Route::post('/adm/passfile/pass/{scholarship_id}', [PassFileController::class, 'validateScholar'])->name('passfile.validate');
    Route::post('/adm/passfile/cancel-pass/{scholarship_id}', [PassFileController::class, 'cancelValidation'])->name('passfile.cancelValidate');

    // Beasiswa berlangsung
    Route::get('/adm/aplicant', [AplicantController::class, 'index'])->name('aplicant.index');

    // Alumni beasiswa
    Route::get('/adm/alumni', [AlumniController::class, 'index'])->name('alumni.index');

    // Beranda
    Route::get('/adm/dashboard', [DashboardController::class, 'index']);

    // Logout admin
    Route::get('/adm/logout', [AdminAuthController::class, 'logout']);
});

// Rute Admin Authentication
Route::middleware('guest:admin')->group(function () {
    Route::get('/adm', [AdminAuthController::class, 'login'])->name('login');
    Route::post('/adm', [AdminAuthController::class, 'authenticating']);
});

// Rute User Authentication
Route::middleware('guest_user')->group(function () {
    Route::get('/', [UserAuthController::class, 'login'])->name('loginUser');
    Route::post('/', [UserAuthController::class, 'authenticating']);
});

Route::middleware('auth_user')->group(function () {
    // Daftar beasiswa
    Route::resource('/mhs/dashboard', UserScholarshipController::class);
    Route::get('/mhs/logout', [AdminAuthController::class, 'logout']);
});
