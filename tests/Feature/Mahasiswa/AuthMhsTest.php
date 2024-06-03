<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create([
        'npm' => '12345678',
        'password' => Hash::make('password'),
    ]);
});

it('can authenticate student with valid credentials', function () {
    $response = $this->post('/login', [
        'npm' => '12345678',
        'password' => 'password',
    ]);

    $response->assertRedirect('/mhs/beranda');
    $this->assertAuthenticatedAs($this->user);
});

it('cannot authenticate inactive student', function () {
    $user = User::factory()->create([
        'npm' => '12345',
        'password' => Hash::make('password'),
        'active_status' => 'Tidak Aktif',
    ]);

    $response = $this->post('/login', [
        'npm' => $user->npm,
        'password' => 'password',
    ]);

    $response->assertRedirect('/login');
    $this->assertGuest();

    $response->assertSessionHas('status', 'failed');
    $response->assertSessionHas('message', 'Account is not active');
});

it('cannot authenticate student with invalid credentials', function () {
    $response = $this->post('/login', [
        'npm' => '12345678',
        'password' => 'wrongpassword',
    ]);

    $response->assertRedirect('/login');
    $response->assertSessionHas('status', 'failed');
    $response->assertSessionHas('message', 'Invalid credentials');
    $this->assertGuest();
});

it('can logout student', function () {
    $this->actingAs($this->user);

    $response = $this->get('/mhs/logout');

    $response->assertRedirect('/login');
    $this->assertGuest();
});
