<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DonorController;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\Admin\AdminAccessController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\ScholarshipController;
use App\Http\Controllers\User\UserHomepageController;
use App\Http\Controllers\User\UserScholarshipController;
use App\Http\Controllers\Admin\FileRequirementController;
use App\Http\Controllers\Admin\ScholarshipDataController;
use App\Http\Controllers\Admin\StudentApprovalController;
use App\Http\Controllers\Admin\StudentApplicationController;
use App\Http\Controllers\Admin\StudentScholarshipController;
use App\Http\Controllers\Admin\SpecialScholarshipDataController;
use App\Http\Controllers\Main\LandingPageController;

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

Route::middleware('auth:admin')->prefix('adm')->group(function () {
    // Donatur
    Route::resource('donatur', DonorController::class)->middleware('check.admin.role');

    // Berkas
    Route::resource('berkas', FileRequirementController::class)->middleware('check.admin.role');

    // Beasiswa
    Route::resource('beasiswa', ScholarshipController::class)->middleware('check.admin.role');

    // Pengelolaan
    Route::resource('pengelolaan', ScholarshipDataController::class)->middleware('check.admin.role');
    Route::put('pengelolaan/sk/{id}', [ScholarshipDataController::class, 'updateSK'])->name('beasiswa.updateSK')->middleware('check.admin.role');

    // Beasiswa khusus
    Route::resource('pengelolaan-khusus', SpecialScholarshipDataController::class)->middleware('check.admin.role');
    Route::put('pengelolaan-khusus/sk/{id}', [SpecialScholarshipDataController::class, 'updateSK'])->name('khusus.updateSK')->middleware('check.admin.role');

    // Pendaftar Beasiswa
    Route::prefix('pengusul')->group(function () {
        Route::get('', [StudentApplicationController::class, 'showScholarships'])->name('registrations.list');
        Route::get('{scholarship_id}', [StudentApplicationController::class, 'showRegistrationsByScholarship'])->name('registrations.index');
        Route::get('{user_id}/{scholarship_id}/detail', [StudentApplicationController::class, 'showDetail'])->name('admin.scholarship.detail');
        Route::get('{user_id}/{scholarship_id}/pdf', [StudentApplicationController::class, 'generatePDF'])->name('admin.scholarship.pdf');
        Route::get('download/{file_path}', [StudentApplicationController::class, 'checkFile'])->name('admin.scholarship.checkFile');
        Route::post('validate/{scholarship_id}/{user_id}', [StudentApplicationController::class, 'validateFile'])->name('admin.scholarship.validate');
        Route::post('cancel-validation/{scholarship_id}/{user_id}', [StudentApplicationController::class, 'cancelValidation'])->name('admin.scholarship.cancelValidation');
    });

    // Akses login admin
    Route::resource('akses', AdminAccessController::class)->middleware('check.admin.role');

    // Kelulusan beasiswa
    Route::prefix('kelulusan')->group(function () {
        Route::get('', [StudentApprovalController::class, 'index'])->name('passfile.list');
        Route::get('{scholarship_id}', [StudentApprovalController::class, 'showPassFileByScholarship'])->name('passfile.index');
        Route::get('{user_id}/{scholarship_id}/detail', [StudentApprovalController::class, 'showDetail'])->name('passfile.detail');
        Route::post('pass/{scholarship_id}/{user_id}', [StudentApprovalController::class, 'validateScholar'])->name('passfile.validate');
        Route::post('cancel-pass/{scholarship_id}/{user_id}', [StudentApprovalController::class, 'cancelValidation'])->name('passfile.cancelValidate');
        Route::get('{scholarship_id}/downloadExcel', [StudentApprovalController::class, 'export'])->name('passfile.downloadExcel');
    });

    // Beasiswa berlangsung
    Route::prefix('berlangsung')->group(function () {
        Route::get('', [StudentScholarshipController::class, 'index'])->name('aplicant.list');
        Route::get('{scholarship_id}', [StudentScholarshipController::class, 'showAplicantByScholarship'])->name('aplicant.index');
        Route::get('{user_id}/{scholarship_id}/detail', [StudentScholarshipController::class, 'showDetail'])->name('aplicant.detail');
        Route::get('{scholarship_id}/downloadExcel', [StudentScholarshipController::class, 'export'])->name('aplicant.downloadExcel');
    });

    // Alumni beasiswa
    Route::prefix('alumni')->group(function () {
        Route::get('', [AlumniController::class, 'index'])->name('alumni.list');
        Route::get('{scholarship_id}', [AlumniController::class, 'showAlumniByScholarship'])->name('alumni.index');
        Route::get('{user_id}/{scholarship_id}/detail', [AlumniController::class, 'showDetail'])->name('alumni.detail');
        Route::get('{scholarship_id}/downloadExcel', [AlumniController::class, 'export'])->name('alumni.downloadExcel');
    });

    // Pengumuman
    Route::resource('pengumuman', AnnouncementController::class)->middleware('check.admin.role');

    // Beranda
    Route::get('beranda', [HomepageController::class, 'index']);

    // Logout admin
    Route::get('logout', [AdminAuthController::class, 'logout']);
});


// Rute Admin Authentication
Route::middleware('guest:admin')->prefix('adm')->group(function () {
    Route::get('/', [AdminAuthController::class, 'login'])->name('login');
    Route::post('/', [AdminAuthController::class, 'authenticating']);
});

// Rute User Authentication
Route::middleware('guest_user')->prefix('login')->group(function () {
    Route::get('/', [UserAuthController::class, 'login'])->name('loginUser');
    Route::post('/', [UserAuthController::class, 'authenticating']);
});

Route::middleware('auth_user')->prefix('mhs')->group(function () {
    // Daftar beasiswa
    Route::resource('pendaftaran', UserScholarshipController::class);
    Route::get('beranda', [UserHomepageController::class, 'index']);
    Route::get('biodata', [UserProfileController::class, 'index'])->name('biodata.index');
    Route::put('biodata/update', [UserProfileController::class, 'update'])->name('biodata.update');
    Route::get('logout', [UserAuthController::class, 'logout']);
});

Route::get('/', [LandingPageController::class, 'index']);
Route::get('/{id}', [LandingPageController::class, 'show']);
