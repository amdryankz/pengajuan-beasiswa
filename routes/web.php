<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AplicantController;
use App\Http\Controllers\BioUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\FileRequirementController;
use App\Http\Controllers\PassFileController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\SpecScholarshipController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserScholarshipController;
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

Route::middleware('auth:admin')->group(function () {
    // Donatur
    Route::resource('/adm/donatur', DonorController::class);

    // Berkas
    Route::resource('/adm/berkas', FileRequirementController::class);

    // Pengelolaan
    Route::resource('/adm/pengelolaan', ScholarshipController::class);
    Route::put('/adm/pengelolaan/sk/{id}', [ScholarshipController::class, 'updateSK'])->name('beasiswa.updateSK');

    // Beasiswa khusus
    Route::resource('adm/beasiswa-khusus', SpecScholarshipController::class);
    Route::put('/adm/beasiswa-khusus/sk/{id}', [SpecScholarshipController::class, 'updateSK'])->name('khusus.updateSK');

    // Pendaftar Beasiswa
    Route::get('/adm/pengusul', [UserScholarshipController::class, 'showScholarships'])->name('registrations.list');
    Route::get('/adm/pengusul/{scholarship_id}', [UserScholarshipController::class, 'showRegistrationsByScholarship'])->name('registrations.index');
    Route::get('/adm/pengusul/{user_id}/{scholarship_id}/detail', [UserScholarshipController::class, 'showDetail'])->name('admin.scholarship.detail');
    Route::get('/adm/pengusul/download/{file_path}', [UserScholarshipController::class, 'downloadFile'])->name('admin.scholarship.download');
    Route::post('/adm/pengusul/validate/{scholarship_id}/{user_id}', [UserScholarshipController::class, 'validateFile'])->name('admin.scholarship.validate');
    Route::post('/adm/pengusul/cancel-validation/{scholarship_id}/{user_id}', [UserScholarshipController::class, 'cancelValidation'])->name('admin.scholarship.cancelValidation');
    Route::get('/adm/pengusul/{user_id}/{scholarship_id}/pdf', [UserScholarshipController::class, 'generatePDF'])->name('admin.scholarship.pdf');

    // Access login admin
    Route::get('/adm/akses', [AdminAuthController::class, 'index'])->name('access.index');
    Route::get('/adm/akses/create', [AdminAuthController::class, 'create'])->name('access.create');
    Route::post('/adm/akses', [AdminAuthController::class, 'store'])->name('access.store');
    Route::get('/adm/akses/{id}/edit', [AdminAuthController::class, 'edit'])->name('access.edit');
    Route::put('/adm/akses/{id}', [AdminAuthController::class, 'update'])->name('access.update');
    Route::delete('/adm/akses/{id}', [AdminAuthController::class, 'destroy'])->name('access.destroy');

    // Kelulusan beasiswa
    Route::get('/adm/kelulusan', [PassFileController::class, 'index'])->name('passfile.list');
    Route::get('/adm/kelulusan/{scholarship_id}', [PassFileController::class, 'showPassFileByScholarship'])->name('passfile.index');
    Route::get('/adm/kelulusan/{user_id}/{scholarship_id}/detail', [PassFileController::class, 'showDetail'])->name('passfile.detail');
    Route::post('/adm/kelulusan/pass/{scholarship_id}/{user_id}', [PassFileController::class, 'validateScholar'])->name('passfile.validate');
    Route::post('/adm/kelulusan/cancel-pass/{scholarship_id}/{user_id}', [PassFileController::class, 'cancelValidation'])->name('passfile.cancelValidate');
    Route::get('/adm/kelulusan/{scholarship_id}/downloadExcel', [PassFileController::class, 'export'])->name('passfile.downloadExcel');

    // Beasiswa berlangsung
    Route::get('/adm/berlangsung', [AplicantController::class, 'index'])->name('aplicant.list');
    Route::get('/adm/berlangsung/{scholarship_id}', [AplicantController::class, 'showAplicantByScholarship'])->name('aplicant.index');
    Route::get('/adm/berlangsung/{scholarship_id}/downloadExcel', [AplicantController::class, 'export'])->name('aplicant.downloadExcel');

    // Alumni beasiswa
    Route::get('/adm/alumni', [AlumniController::class, 'index'])->name('alumni.list');
    Route::get('/adm/alumni/{scholarship_id}', [AlumniController::class, 'showAlumniByScholarship'])->name('alumni.index');
    Route::get('/adm/alumni/{scholarship_id}/downloadExcel', [AlumniController::class, 'export'])->name('alumni.downloadExcel');

    // Beranda
    Route::get('/adm/beranda', [DashboardController::class, 'index']);

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
    Route::get('/mhs/biodata', [BioUserController::class, 'index'])->name('biodata.index');
    Route::put('/mhs/biodata/update', [BioUserController::class, 'update'])->name('biodata.update');
    Route::get('/mhs/logout', [UserAuthController::class, 'logout']);
});
