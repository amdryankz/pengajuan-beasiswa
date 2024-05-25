<?php

use App\Models\Admin;
use App\Models\Scholarship;
use App\Models\FileRequirement;
use App\Models\ScholarshipData;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = Admin::factory()->create();
});


it('can access scholarship data index with data', function () {
    $this->actingAs($this->admin, 'admin');
    ScholarshipData::factory(5)->create();

    $response = $this->get('/adm/pengelolaan');
    $response->assertOk();
    $response->assertViewHas('data');
    $scholarshipData = $response->viewData('data');
    $this->assertCount(5, $scholarshipData);
});

it('can create a scholarship data', function () {
    $this->actingAs($this->admin, 'admin');
    $scholarship = Scholarship::factory()->create();
    $fileRequirement = FileRequirement::factory()->create();

    $data = [
        'scholarships_id' => $scholarship->id,
        'year' => 2023,
        'amount' => 1000,
        'amount_period' => 'month',
        'duration' => 12,
        'start_registration_at' => '2024-01-01',
        'end_registration_at' => '2024-01-31',
        'min_ipk' => 3.5,
        'quota' => [
            'fmipa' => 10,
            'feb' => 5,
            'fkep' => 3,
        ],
        'requirements' => [$fileRequirement->id],
    ];

    $response = $this->post('/adm/pengelolaan', $data);

    $response->assertRedirect('/adm/pengelolaan');
    $response->assertSessionHas('success', 'Berhasil menambahkan data beasiswa');

    $this->assertDatabaseHas('scholarship_data', [
        'scholarships_id' => $scholarship->id,
        'year' => '2023',
        'amount' => 1000,
        'amount_period' => 'month',
        'duration' => 12,
        'start_registration_at' => '2024-01-01',
        'end_registration_at' => '2024-01-31',
        'min_ipk' => 3.5,
    ]);

    $scholarshipData = ScholarshipData::first();
    $this->assertEquals($data['quota'], json_decode($scholarshipData->quota, true));

    $this->assertTrue($scholarshipData->requirements->contains($fileRequirement->id));
});

it('can update a scholarship data', function () {
    $this->actingAs($this->admin, 'admin');
    $scholarshipData = ScholarshipData::factory()->create();
    $fileRequirement = FileRequirement::factory()->create();

    $data = [
        'scholarships_id' => $scholarshipData->scholarships_id,
        'year' => 2023,
        'amount' => 1500,
        'amount_period' => 'year',
        'duration' => 24,
        'start_registration_at' => '2024-02-01',
        'end_registration_at' => '2024-02-28',
        'min_ipk' => 3.0,
        'quota' => [
            'fmipa' => 15,
            'feb' => 7,
            'fkep' => 4,
        ],
        'requirements' => [$fileRequirement->id],
    ];

    $response = $this->put("/adm/pengelolaan/{$scholarshipData->id}", $data);

    $response->assertRedirect('/adm/pengelolaan');
    $response->assertSessionHas('success', 'Berhasil mengupdate data beasiswa');

    $this->assertDatabaseHas('scholarship_data', [
        'id' => $scholarshipData->id,
        'amount' => 1500,
        'amount_period' => 'year',
        'duration' => 24,
    ]);

    $scholarshipData = ScholarshipData::first();
    $this->assertEquals($data['quota'], json_decode($scholarshipData->quota, true));

    $this->assertTrue($scholarshipData->requirements->contains($fileRequirement->id));
});

it('can delete a scholarship data', function () {
    $this->actingAs($this->admin, 'admin');
    $scholarshipData = ScholarshipData::factory()->create();

    $response = $this->delete("/adm/pengelolaan/{$scholarshipData->id}");
    $response->assertRedirect('/adm/pengelolaan');
    $response->assertSessionHas('success', 'Berhasil menghapus Data Beasiswa');

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
    $response->assertSessionHas('success', 'Berhasil mengupdate SK beasiswa');

    $this->assertDatabaseHas('scholarship_data', [
        'id' => $scholarship->id,
        'sk_number' => 'SK123',
    ]);

    $this->assertTrue(Storage::disk('public')->exists($scholarship->fresh()->sk_file));
});
