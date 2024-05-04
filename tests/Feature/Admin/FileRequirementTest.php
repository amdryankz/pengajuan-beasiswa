<?php

use App\Models\Admin;
use App\Models\FileRequirement;
use App\Models\FileScholarshipData;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class);

beforeEach(function () {
    $this->admin = Admin::factory()->create([
        'nip' => '12345',
        'password' => bcrypt('password'),
        'status' => 'Aktif'
    ]);
});

it('can access file requirements index with data', function () {
    $this->actingAs($this->admin, 'admin');
    FileRequirement::factory(5)->create();

    $response = $this->get('/adm/berkas');
    $response->assertOk();
    $response->assertViewHas('data');
    $file = $response->viewData('data');
    $this->assertCount(10, $file);
});

it('can create a file requirement', function () {
    $this->actingAs($this->admin, 'admin');

    $response = $this->post('/adm/berkas', [
        'name' => 'KTP'
    ]);
    $response->assertRedirect('/adm/berkas');
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
    $this->assertDatabaseMissing('file_requirements', [
        'id' => $file->id
    ]);
});

// it('cannot delete a file requirement if scholarships are associated', function () {
//     $this->actingAs($this->admin, 'admin');
//     $file = FileRequirement::factory()->create();
//     FileScholarshipData::factory()->create(['file_requirement_id' => $file->id]);

//     $response = $this->delete("/adm/berkas/{$file->id}");
//     $response->assertRedirect();
//     $response->assertSessionHasErrors('error');
//     $this->assertDatabaseHas('file_requirements', [
//         'id' => $file->id
//     ]);
// });
