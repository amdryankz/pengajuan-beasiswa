<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Admin;
use App\Mail\FileValidated;
use App\Models\ScholarshipData;
use App\Models\UserScholarship;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\FileValidationCancelled;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->adminRole = Role::factory()->admin()->create();
    $this->viewerRole = Role::factory()->viewer()->create();

    $this->admin = Admin::factory()->create(['role_id' => $this->adminRole->id]);
    $this->viewer = Admin::factory()->create(['role_id' => $this->viewerRole->id]);
    Mail::fake();
});

it('it shows applicants for a specific scholarship', function () {
    $this->actingAs($this->admin, 'admin');
    $scholarship = ScholarshipData::factory()->hasUsers(5)->create();

    $response = $this->get("/adm/pengusul/{$scholarship->id}");

    $response->assertOk();
    $response->assertViewHas('data');
    $response->assertViewHas('data.scholarship', $scholarship);

    $data = $response->viewData('data');
    $users = $data['user'];
    $this->assertCount(5, $users);
});

it('shows details of a applicant for a specific scholarship', function () {
    $this->actingAs($this->admin, 'admin');
    $user = User::factory()->create();
    $scholarship = ScholarshipData::factory()->create();

    UserScholarship::factory()->create([
        'user_id' => $user->id,
        'scholarship_data_id' => $scholarship->id,
    ]);

    $response = $this->get("/adm/pengusul/{$user->id}/{$scholarship->id}/detail");

    $response->assertOk();
    $response->assertViewHas('user', $user);
    $response->assertViewHas('scholarship', $scholarship);
});

it('checks if a file exists and returns the file stream', function () {
    $this->actingAs($this->admin, 'admin');
    $filePath = 'example.pdf';
    $sourcePath = storage_path('app/tests/files/example.pdf');
    $publicPath = public_path('storage/file_requirements/' . $filePath);

    File::copy($sourcePath, $publicPath);

    $response = $this->get("/adm/pengusul/berkas/{$filePath}");

    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'application/pdf');
    $response->assertHeader('Content-Disposition', 'inline; filename="example"');

    File::delete($publicPath);
});

it('returns 404 if the file does not exist', function () {
    $this->actingAs($this->admin, 'admin');
    $response = $this->get('/adm/pengusul/berkas/nonexistent.pdf');

    $response->assertStatus(404);
    $response->assertSee('Not Found');
    $response->assertSee('404');
});

it('validates files applicant and sends an email notification', function () {
    $this->actingAs($this->admin, 'admin');
    $user = User::factory()->create();
    $scholarship = ScholarshipData::factory()->create();

    $userScholarships = UserScholarship::factory()->count(3)->create([
        'user_id' => $user->id,
        'scholarship_data_id' => $scholarship->id,
        'file_status' => false,
    ]);

    $response = $this->post("/adm/pengusul/validate/{$scholarship->id}/{$user->id}");

    $response->assertRedirect("/adm/pengusul/{$scholarship->id}");
    $response->assertSessionHas('success', 'Berkas telah divalidasi.');

    $userScholarships = UserScholarship::where('user_id', $user->id)
        ->where('scholarship_data_id', $scholarship->id)
        ->get();

    $this->assertTrue($userScholarships->pluck('file_status')->contains(true));

    Mail::assertSent(FileValidated::class, function ($mail) use ($user) {
        return $mail->hasTo($user->email);
    });
});

it('non-admin or non-operator user cannot validates files applicant', function () {
    $this->actingAs($this->viewer, 'admin');
    $user = User::factory()->create();
    $scholarship = ScholarshipData::factory()->create();

    $response = $this->post("/adm/pengusul/validate/{$scholarship->id}/{$user->id}");
    $response->assertStatus(403);
});

it('cancels validation files applicant and sends an email notification', function () {
    $this->actingAs($this->admin, 'admin');
    $user = User::factory()->create();
    $scholarship = ScholarshipData::factory()->create();

    $userScholarships = UserScholarship::factory()->count(3)->create([
        'user_id' => $user->id,
        'scholarship_data_id' => $scholarship->id,
        'file_status' => null,
    ]);

    $reason = 'Alasan pembatalan';

    $response = $this->post("/adm/pengusul/cancel-validation/{$scholarship->id}/{$user->id}", [
        'reason' => $reason,
    ]);

    $response->assertRedirect("/adm/pengusul/{$scholarship->id}");
    $response->assertSessionHas('success', 'Berkas batal divalidasi.');

    $userScholarships = UserScholarship::where('user_id', $user->id)
        ->where('scholarship_data_id', $scholarship->id)
        ->get();

    $this->assertTrue($userScholarships->pluck('file_status')->contains(false));

    Mail::assertSent(FileValidationCancelled::class, function ($mail) use ($user, $reason) {
        return $mail->hasTo($user->email) && $mail->reason === $reason;
    });
});

it('non-admin or non-operator user cannot cancels validation files applicant', function () {
    $this->actingAs($this->viewer, 'admin');
    $user = User::factory()->create();
    $scholarship = ScholarshipData::factory()->create();

    $response = $this->post("/adm/pengusul/cancel-validation/{$scholarship->id}/{$user->id}");
    $response->assertStatus(403);
});
