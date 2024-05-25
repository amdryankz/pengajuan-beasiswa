<?php

use App\Models\Admin;
use App\Models\Donor;
use App\Models\Scholarship;
use App\Models\ScholarshipData;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = Admin::factory()->create();
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
    $this->assertDatabaseHas('scholarships', [
        'id' => $scholarship->id
    ]);
});
