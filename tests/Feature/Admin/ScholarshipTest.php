<?php

use App\Models\Role;
use App\Models\Admin;
use App\Models\Donor;
use App\Models\Scholarship;
use App\Models\ScholarshipData;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->adminRole = Role::factory()->admin()->create();
    $this->operatorRole = Role::factory()->operator()->create();

    $this->admin = Admin::factory()->create(['role_id' => $this->adminRole->id]);
    $this->operator = Admin::factory()->create(['role_id' => $this->operatorRole->id]);
});

it('can access scholarships index with data', function () {
    $this->actingAs($this->admin, 'admin');
    Scholarship::factory(5)->create();

    $response = $this->get('/adm/beasiswa');
    $response->assertOk();
    $response->assertViewHas('data');
    $scholarships = $response->viewData('data');
    $this->assertCount(5, $scholarships);
});

it('can create a scholarship', function () {
    $this->actingAs($this->admin, 'admin');
    $donor = Donor::factory()->create();

    $response = $this->post('/adm/beasiswa', [
        'name' => 'Bank Indonesia',
        'donors_id' => $donor->id
    ]);
    $response->assertRedirect('/adm/beasiswa');
    $response->assertSessionHas('success', 'Berhasil menambahkan beasiswa');
    $this->assertDatabaseHas('scholarships', [
        'name' => 'Bank Indonesia',
    ]);
});

it('can update a scholarship', function () {
    $this->actingAs($this->admin, 'admin');
    $scholarship = Scholarship::factory()->create();
    $donor = Donor::factory()->create();

    $response = $this->put("/adm/beasiswa/{$scholarship->id}", [
        'name' => 'Djarum',
        'donors_id' => $donor->id
    ]);
    $response->assertRedirect('/adm/beasiswa');
    $response->assertSessionHas('success', 'Berhasil mengupdate beasiswa');
    $this->assertDatabaseHas('scholarships', [
        'id' => $scholarship->id,
        'name' => 'Djarum'
    ]);
});

it('can delete a scholarship', function () {
    $this->actingAs($this->admin, 'admin');
    $scholarship = Scholarship::factory()->create();

    $response = $this->delete("/adm/beasiswa/{$scholarship->id}");
    $response->assertRedirect('/adm/beasiswa');
    $response->assertSessionHas('success', 'Berhasil menghapus beasiswa');
    $this->assertDatabaseMissing('scholarships', [
        'id' => $scholarship->id
    ]);
});

it('cannot delete a scholarship with associated data', function () {
    $this->actingAs($this->admin, 'admin');
    $scholarship = Scholarship::factory()->create();
    ScholarshipData::factory()->create([
        'scholarships_id' => $scholarship->id,
    ]);

    $response = $this->delete("/adm/beasiswa/{$scholarship->id}");
    $response->assertRedirect();
    $response->assertSessionHas('error', 'Tidak dapat menghapus beasiswa ini karena masih terdapat data yang terkait.');
    $this->assertDatabaseHas('scholarships', [
        'id' => $scholarship->id
    ]);
});

it('non-admin user cannot access scholarship', function () {
    $this->actingAs($this->operator, 'admin');

    $response = $this->get('/adm/beasiswa');
    $response->assertStatus(403);
});
