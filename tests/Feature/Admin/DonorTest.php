<?php

use App\Models\Role;
use App\Models\Admin;
use App\Models\Donor;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->adminRole = Role::factory()->admin()->create();
    $this->operatorRole = Role::factory()->operator()->create();

    $this->admin = Admin::factory()->create(['role_id' => $this->adminRole->id]);
    $this->operator = Admin::factory()->create(['role_id' => $this->operatorRole->id]);
});

it('can access donors index with data', function () {
    $this->actingAs($this->admin, 'admin');
    Donor::factory(5)->create();

    $response = $this->get('/adm/donatur');
    $response->assertOk();
    $response->assertViewHas('data');
    $donors = $response->viewData('data');
    $this->assertCount(5, $donors);
});

it('can create a donor', function () {
    $this->actingAs($this->admin, 'admin');

    $response = $this->post('/adm/donatur', [
        'name' => 'Bank Indonesia',
    ]);

    $response->assertRedirect('/adm/donatur');
    $response->assertSessionHas('success', 'Berhasil menambahkan data');
    $this->assertDatabaseHas('donors', [
        'name' => 'Bank Indonesia',
    ]);
});

it('can update a donor', function () {
    $this->actingAs($this->admin, 'admin');
    $donor = Donor::factory()->create();

    $response = $this->put("/adm/donatur/{$donor->id}", [
        'name' => 'Osaka Gas',
    ]);

    $response->assertRedirect('/adm/donatur');
    $response->assertSessionHas('success', 'Berhasil update donatur');
    $this->assertDatabaseHas('donors', [
        'id' => $donor->id,
        'name' => 'Osaka Gas',
    ]);
});

it('can delete a donor', function () {
    $this->actingAs($this->admin, 'admin');
    $donor = Donor::factory()->create();

    $response = $this->delete("/adm/donatur/{$donor->id}");
    $response->assertRedirect('/adm/donatur');
    $response->assertSessionHas('success', 'Berhasil menghapus Donatur');
    $this->assertDatabaseMissing('donors', [
        'id' => $donor->id,
    ]);
});

it('cannot delete a donor with associated scholarships', function () {
    $this->actingAs($this->admin, 'admin');
    $donor = Donor::factory()->create();
    $donor->scholarships()->create(['name' => 'Scholarship 1']);

    $response = $this->delete("/adm/donatur/{$donor->id}");
    $response->assertRedirect('/adm/donatur');
    $response->assertSessionHas('error', 'Tidak dapat menghapus donatur ini karena masih terdapat beasiswa yang terkait.');
    $this->assertDatabaseHas('donors', [
        'id' => $donor->id,
    ]);
});

it('non-admin user cannot access donor', function () {
    $this->actingAs($this->operator, 'admin');

    $response = $this->get('/adm/donatur');
    $response->assertStatus(403);
});
