<?php

use App\Models\Role;
use App\Models\Admin;
use App\Models\FileRequirement;
use App\Models\FileScholarshipData;
use App\Models\ScholarshipData;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->adminRole = Role::factory()->admin()->create();
    $this->operatorRole = Role::factory()->operator()->create();

    $this->admin = Admin::factory()->create(['role_id' => $this->adminRole->id]);
    $this->operator = Admin::factory()->create(['role_id' => $this->operatorRole->id]);
});

it('can access file requirements index with data', function () {
    $this->actingAs($this->admin, 'admin');
    FileRequirement::factory(5)->create();

    $response = $this->get('/adm/berkas');
    $response->assertOk();
    $response->assertViewHas('data');
    $files = $response->viewData('data');
    $this->assertCount(5, $files);
});

it('can create a file requirement', function () {
    $this->actingAs($this->admin, 'admin');

    $response = $this->post('/adm/berkas', [
        'name' => 'KTP'
    ]);
    $response->assertRedirect('/adm/berkas');
    $response->assertSessionHas('success', 'Berhasil menambahkan data');
    $this->assertDatabaseHas('file_requirements', [
        'name' => 'KTP'
    ]);
});

it('can update a file requirement', function () {
    $this->actingAs($this->admin, 'admin');
    $file = FileRequirement::factory()->create();

    $response = $this->put("/adm/berkas/{$file->id}", [
        'name' => 'KTM'
    ]);

    $response->assertRedirect('/adm/berkas');
    $response->assertSessionHas('success', 'Berhasil update berkas');
    $this->assertDatabaseHas('file_requirements', [
        'id' => $file->id,
        'name' => 'KTM'
    ]);
});

it('can delete a file requirement', function () {
    $this->actingAs($this->admin, 'admin');
    $file = FileRequirement::factory()->create();

    $response = $this->delete("/adm/berkas/{$file->id}");
    $response->assertRedirect('/adm/berkas');
    $response->assertSessionHas('success', 'Berhasil hapus berkas');
    $this->assertDatabaseMissing('file_requirements', [
        'id' => $file->id
    ]);
});

it('cannot delete a file requirement with associated scholarships', function () {
    $this->actingAs($this->admin, 'admin');
    $file = FileRequirement::factory()->create();
    $scholarshipData = ScholarshipData::factory()->create();
    FileScholarshipData::factory()->create([
        'file_requirement_id' => $file->id,
        'scholarship_data_id' => $scholarshipData
    ]);

    $response = $this->delete("/adm/berkas/{$file->id}");
    $response->assertRedirect();
    $this->assertDatabaseHas('file_requirements', [
        'id' => $file->id,
    ]);
});

it('non-admin user cannot access file requirement', function () {
    $this->actingAs($this->operator, 'admin');

    $response = $this->get('/adm/berkas');
    $response->assertStatus(403);
});
