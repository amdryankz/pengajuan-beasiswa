<?php

use App\Models\User;
use App\Models\Admin;
use App\Models\Scholarship;
use App\Models\ScholarshipData;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = Admin::factory()->create();
});

it('can access special scholarship data index with data', function () {
    $this->actingAs($this->admin, 'admin');
    ScholarshipData::factory()->create([
        'start_scholarship' => '2024-01-01',
        'end_scholarship' => '2025-01-01',
        'start_registration_at' => null,
    ]);

    $response = $this->get('/adm/pengelolaan-khusus');
    $response->assertOk();
    $response->assertViewHas('data');
    $scholarshipData = $response->viewData('data');
    $this->assertCount(1, $scholarshipData);
});

it('can create a special scholarship data', function () {
    $scholarship = Scholarship::factory()->create();
    User::factory()->create(['npm' => '2008107010041']);

    $filePath = storage_path('app/tests/files/nama-mhs.xlsx');

    $file = new UploadedFile($filePath, 'nama-mhs.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', null, true);

    $response = $this->actingAs($this->admin, 'admin')
        ->post('/adm/pengelolaan-khusus', [
            'scholarships_id' => $scholarship->id,
            'year' => 2024,
            'amount' => 10000000,
            'amount_period' => 'year',
            'duration' => 1,
            'start_scholarship' => '2024-01-01',
            'end_scholarship' => '2025-01-01',
            'student_list_file' => $file,
        ]);

    $response->assertRedirect('/adm/pengelolaan-khusus');
    $this->assertDatabaseHas('scholarship_data', [
        'scholarships_id' => $scholarship->id,
        'year' => 2024,
        'amount' => 10000000,
        'amount_period' => 'year',
        'duration' => 1,
        'start_scholarship' => '2024-01-01',
        'end_scholarship' => '2025-01-01',
    ]);
});

it('can update a special scholarship data', function () {
    $this->actingAs($this->admin, 'admin');
    $scholarshipData = ScholarshipData::factory()->create();
    $newScholarship = Scholarship::factory()->create();

    $response = $this->put("/adm/pengelolaan-khusus/{$scholarshipData->id}", [
        'scholarships_id' => $newScholarship->id,
        'year' => '2025',
        'amount' => 10000000,
        'amount_period' => 'year',
        'duration' => 1,
        'start_scholarship' => '2024-01-01',
        'end_scholarship' => '2025-01-01',
        'start_registration_at' => null
    ]);

    $response->assertRedirect('/adm/pengelolaan-khusus');
    $this->assertDatabaseHas('scholarship_data', [
        'year' => '2025',
        'amount' => 10000000,
        'amount_period' => 'year',
        'duration' => 1,
        'start_scholarship' => '2024-01-01',
        'end_scholarship' => '2025-01-01',
    ]);
});

it('can delete a special scholarship data', function () {
    $this->actingAs($this->admin, 'admin');
    $scholarshipData = ScholarshipData::factory()->make([
        'start_scholarship' => '2024-01-01',
        'end_scholarship' => '2025-01-01',
        'start_registration_at' => null,
    ]);

    $scholarshipData->save();

    $response = $this->delete("/adm/pengelolaan-khusus/{$scholarshipData->id}");
    $response->assertRedirect('/adm/pengelolaan-khusus');
    $this->assertDatabaseMissing('scholarship_data', [
        'id' => $scholarshipData->id
    ]);
});

it('can update SK file for a special scholarship data', function () {
    $this->actingAs($this->admin, 'admin');
    Storage::fake('public');

    $scholarship = ScholarshipData::factory()->create([
        'start_scholarship' => '2024-01-01',
        'end_scholarship' => '2025-01-01',
        'start_registration_at' => null,
    ]);
    $file = UploadedFile::fake()->create('sk_file.pdf', 1024);

    $response = $this->put("/adm/pengelolaan-khusus/sk/{$scholarship->id}", [
        'sk_number' => 'SK123',
        'sk_file' => $file,
    ]);

    $response->assertRedirect('/adm/pengelolaan-khusus');
    $this->assertDatabaseHas('scholarship_data', [
        'id' => $scholarship->id,
        'sk_number' => 'SK123',
    ]);

    $this->assertTrue(Storage::disk('public')->exists($scholarship->fresh()->sk_file));
});
