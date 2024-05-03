<?php

use App\Models\Admin;
use App\Models\Donor;

use App\Models\Scholarship;
use function Pest\Laravel\get;
use function Pest\Laravel\put;
use function Pest\Laravel\post;
use function Pest\Laravel\delete;
use function Pest\Laravel\actingAs;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class);

it('can create a scholarship', function () {
    $admin = Admin::factory()->create();
    actingAs($admin, 'admin');

    $donor = Donor::factory()->create();

    $response = post('/adm/beasiswa', [
        'name' => 'Djarum',
        'donors_id' => $donor->id
    ]);

    $response->assertStatus(200)
        ->assertJson(['message' => 'created data successful']);

    $this->assertDatabaseHas('scholarships', ['name' => 'Djarum']);
});

it('can list all scholarships', function () {
    $admin = Admin::factory()->create();
    actingAs($admin, 'admin');

    Scholarship::factory()->count(3)->create();

    $response = get('/adm/beasiswa');

    $response->assertStatus(200)
        ->assertJsonCount(5, 'scholarships');
});

it('can update a scholarship', function () {
    $admin = Admin::factory()->create();
    actingAs($admin, 'admin');

    $scholarship = Scholarship::factory()->create();
    $donor = Donor::factory()->create();

    $response = put("/adm/beasiswa/{$scholarship->id}", [
        'name' => 'Djarum',
        'donors_id' => $donor->id
    ]);

    $response->assertStatus(200)
        ->assertJson(['message' => 'updated data successful']);

    $this->assertDatabaseHas('scholarships', ['id' => $scholarship->id, 'name' => 'Djarum']);
});

it('can delete a scholarship', function () {
    $admin = Admin::factory()->create();
    actingAs($admin, 'admin');

    $scholarship = Scholarship::factory()->create();

    $response = delete("/adm/beasiswa/{$scholarship->id}");

    $response->assertStatus(200)
        ->assertJson(['message' => 'deleted data successful']);

    $this->assertDatabaseMissing('scholarships', ['id' => $scholarship->id]);
});
