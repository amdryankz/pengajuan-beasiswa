<?php

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use function Pest\Laravel\post;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertGuest;

// uses(DatabaseTransactions::class);

// it('can authenticate with valid credentials', function () {
//     $user = User::factory()->create();

//     post('/login', [
//         'npm' => $user->npm,
//         'password' => 'password',
//     ]);

//     assertAuthenticated();
// });

// it('cannot authenticate with invalid credentials', function () {
//     $user = User::factory()->create();

//     post('/login', [
//         'npm' => $user->npm,
//         'password' => 'password123',
//     ]);

//     assertGuest();
// });
