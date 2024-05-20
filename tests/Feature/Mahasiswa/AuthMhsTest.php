<?php

// use App\Models\User;
// use Illuminate\Foundation\Testing\DatabaseTransactions;

// uses(DatabaseTransactions::class);

// it('can authenticate student with valid credentials', function () {
//     $user = User::factory()->create();

//     $response = $this->post('/login', [
//         'npm' => $user->npm,
//         'password' => $user->password,
//     ]);

//     $response->assertRedirect('/mhs/beranda');
//     $this->assertAuthenticatedAs($user, 'user');
// });

// it('cannot authenticate student with invalid credentials', function () {
//     $user = User::factory()->create();

//     $response = $this->post('/login', [
//         'npm' => $user->npm,
//         'password' => 'wrong_password',
//     ]);

//     $response->assertRedirect('/login');
//     $this->assertAuthenticatedAs('user');
// });

// it('can logout student', function () {
//     $user = User::factory()->create();

//     Auth()->login($user);

//     $response = $this->get('/mhs/logout');

//     $response->assertRedirect('/login');
//     $this->assertGuest('user');
// });
