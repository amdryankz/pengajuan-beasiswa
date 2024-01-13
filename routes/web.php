<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DonorController;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\Admin\AdminAccessController;
use App\Http\Controllers\Admin\ScholarshipController;
use App\Http\Controllers\User\UserHomepageController;
use App\Http\Controllers\User\UserScholarshipController;
use App\Http\Controllers\Admin\FileRequirementController;
use App\Http\Controllers\Admin\ScholarshipDataController;
use App\Http\Controllers\Admin\StudentApprovalController;
use App\Http\Controllers\Admin\StudentApplicationController;
use App\Http\Controllers\Admin\StudentScholarshipController;
use App\Http\Controllers\Admin\SpecialScholarshipDataController;

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

    // Beasiswa
    Route::resource('/adm/beasiswa', ScholarshipController::class);

    // Pengelolaan
    Route::resource('/adm/pengelolaan', ScholarshipDataController::class);
    Route::put('/adm/pengelolaan/sk/{id}', [ScholarshipDataController::class, 'updateSK'])->name('beasiswa.updateSK');

    // Beasiswa khusus
    Route::resource('adm/pengelolaan-khusus', SpecialScholarshipDataController::class);
    Route::put('/adm/pengelolaan-khusus/sk/{id}', [SpecialScholarshipDataController::class, 'updateSK'])->name('khusus.updateSK');

    // Pendaftar Beasiswa
    Route::get('/adm/pengusul', [StudentApplicationController::class, 'showScholarships'])->name('registrations.list');
    Route::get('/adm/pengusul/{scholarship_id}', [StudentApplicationController::class, 'showRegistrationsByScholarship'])->name('registrations.index');
    Route::get('/adm/pengusul/{user_id}/{scholarship_id}/detail', [StudentApplicationController::class, 'showDetail'])->name('admin.scholarship.detail');
    Route::get('/adm/pengusul/download/{file_path}', [StudentApplicationController::class, 'downloadFile'])->name('admin.scholarship.download');
    Route::post('/adm/pengusul/validate/{scholarship_id}/{user_id}', [StudentApplicationController::class, 'validateFile'])->name('admin.scholarship.validate');
    Route::post('/adm/pengusul/cancel-validation/{scholarship_id}/{user_id}', [StudentApplicationController::class, 'cancelValidation'])->name('admin.scholarship.cancelValidation');
    Route::get('/adm/pengusul/{user_id}/{scholarship_id}/pdf', [StudentApplicationController::class, 'generatePDF'])->name('admin.scholarship.pdf');

    // Access login admin
    Route::resource('/adm/akses', AdminAccessController::class);

    // Kelulusan beasiswa
    Route::get('/adm/kelulusan', [StudentApprovalController::class, 'index'])->name('passfile.list');
    Route::get('/adm/kelulusan/{scholarship_id}', [StudentApprovalController::class, 'showPassFileByScholarship'])->name('passfile.index');
    Route::get('/adm/kelulusan/{user_id}/{scholarship_id}/detail', [StudentApprovalController::class, 'showDetail'])->name('passfile.detail');
    Route::post('/adm/kelulusan/pass/{scholarship_id}/{user_id}', [StudentApprovalController::class, 'validateScholar'])->name('passfile.validate');
    Route::post('/adm/kelulusan/cancel-pass/{scholarship_id}/{user_id}', [StudentApprovalController::class, 'cancelValidation'])->name('passfile.cancelValidate');
    Route::get('/adm/kelulusan/{scholarship_id}/downloadExcel', [StudentApprovalController::class, 'export'])->name('passfile.downloadExcel');

    // Beasiswa berlangsung
    Route::get('/adm/berlangsung', [StudentScholarshipController::class, 'index'])->name('aplicant.list');
    Route::get('/adm/berlangsung/{scholarship_id}', [StudentScholarshipController::class, 'showAplicantByScholarship'])->name('aplicant.index');
    Route::get('/adm/berlangsung/{user_id}/{scholarship_id}/detail', [StudentScholarshipController::class, 'showDetail'])->name('aplicant.detail');
    Route::get('/adm/berlangsung/{scholarship_id}/downloadExcel', [StudentScholarshipController::class, 'export'])->name('aplicant.downloadExcel');

    // Alumni beasiswa
    Route::get('/adm/alumni', [AlumniController::class, 'index'])->name('alumni.list');
    Route::get('/adm/alumni/{scholarship_id}', [AlumniController::class, 'showAlumniByScholarship'])->name('alumni.index');
    Route::get('/adm/alumni/{user_id}/{scholarship_id}/detail', [AlumniController::class, 'showDetail'])->name('alumni.detail');
    Route::get('/adm/alumni/{scholarship_id}/downloadExcel', [AlumniController::class, 'export'])->name('alumni.downloadExcel');

    // Beranda
    Route::get('/adm/beranda', [HomepageController::class, 'index']);

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
    Route::resource('/mhs/beasiswa', UserScholarshipController::class);
    Route::get('/mhs/beranda', [UserHomepageController::class, 'index']);
    Route::get('/mhs/biodata', [UserProfileController::class, 'index'])->name('biodata.index');
    Route::put('/mhs/biodata/update', [UserProfileController::class, 'update'])->name('biodata.update');
    Route::get('/mhs/logout', [UserAuthController::class, 'logout']);
});
