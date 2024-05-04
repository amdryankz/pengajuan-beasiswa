<?php

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class);

it('can authenticate admin with valid credentials', function () {
    $admin = Admin::factory()->create([
        'nip' => '12345',
        'password' => bcrypt('password'),
        'status' => 'Aktif',
    ]);

    $response = $this->post('/adm', [
        'nip' => '12345',
        'password' => 'password',
    ]);

    $response->assertRedirect('/adm/beranda');
    $this->assertAuthenticatedAs($admin, 'admin');
});

it('cannot authenticate admin with invalid credentials', function () {
    Admin::factory()->create([
        'nip' => '12345',
        'password' => bcrypt('password'),
        'status' => 'Aktif',
    ]);

    $response = $this->post('/adm', [
        'nip' => '12345',
        'password' => 'wrong_password',
    ]);

    $response->assertRedirect('/adm');
    $this->assertGuest('admin');
});

it('cannot authenticate inactive admin', function () {
    Admin::factory()->create([
        'nip' => '12345',
        'password' => bcrypt('password'),
        'status' => 'Non-Aktif',
    ]);

    $response = $this->post('/adm', [
        'nip' => '12345',
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
