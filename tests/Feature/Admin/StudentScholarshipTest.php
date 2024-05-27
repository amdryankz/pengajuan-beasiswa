<?php

use App\Models\User;
use App\Models\Admin;
use App\Models\ScholarshipData;
use App\Models\UserScholarship;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = Admin::factory()->create();
});

it('shows applicants who have passed the scholarship for a specific scholarship', function () {
    $this->actingAs($this->admin, 'admin');

    $activeScholarship = ScholarshipData::factory()->create([
        'start_scholarship' => now()->subDay(),
        'end_scholarship' => now()->addDay(),
    ]);

    $inactiveScholarship = ScholarshipData::factory()->create([
        'start_scholarship' => now()->subDays(2),
        'end_scholarship' => now()->subDay(),
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

    $response = $this->get("/adm/berlangsung");

    $response->assertOk();
    $response->assertViewHas('scholarships');
    $scholarships = $response->viewData('scholarships');
    $this->assertCount(1, $scholarships);
    $this->assertTrue($scholarships->contains('id', $activeScholarship->id));
    $this->assertFalse($scholarships->contains('id', $inactiveScholarship->id));
});

it('shows details of a applicant for a specific scholarship', function () {
    $this->actingAs($this->admin, 'admin');
    $scholarship = ScholarshipData::factory()->create();
    $user = User::factory()->create();

    UserScholarship::factory()->create([
        'user_id' => $user->id,
        'scholarship_data_id' => $scholarship->id,
        'file_status' => true,
        'scholarship_status' => true,
    ]);

    $response = $this->get("/adm/berlangsung/{$user->id}/{$scholarship->id}/detail");

    $response->assertOk();
    $response->assertViewHas('user', $user);
    $response->assertViewHas('scholarship', $scholarship);
});

it('exports a list of students who passed the scholarship for a specific scholarship', function () {
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
    $response = $this->get("/adm/berlangsung/{$scholarship->id}/downloadExcel");

    $response->assertStatus(200);
    Excel::assertDownloaded('Mahasiswa ' . $scholarship->scholarship->name . ' ' . $scholarship->year . '.xlsx');
});
