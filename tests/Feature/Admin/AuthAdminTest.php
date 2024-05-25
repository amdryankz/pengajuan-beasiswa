<?php

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can authenticate admin with valid credentials', function () {
    $password = 'password';
    $admin = Admin::factory()->create([
        'nip' => '12345',
        'password' => bcrypt($password),
        'status' => 'Aktif',
    ]);

    $response = $this->post('/adm', [
        'nip' => $admin->nip,
        'password' => $password,
    ]);

    $response->assertRedirect('/adm/beranda');
    $this->assertAuthenticatedAs($admin, 'admin');
});

it('cannot authenticate admin with invalid credentials', function () {
    $admin = Admin::factory()->create([
        'nip' => '12345',
        'password' => bcrypt('password'),
        'status' => 'Aktif',
    ]);

    $response = $this->post('/adm', [
        'nip' => $admin->nip,
        'password' => 'wrong_password',
    ]);

    $response->assertRedirect('/adm');
    $this->assertGuest('admin');
});

it('cannot authenticate inactive admin', function () {
    $admin = Admin::factory()->create([
        'nip' => '12345',
        'password' => bcrypt('password'),
        'status' => 'Non-Aktif',
    ]);

    $response = $this->post('/adm', [
        'nip' => $admin->nip,
        'password' => 'password',
    ]);

    $response->assertRedirect('/adm');
    $this->assertGuest('admin');
});

it('can logout admin', function () {
    $admin = Admin::factory()->create([
        'nip' => '12345',
        'password' => bcrypt('password'),
        'status' => 'Aktif',
    ]);

    Auth::guard('admin')->login($admin);

    $response = $this->get('/adm/logout');

    $response->assertRedirect('/adm');
    $this->assertGuest('admin');
});
