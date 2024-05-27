<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Admin;
use App\Models\ScholarshipData;
use App\Models\UserScholarship;
use App\Mail\ScholarshipValidated;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\ScholarshipValidationCancelled;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->adminRole = Role::factory()->admin()->create();
    $this->viewerRole = Role::factory()->viewer()->create();

    $this->admin = Admin::factory()->create(['role_id' => $this->adminRole->id]);
    $this->viewer = Admin::factory()->create(['role_id' => $this->viewerRole->id]);
    Mail::fake();
});

it('shows applicants who have passed the file for a specific scholarship', function () {
    $this->actingAs($this->admin, 'admin');
    $scholarship = ScholarshipData::factory()->create();
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    UserScholarship::factory()->create([
        'user_id' => $user1->id,
        'scholarship_data_id' => $scholarship->id,
        'file_status' => true,
    ]);

    UserScholarship::factory()->create([
        'user_id' => $user2->id,
        'scholarship_data_id' => $scholarship->id,
        'file_status' => false,
    ]);

    $response = $this->get("/adm/kelulusan/{$scholarship->id}");

    $response->assertOk();
    $response->assertViewHas('data');
    $response->assertViewHas('scholarship', $scholarship);

    $data = $response->viewData('data');
    $this->assertCount(1, $data);

    $user = $data[0]['user'];
    $this->assertEquals($user1->id, $user->id);
});

it('shows details of a applicant for a specific scholarship', function () {
    $this->actingAs($this->admin, 'admin');
    $scholarship = ScholarshipData::factory()->create();
    $user = User::factory()->create();

    UserScholarship::factory()->create([
        'user_id' => $user->id,
        'scholarship_data_id' => $scholarship->id,
        'file_status' => true,
    ]);

    $response = $this->get("/adm/kelulusan/{$user->id}/{$scholarship->id}/detail");

    $response->assertOk();
    $response->assertViewHas('user', $user);
    $response->assertViewHas('scholarship', $scholarship);
});

it('validates scholarship for an aplicant and sends an email notification', function () {
    $this->actingAs($this->admin, 'admin');
    $scholarship = ScholarshipData::factory()->create();
    $user = User::factory()->create();

    $userScholarships = UserScholarship::factory()->create([
        'user_id' => $user->id,
        'scholarship_data_id' => $scholarship->id,
        'file_status' => true,
        'scholarship_status' => false,
    ]);

    $response = $this->post("/adm/kelulusan/pass/{$scholarship->id}/{$user->id}");

    $response->assertRedirect("/adm/kelulusan/{$scholarship->id}");
    $response->assertSessionHas('success', 'Mahasiswa lulus beasiswa.');

    $userScholarships = UserScholarship::where('user_id', $user->id)
        ->where('scholarship_data_id', $scholarship->id)
        ->get();

    $this->assertTrue($userScholarships->pluck('scholarship_status')->contains(true));

    Mail::assertSent(ScholarshipValidated::class, function ($mail) use ($user) {
        return $mail->hasTo($user->email);
    });
});

it('shows an error message when the quota for a faculty is already fulfilled', function () {
    $this->actingAs($this->admin, 'admin');

    $faculty = 'Faculty A';
    $quota = 2;
    $scholarship = ScholarshipData::factory()->create(['quota' => json_encode([$faculty => $quota])]);

    $users = User::factory()->count(2)->create(['faculty' => $faculty]);
    foreach ($users as $user) {
        UserScholarship::factory()->create([
            'user_id' => $user->id,
            'scholarship_data_id' => $scholarship->id,
            'file_status' => true,
            'scholarship_status' => true,
        ]);
    }

    $user = User::factory()->create(['faculty' => $faculty]);
    $response = $this->post("/adm/kelulusan/pass/{$scholarship->id}/{$user->id}");

    $response->assertRedirect();
    $response->assertSessionHas('error', 'Kuota untuk fakultas ' . $faculty . ' sudah terpenuhi.');
});

it('non-admin or non-operator user cannot validates scholarship applicant', function () {
    $this->actingAs($this->viewer, 'admin');
    $user = User::factory()->create();
    $scholarship = ScholarshipData::factory()->create();

    $response = $this->post("/adm/kelulusan/pass/{$scholarship->id}/{$user->id}");
    $response->assertStatus(403);
});

it('cancels validation scholarship for an aplicant', function () {
    $this->actingAs($this->admin, 'admin');
    $user = User::factory()->create();
    $scholarship = ScholarshipData::factory()->create();

    $userScholarships = UserScholarship::factory()->create([
        'user_id' => $user->id,
        'scholarship_data_id' => $scholarship->id,
        'file_status' => true,
        'scholarship_status' => null,
    ]);

    $response = $this->post("/adm/kelulusan/cancel-pass/{$scholarship->id}/{$user->id}");

    $response->assertRedirect("/adm/kelulusan/{$scholarship->id}");
    $response->assertSessionHas('success', 'Mahasiswa tidak lulus beasiswa.');

    $userScholarships = UserScholarship::where('user_id', $user->id)
        ->where('scholarship_data_id', $scholarship->id)
        ->get();

    $this->assertTrue($userScholarships->pluck('scholarship_status')->contains(false));

    Mail::assertSent(ScholarshipValidationCancelled::class, function ($mail) use ($user) {
        return $mail->hasTo($user->email);
    });
});

it('non-admin or non-operator user cannot cancels validates scholarship applicant', function () {
    $this->actingAs($this->viewer, 'admin');
    $user = User::factory()->create();
    $scholarship = ScholarshipData::factory()->create();

    $response = $this->post("/adm/kelulusan/cancel-pass/{$scholarship->id}/{$user->id}");
    $response->assertStatus(403);
});

it('exports a list of students who passed the file for a specific scholarship', function () {
    $this->actingAs($this->admin, 'admin');
    $user = User::factory()->create();
    $scholarship = ScholarshipData::factory()->create();

    UserScholarship::factory()->create([
        'user_id' => $user->id,
        'scholarship_data_id' => $scholarship->id,
        'file_status' => true,
    ]);

    Excel::fake();
    $response = $this->get("/adm/kelulusan/{$scholarship->id}/downloadExcel");

    $response->assertStatus(200);
    Excel::assertDownloaded('Mahasiswa lulus berkas ' . $scholarship->scholarship->name . ' ' . $scholarship->year . '.xlsx');
});
