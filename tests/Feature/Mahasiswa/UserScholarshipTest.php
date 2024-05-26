<?php

use App\Models\User;
use App\Models\FileRequirement;
use App\Models\ScholarshipData;
use App\Models\UserScholarship;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->scholarship = ScholarshipData::factory()->create();
    $this->fileRequirement = FileRequirement::factory()->create();
    $this->userScholarship = UserScholarship::factory()->create();

    Storage::fake('public');
    Http::fake([
        'https://api.hunter.io/v2/email-verifier*' => Http::response([
            'data' => ['result' => 'deliverable'],
        ], 200),
    ]);
});

it('can apply for a scholarship', function () {
    $response = $this->actingAs($this->user)->post(route('pendaftaran.store'), [
        'scholarship_data_id' => $this->scholarship->id,
        'supervisor_approval_file' => UploadedFile::fake()->create('approval.pdf'),
        'file_requirements' => [
            $this->fileRequirement->id => UploadedFile::fake()->create('requirement1.pdf'),
        ],
    ]);

    $response->assertRedirect(route('pendaftaran.index'));
    $response->assertSessionHas('success', 'Pendaftaran berhasil.');

    Storage::disk('public')->exists('file_requirements/' . $this->user->npm . '_Izin Dosen Wali.pdf');
    Storage::disk('public')->exists('file_requirements/' . $this->user->npm . '_' . $this->fileRequirement->name . '.pdf');

    $this->assertDatabaseHas('user_scholarships', [
        'user_id' => $this->user->id,
        'scholarship_data_id' => $this->scholarship->id,
        'file_requirement_id' => $this->fileRequirement->id,
        'file_path' => $this->user->npm . '_' . $this->fileRequirement->name . '.pdf',
        'supervisor_approval_file' => $this->user->npm . '_Izin Dosen Wali.pdf'
    ]);
});

it('validates file uploads', function () {
    $response = $this->actingAs($this->user)->post(route('pendaftaran.store'), [
        'scholarship_data_id' => $this->scholarship->id,
        'supervisor_approval_file' => UploadedFile::fake()->create('approval.pdf', 2049),
        'file_requirements' => [
            $this->fileRequirement->id => UploadedFile::fake()->create('requirement1.pdf', 2049),
        ],
    ]);

    $response->assertSessionHasErrors(['file_requirements.' . $this->fileRequirement->id, 'supervisor_approval_file']);
});

it('checks IPK requirement', function () {
    $user = User::factory()->create(['ipk' => 2.5]);
    $scholarship = ScholarshipData::factory()->create(['min_ipk' => 3.0]);

    $response = $this->actingAs($user)->post(route('pendaftaran.store'), [
        'scholarship_data_id' => $scholarship->id,
        'supervisor_approval_file' => UploadedFile::fake()->create('approval.pdf'),
        'file_requirements' => [
            $this->fileRequirement->id => UploadedFile::fake()->create('requirement1.pdf'),
        ],
    ]);

    $response->assertRedirect(route('pendaftaran.index'));
    $response->assertSessionHas('error', 'IPK Anda tidak memenuhi syarat untuk mendaftar beasiswa ini.');
});

it('checks if user biodata is complete', function () {
    $user = User::factory()->create([
        'phone_number' => null,
        'bank_account_number' => null,
    ]);

    $response = $this->actingAs($user)->post(route('pendaftaran.store'), [
        'scholarship_data_id' => $this->scholarship->id,
        'supervisor_approval_file' => UploadedFile::fake()->create('approval.pdf'),
        'file_requirements' => [
            $this->fileRequirement->id => UploadedFile::fake()->create('requirement1.pdf'),
        ],
    ]);

    $response->assertRedirect(route('pendaftaran.index'));
    $response->assertSessionHas('error', 'Lengkapi biodata Anda terlebih dahulu.');
});

it('verifies email using external service', function () {
    $user = User::factory()->create(['email' => 'wrongemail@gmail.com']);

    Http::fake([
        'https://api.hunter.io/v2/email-verifier*' => Http::response([
            'data' => ['result' => 'undeliverable'],
        ], 200),
    ]);

    $response = $this->actingAs($user)->post(route('pendaftaran.store'), [
        'scholarship_data_id' => $this->scholarship->id,
        'supervisor_approval_file' => UploadedFile::fake()->create('approval.pdf'),
        'file_requirements' => [
            $this->fileRequirement->id => UploadedFile::fake()->create('requirement1.pdf'),
        ],
    ]);

    $response->assertRedirect(route('pendaftaran.index'));
    $response->assertSessionHas('error', 'Alamat email Anda tidak valid atau tidak dapat ditemukan.');
});

it('checks if user already registered for the scholarship', function () {
    UserScholarship::factory()->create([
        'user_id' => $this->user->id,
        'scholarship_data_id' => $this->scholarship->id,
    ]);

    $response = $this->actingAs($this->user)->post(route('pendaftaran.store'), [
        'scholarship_data_id' => $this->scholarship->id,
        'supervisor_approval_file' => UploadedFile::fake()->create('approval.pdf'),
        'file_requirements' => [
            $this->fileRequirement->id => UploadedFile::fake()->create('requirement1.pdf'),
        ],
    ]);

    $response->assertRedirect(route('pendaftaran.index'));
    $response->assertSessionHas('error', 'Anda sudah mendaftar untuk beasiswa ini.');
});

it('checks if user has an active scholarship', function () {
    $scholarship = ScholarshipData::factory()->create(['end_scholarship' => now()->addMonth()]);
    UserScholarship::factory()->create([
        'user_id' => $this->user->id,
        'scholarship_data_id' => $scholarship->id,
        'scholarship_status' => true,
    ]);

    $newScholarship = ScholarshipData::factory()->create();

    $response = $this->actingAs($this->user)->post(route('pendaftaran.store'), [
        'scholarship_data_id' => $newScholarship->id,
        'supervisor_approval_file' => UploadedFile::fake()->create('approval.pdf'),
        'file_requirements' => [
            $this->fileRequirement->id => UploadedFile::fake()->create('requirement1.pdf'),
        ],
    ]);

    $response->assertRedirect(route('pendaftaran.index'));
    $response->assertSessionHas('error', 'Anda sudah memiliki beasiswa aktif.');
});

it('cancels the registration successfully', function () {
    $response = $this->actingAs($this->user)->delete(route('pendaftaran.destroy', $this->userScholarship->id));

    $response->assertRedirect(route('pendaftaran.index'));
    $response->assertSessionHas('success', 'Pendaftaran berhasil dibatalkan.');

    $this->assertFalse(Storage::disk('public')->exists('file_requirements/' . $this->user->npm . '_requirement1.pdf'));
    $this->assertFalse(Storage::disk('public')->exists('file_requirements/' . $this->user->npm . '_Izin Dosen Wali.pdf'));

    $this->assertDatabaseMissing('user_scholarships', [
        'user_id' => $this->user->id,
        'scholarship_data_id' => $this->scholarship->id,
    ]);
});

it('does not cancel the registration if file status is set', function () {
    $this->userScholarship->update(['file_status' => true]);

    $response = $this->actingAs($this->user)->delete(route('pendaftaran.destroy', $this->userScholarship->id));

    $response->assertRedirect(route('pendaftaran.index'));
    $response->assertSessionHas('error', 'Anda tidak dapat membatalkan pendaftaran karena status berkas sudah diatur.');

    $this->assertDatabaseHas('user_scholarships', [
        'id' => $this->userScholarship->id,
    ]);
});
