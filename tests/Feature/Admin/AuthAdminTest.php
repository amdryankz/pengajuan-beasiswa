<?php

use App\Models\Admin;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use function Pest\Laravel\post;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertGuest;

uses(DatabaseTransactions::class);

it('can authenticate with valid credentials and user active', function () {
    $admin = Admin::factory()->create([
        'status' => 'active',
        'role' => 'admin',
    ]);

    post('/adm/login', [
        'nip' => $admin->nip,
        'password' => 'password',
    ]);

    assertAuthenticated('admin');
});

it('cannot authenticate if user is not active', function () {
    $admin = Admin::factory()->create([
        'status' => 'inactive',
        'role' => 'admin',
    ]);

    post('/adm/login', [
        'nip' => $admin->nip,
        'password' => 'password',
    ]);

    assertGuest('admin');
});

it('cannot authenticate with invalid credentials', function () {
    $admin = Admin::factory()->create([
        'status' => 'active',
        'role' => 'admin',
    ]);

    post('/adm/login', [
        'nip' => $admin->nip,
        'password' => 'password123',
    ]);

    assertGuest('admin');
});
