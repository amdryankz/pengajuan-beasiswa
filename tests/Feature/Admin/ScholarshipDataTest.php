<?php

use App\Models\Admin;
use App\Models\Scholarship;
use App\Models\FileRequirement;
use App\Models\ScholarshipData;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class);

beforeEach(function () {
    $this->admin = Admin::factory()->create([
        'nip' => '12345',
        'password' => bcrypt('password'),
        'status' => 'Aktif'
    ]);
});

it('can access scholarship data index with data', function () {
    $this->actingAs($this->admin, 'admin');
    ScholarshipData::factory(5)->create();

    $response = $this->get('/adm/pengelolaan');
    $response->assertOk();
    $response->assertViewHas('data');
    $scholarshipData = $response->viewData('data');
    $this->assertCount(6, $scholarshipData);
});

it('can create a scholarship data', function () {
    $this->actingAs($this->admin, 'admin');
    $scholarship = Scholarship::factory()->create();
    $fileRequirement = FileRequirement::factory()->create();

    $response = $this->post('/adm/pengelolaan', [
        'scholarships_id' => $scholarship->id,
        'year' => '2025',
        'amount' => 10000000,
        'amount_period' => 'year',
        'duration' => 1,
        'start_registration_at' => '2024-01-01',
        'end_registration_at' => '2024-01-31',
        'min_ipk' => 3.0,
        'quota' => [10, 20, 30],
        'requirements' => [$fileRequirement->id],
    ]);
    $response->assertRedirect('/adm/pengelolaan');
    $this->assertDatabaseHas('scholarship_data', [
        'year' => '2025',
        'amount' => 10000000,
        'amount_period' => 'year',
        'duration' => 1,
        'start_registration_at' => '2024-01-01',
        'end_registration_at' => '2024-01-31',
        'min_ipk' => 3.0,
        'quota' => json_encode([10, 20, 30]),
    ]);
    $scholarshipData = ScholarshipData::where('year', '2025')->first();
    $this->assertTrue($scholarshipData->requirements->contains($fileRequirement->id));
});

it('can update a scholarship data', function () {
    $this->actingAs($this->admin, 'admin');
    $scholarshipData = ScholarshipData::factory()->create();
    $newScholarship = Scholarship::factory()->create();
    $newFileRequirement = FileRequirement::factory()->create();

    $response = $this->put("/adm/pengelolaan/{$scholarshipData->id}", [
        'scholarships_id' => $newScholarship->id,
        'year' => '2025',
        'amount' => 10000000,
        'amount_period' => 'year',
        'duration' => 1,
        'start_registration_at' => '2024-01-01',
        'end_registration_at' => '2024-01-31',
        'min_ipk' => 3.0,
        'quota' => [10, 20, 30],
        'requirements' => [$newFileRequirement->id],
    ]);
    $response->assertRedirect('/adm/pengelolaan');
    $this->assertDatabaseHas('scholarship_data', [
        'year' => '2025',
        'amount' => 10000000,
        'amount_period' => 'year',
        'duration' => 1,
        'start_registration_at' => '2024-01-01',
        'end_registration_at' => '2024-01-31',
        'min_ipk' => 3.0,
        'quota' => json_encode([10, 20, 30]),
    ]);
    $scholarshipData = ScholarshipData::where('year', '2025')->first();
    $this->assertTrue($scholarshipData->requirements->contains($newFileRequirement->id));
});

it('can delete a scholarship data', function () {
    $this->actingAs($this->admin, 'admin');
    $scholarshipData = ScholarshipData::factory()->create();

    $response = $this->delete("/adm/pengelolaan/{$scholarshipData->id}");
    $response->assertRedirect('/adm/pengelolaan');
    $this->assertDatabaseMissing('scholarship_data', [
        'id' => $scholarshipData->id
    ]);
});

it('can update SK file for a scholarship data', function () {
    $this->actingAs($this->admin, 'admin');
    Storage::fake('public');

    $scholarship = ScholarshipData::factory()->create();
    $file = UploadedFile::fake()->create('sk_file.pdf', 1024);

    $response = $this->put("/adm/pengelolaan/sk/{$scholarship->id}", [
        'sk_number' => 'SK123',
        'start_scholarship' => '2024-01-01',
        'end_scholarship' => '2025-01-01',
        'sk_file' => $file,
    ]);

    $response->assertRedirect('/adm/pengelolaan');
    $this->assertDatabaseHas('scholarship_data', [
        'id' => $scholarship->id,
        'sk_number' => 'SK123',
    ]);

    $this->assertTrue(Storage::disk('public')->exists($scholarship->fresh()->sk_file));
});
