<?php

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = Admin::factory()->create([
        'nip' => '12345678',
        'password' => Hash::make('password'),
        'status' => 'Aktif',
    ]);
});

it('can authenticate admin with valid credentials', function () {
    $response = $this->post('/adm', [
        'nip' => '12345678',
        'password' => 'password',
    ]);

    $response->assertRedirect('/adm/beranda');
    $this->assertAuthenticatedAs($this->admin, 'admin');
});

it('cannot authenticate admin with invalid credentials', function () {
    $response = $this->post('/adm', [
        'nip' => '12345678',
        'password' => 'wrong_password',
    ]);

    $response->assertRedirect('/adm');
    $this->assertGuest('admin');

    $response->assertSessionHas('status', 'failed');
    $response->assertSessionHas('message', 'Invalid credentials');
});

it('cannot authenticate inactive admin', function () {
    $this->admin->update(['status' => 'Non-Aktif']);

    $response = $this->post('/adm', [
        'nip' => '12345678',
        'password' => 'password',
    ]);

    $response->assertRedirect('/adm');
    $this->assertGuest('admin');

    $response->assertSessionHas('status', 'failed');
    $response->assertSessionHas('message', 'Account is not active');
});

it('can logout admin', function () {
    $this->actingAs($this->admin);

    $response = $this->get('/adm/logout');

    $response->assertRedirect('/adm');
    $this->assertGuest('admin');
});
