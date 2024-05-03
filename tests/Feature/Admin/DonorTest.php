<?php

use App\Models\Admin;
use App\Models\Donor;
use function Pest\Laravel\post;
use function Pest\Laravel\get;
use function Pest\Laravel\put;
use function Pest\Laravel\delete;
use function Pest\Laravel\actingAs;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class);

it('can create a donor', function () {
    $admin = Admin::factory()->create();
    actingAs($admin, 'admin');

    $response = post('/adm/donatur', ['name' => 'BSI']);

    $response->assertStatus(200)
        ->assertJson(['message' => 'created data successful']);

    $this->assertDatabaseHas('donors', ['name' => 'BSI']);
});

it('can list all donors', function () {
    $admin = Admin::factory()->create();
    actingAs($admin, 'admin');

    Donor::factory()->count(3)->create();

    $response = get('/adm/donatur');

    $response->assertStatus(200)
        ->assertJsonCount(5, 'donors');
});

it('can update a donor', function () {
    $admin = Admin::factory()->create();
    actingAs($admin, 'admin');

    $donor = Donor::factory()->create();

    $response = put("/adm/donatur/{$donor->id}", ['name' => 'BSI']);

    $response->assertStatus(200)
        ->assertJson(['message' => 'updated data successful']);

    $this->assertDatabaseHas('donors', ['id' => $donor->id, 'name' => 'BSI']);
});

it('can delete a donor', function () {
    $admin = Admin::factory()->create();
    actingAs($admin, 'admin');

    $donor = Donor::factory()->create();

    $response = delete("/adm/donatur/{$donor->id}");

    $response->assertStatus(200)
        ->assertJson(['message' => 'deleted data successful']);

    $this->assertDatabaseMissing('donors', ['id' => $donor->id]);
});

it('cannot delete a donor with associated scholarships', function () {
    $admin = Admin::factory()->create();
    actingAs($admin, 'admin');

    $donor = Donor::factory()->create();
    $donor->scholarships()->create(['name' => 'Scholarship 1']);

    $response = delete("/adm/donatur/{$donor->id}");

    $response->assertStatus(401)
        ->assertJson(['message' => 'Cannot delete this donor because there is still an associated scholarship.']);

    $this->assertDatabaseHas('donors', ['id' => $donor->id]);
});
