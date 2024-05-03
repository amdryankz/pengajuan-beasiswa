<?php

use App\Models\Admin;
use App\Models\File;
use function Pest\Laravel\get;
use function Pest\Laravel\put;
use function Pest\Laravel\post;
use function Pest\Laravel\delete;
use function Pest\Laravel\actingAs;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class);

it('can create a file', function () {
    $admin = Admin::factory()->create();
    actingAs($admin, 'admin');

    $response = post('/adm/berkas', ['name' => 'KTP']);

    $response->assertStatus(200)
        ->assertJson(['message' => 'created data successful']);

    $this->assertDatabaseHas('files', ['name' => 'KTP']);
});

it('can list all files', function () {
    $admin = Admin::factory()->create();
    actingAs($admin, 'admin');

    File::factory()->count(3)->create();

    $response = get('/adm/berkas');

    $response->assertStatus(200)
        ->assertJsonCount(3, 'files');
});

it('can update a file', function () {
    $admin = Admin::factory()->create();
    actingAs($admin, 'admin');

    $file = File::factory()->create();

    $response = put("/adm/berkas/{$file->id}", ['name' => 'KTP']);

    $response->assertStatus(200)
        ->assertJson(['message' => 'updated data successful']);

    $this->assertDatabaseHas('files', ['id' => $file->id, 'name' => 'KTP']);
});

it('can delete a file', function () {
    $admin = Admin::factory()->create();
    actingAs($admin, 'admin');

    $file = File::factory()->create();

    $response = delete("/adm/berkas/{$file->id}");

    $response->assertStatus(200)
        ->assertJson(['message' => 'deleted data successful']);

    $this->assertDatabaseMissing('files', ['id' => $file->id]);
});
