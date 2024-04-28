<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Donor;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DonorTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get('/adm/donatur');

        $response->assertStatus(200)
            ->assertViewIs('admin.donor.index');
    }

    // public function testCreate()
    // {
    //     $response = $this->get('/adm/donors/create');

    //     $response->assertStatus(200)
    //         ->assertViewIs('admin.donor.create');
    // }

    // public function testStore()
    // {
    //     $data = ['name' => 'Test Donor'];

    //     $response = $this->post('/admin/donors', $data);

    //     $response->assertStatus(302)
    //         ->assertRedirect('/admin/donors')
    //         ->assertSessionHas('success', 'Berhasil menambahkan data');

    //     $this->assertDatabaseHas('donors', $data);
    // }

    // // Test for edit and update methods
    // public function testEdit()
    // {
    //     $donor = Donor::factory()->create();

    //     $response = $this->get("/admin/donors/{$donor->id}/edit");

    //     $response->assertStatus(200)
    //         ->assertViewIs('admin.donor.edit')
    //         ->assertViewHas('data', $donor);
    // }

    // public function testUpdate()
    // {
    //     $donor = Donor::factory()->create();

    //     $data = ['name' => 'Updated Name'];

    //     $response = $this->put("/admin/donors/{$donor->id}", $data);

    //     $response->assertStatus(302)
    //         ->assertRedirect('/admin/donors')
    //         ->assertSessionHas('success', 'Berhasil update donatur');

    //     $this->assertDatabaseHas('donors', $data);
    // }

    // public function testDestroy()
    // {
    //     $donor = Donor::factory()->create();

    //     $response = $this->delete("/admin/donors/{$donor->id}");

    //     $response->assertStatus(302)
    //         ->assertRedirect('/admin/donors')
    //         ->assertSessionHas('success', 'Berhasil menghapus Donatur');

    //     $this->assertDatabaseMissing('donors', ['id' => $donor->id]);
    // }
}
