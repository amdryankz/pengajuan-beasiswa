<?php

use App\Models\Role;
use App\Models\Admin;
use App\Models\Announcement;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->adminRole = Role::factory()->admin()->create();
    $this->operatorRole = Role::factory()->operator()->create();

    $this->admin = Admin::factory()->create(['role_id' => $this->adminRole->id]);
    $this->operator = Admin::factory()->create(['role_id' => $this->operatorRole->id]);
});

it('can access announcement index with data', function () {
    $this->actingAs($this->admin, 'admin');
    Announcement::factory(5)->create();

    $response = $this->get('/adm/pengumuman');
    $response->assertOk();
    $response->assertViewHas('data');
    $announcements = $response->viewData('data');
    $this->assertCount(5, $announcements);
});

it('can create an announcement', function () {
    $this->actingAs($this->admin, 'admin');
    Storage::fake('public');

    $response = $this->post('/adm/pengumuman', [
        'title' => 'Pengumuman Baru',
        'image' => UploadedFile::fake()->image('image.jpg'),
        'letter_number' => '123/ABC',
        'content' => 'Isi pengumuman baru',
    ]);

    $response->assertRedirect('/adm/pengumuman');
    $this->assertDatabaseHas('announcements', [
        'title' => 'Pengumuman Baru',
        'letter_number' => '123/ABC',
        'content' => 'Isi pengumuman baru',
    ]);
    $this->assertTrue(Storage::disk('public')->exists('announcements/Gambar Pengumuman Baru.jpg'));
});

it('can update an announcement', function () {
    $this->actingAs($this->admin, 'admin');
    Storage::fake('public');
    $announcement = Announcement::factory()->create();
    $newImage = UploadedFile::fake()->image('new_image.jpg');

    $response = $this->put("/adm/pengumuman/{$announcement->id}", [
        'title' => 'Pengumuman Diperbarui',
        'image' => $newImage,
        'letter_number' => '456/DEF',
        'content' => 'Isi pengumuman diperbarui',
    ]);

    $response->assertRedirect('/adm/pengumuman');
    $this->assertDatabaseHas('announcements', [
        'id' => $announcement->id,
        'title' => 'Pengumuman Diperbarui',
        'letter_number' => '456/DEF',
        'content' => 'Isi pengumuman diperbarui',
    ]);
    $this->assertTrue(Storage::disk('public')->exists('announcements/Gambar Pengumuman Diperbarui.jpg'));
});

it('can delete an announcement', function () {
    $this->actingAs($this->admin, 'admin');
    $announcement = Announcement::factory()->create();

    $response = $this->delete("/adm/pengumuman/{$announcement->id}");
    $response->assertRedirect('/adm/pengumuman');
    $this->assertDatabaseMissing('announcements', [
        'id' => $announcement->id,
    ]);
});

it('non-admin user cannot access announcement', function () {
    $this->actingAs($this->operator, 'admin');

    $response = $this->get('/adm/pengumuman');
    $response->assertStatus(403);
});
