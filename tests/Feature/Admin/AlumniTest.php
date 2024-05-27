<?php

use App\Models\User;
use App\Models\Admin;
use App\Models\ScholarshipData;
use App\Models\UserScholarship;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = Admin::factory()->create();

    Storage::fake('public');
    Log::spy();
});

it('it shows alumni scholarships for a specific scholarship', function () {
    $this->actingAs($this->admin, 'admin');

    $activeScholarship = ScholarshipData::factory()->create([
        'end_scholarship' => now()->subDay(),
    ]);

    $inactiveScholarship = ScholarshipData::factory()->create([
        'end_scholarship' => now()->addDay(),
    ]);

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    UserScholarship::factory()->create([
        'user_id' => $user1->id,
        'scholarship_data_id' => $activeScholarship->id,
        'file_status' => true,
        'scholarship_status' => true,
    ]);

    UserScholarship::factory()->create([
        'user_id' => $user2->id,
        'scholarship_data_id' => $inactiveScholarship->id,
        'file_status' => true,
        'scholarship_status' => true,
    ]);

    $response = $this->get("/adm/alumni");

    $response->assertOk();
    $response->assertViewHas('scholarships');
    $scholarships = $response->viewData('scholarships');
    $this->assertCount(1, $scholarships);
    $this->assertTrue($scholarships->contains('id', $activeScholarship->id));
    $this->assertFalse($scholarships->contains('id', $inactiveScholarship->id));
});

it('shows details of an alumni for a specific scholarship', function () {
    $this->actingAs($this->admin, 'admin');
    $scholarship = ScholarshipData::factory()->create();
    $user = User::factory()->create();

    UserScholarship::factory()->create([
        'user_id' => $user->id,
        'scholarship_data_id' => $scholarship->id,
        'file_status' => true,
        'scholarship_status' => true,
    ]);

    $response = $this->get("/adm/alumni/{$user->id}/{$scholarship->id}/detail");

    $response->assertOk();
    $response->assertViewHas('user', $user);
    $response->assertViewHas('scholarship', $scholarship);
});

it('exports a list of alumni for a specific scholarship', function () {
    $this->actingAs($this->admin, 'admin');
    $user = User::factory()->create();
    $scholarship = ScholarshipData::factory()->create();

    UserScholarship::factory()->create([
        'user_id' => $user->id,
        'scholarship_data_id' => $scholarship->id,
        'file_status' => true,
        'scholarship_status' => true,
    ]);

    Excel::fake();
    $response = $this->get("/adm/alumni/{$scholarship->id}/downloadExcel");

    $response->assertStatus(200);
    Excel::assertDownloaded('Mahasiswa alumni ' . $scholarship->scholarship->name . ' ' . $scholarship->year . '.xlsx');
});

it('deletes expired files', function () {
    $this->scholarship = ScholarshipData::factory()->create();

    $this->userScholarship = UserScholarship::factory()->create([
        'scholarship_data_id' => $this->scholarship->id,
        'file_path' => 'expired_file.pdf',
        'supervisor_approval_file' => 'expired_approval.pdf',
    ]);

    Storage::disk('public')->put('file_requirements/expired_file.pdf', 'fake content');
    Storage::disk('public')->put('file_requirements/expired_approval.pdf', 'fake content');

    $this->scholarship->update(['end_scholarship' => now()->subDay()]);

    Artisan::call('files:delete-expired');

    $this->assertFalse(Storage::disk('public')->exists('file_requirements/expired_file.pdf'));
    $this->assertFalse(Storage::disk('public')->exists('file_requirements/expired_approval.pdf'));

    $this->assertNull($this->userScholarship->fresh()->file_path);
    $this->assertNull($this->userScholarship->fresh()->supervisor_approval_file);

    Log::shouldHaveReceived('info')->once()->with('Expired files deleted successfully.');
    $this->artisan('files:delete-expired')
        ->expectsOutput('Expired files deleted successfully.')
        ->assertExitCode(0);
});

it('does not delete files for non-expired scholarships', function () {
    $nonExpiredScholarship = ScholarshipData::factory()->create();
    $nonExpiredUserScholarship = UserScholarship::factory()->create([
        'scholarship_data_id' => $nonExpiredScholarship->id,
        'file_path' => 'non_expired_file.pdf',
        'supervisor_approval_file' => 'non_expired_approval.pdf',
    ]);

    Storage::disk('public')->put('file_requirements/non_expired_file.pdf', 'fake content');
    Storage::disk('public')->put('file_requirements/non_expired_approval.pdf', 'fake content');

    $nonExpiredScholarship->update(['end_scholarship' => now()->addDay()]);

    Artisan::call('files:delete-expired');

    $this->assertTrue(Storage::disk('public')->exists('file_requirements/non_expired_file.pdf'));
    $this->assertTrue(Storage::disk('public')->exists('file_requirements/non_expired_approval.pdf'));

    $this->assertNotNull($nonExpiredUserScholarship->fresh()->file_path);
    $this->assertNotNull($nonExpiredUserScholarship->fresh()->supervisor_approval_file);
});
