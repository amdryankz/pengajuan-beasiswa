<?php

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->adminRole = Role::factory()->admin()->create();
    $this->operatorRole = Role::factory()->operator()->create();

    $this->admin = Admin::factory()->create(['role_id' => $this->adminRole->id]);
    $this->operator = Admin::factory()->create(['role_id' => $this->operatorRole->id]);
});

it('can access manage admin access index with data', function () {
    $this->actingAs($this->admin, 'admin');
    Admin::factory(5)->create();

    $response = $this->get('/adm/akses');
    $response->assertOk();
    $response->assertViewHas('data');
    $users = $response->viewData('data');
    $this->assertCount(7, $users);
});

it('can create an admin access', function () {
    $this->actingAs($this->admin, 'admin');

    $response = $this->post('/adm/akses', [
        'nip' => '12345',
        'name' => 'John Doe',
        'password' => 'password',
        'role_id' => 1,
    ]);
    $response->assertRedirect('/adm/akses');
    $this->assertDatabaseHas('admins', [
        'nip' => '12345',
        'name' => 'John Doe',
        'role_id' => 1,
    ]);
});

it('can update an admin access', function () {
    $this->actingAs($this->admin, 'admin');
    $user = Admin::factory()->create();

    $response = $this->put("/adm/akses/{$user->id}", [
        'nip' => '54321',
        'name' => 'Jane Doe',
        'role_id' => 2,
        'status' => 'Aktif',
    ]);
    $response->assertRedirect('/adm/akses');
    $this->assertDatabaseHas('admins', [
        'id' => $user->id,
        'nip' => '54321',
        'name' => 'Jane Doe',
        'role_id' => 2,
        'status' => 'Aktif',
    ]);
});

it('can delete an admin access', function () {
    $this->actingAs($this->admin, 'admin');
    $user = Admin::factory()->create();

    $response = $this->delete("/adm/akses/{$user->id}");
    $response->assertRedirect('/adm/akses');
    $this->assertDatabaseMissing('admins', [
        'id' => $user->id
    ]);
});

it('non-admin user cannot access manage admin access', function () {
    $this->actingAs($this->operator, 'admin');

    $response = $this->get('/adm/akses');
    $response->assertStatus(403);
});
