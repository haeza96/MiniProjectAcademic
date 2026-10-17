<?php

namespace Tests\Feature;

use App\Models\Mahasiswa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MahasiswaCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_mahasiswa_list(): void
    {
        $mahasiswa = Mahasiswa::create([
            'nim' => '202601001',
            'nama' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'prodi' => 'Teknik Informatika',
            'semester' => 4,
            'aktif' => true,
        ]);

        $response = $this->get(route('admin.mahasiswa.index'));

        $response->assertStatus(200);
        $response->assertSee('Daftar Mahasiswa');
        $response->assertSee('202601001');
        $response->assertSee('Budi Santoso');
    }

    public function test_create_displays_form(): void
    {
        $response = $this->get(route('admin.mahasiswa.create'));

        $response->assertStatus(200);
        $response->assertSee('Tambah Data Mahasiswa');
        $response->assertSee('NIM');
    }

    public function test_store_fails_with_empty_data(): void
    {
        $response = $this->post(route('admin.mahasiswa.store'), []);

        $response->assertSessionHasErrors(['nim', 'nama', 'email', 'prodi', 'semester']);
        $this->assertDatabaseCount('mahasiswas', 0);
    }

    public function test_store_creates_mahasiswa_with_flash_message(): void
    {
        $data = [
            'nim' => '202601002',
            'nama' => 'Siti Aminah',
            'email' => 'siti@example.com',
            'prodi' => 'Sistem Informasi',
            'semester' => 2,
            'aktif' => '1',
        ];

        $response = $this->post(route('admin.mahasiswa.store'), $data);

        $response->assertRedirect(route('admin.mahasiswa.index'));
        $response->assertSessionHas('success', 'Data mahasiswa berhasil ditambahkan.');
        $this->assertDatabaseHas('mahasiswas', [
            'nim' => '202601002',
            'nama' => 'Siti Aminah',
            'email' => 'siti@example.com',
            'aktif' => 1,
        ]);
    }

    public function test_store_fails_with_duplicate_nim_or_email(): void
    {
        Mahasiswa::create([
            'nim' => '202601001',
            'nama' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'prodi' => 'Teknik Informatika',
            'semester' => 4,
            'aktif' => true,
        ]);

        $response = $this->post(route('admin.mahasiswa.store'), [
            'nim' => '202601001',
            'nama' => 'Budi Baru',
            'email' => 'budi@example.com',
            'prodi' => 'Teknik Komputer',
            'semester' => 1,
        ]);

        $response->assertSessionHasErrors(['nim', 'email']);
    }

    public function test_show_displays_mahasiswa_detail_using_model_binding(): void
    {
        $mahasiswa = Mahasiswa::create([
            'nim' => '202601003',
            'nama' => 'Andi Wijaya',
            'email' => 'andi@example.com',
            'prodi' => 'Teknik Elektro',
            'semester' => 6,
            'aktif' => true,
        ]);

        $response = $this->get(route('admin.mahasiswa.show', $mahasiswa));

        $response->assertStatus(200);
        $response->assertSee('Detail Mahasiswa');
        $response->assertSee('202601003');
        $response->assertSee('Andi Wijaya');
    }

    public function test_show_returns_404_when_not_found(): void
    {
        $response = $this->get('/admin/mahasiswa/99999');

        $response->assertStatus(404);
    }

    public function test_edit_displays_form_with_existing_data(): void
    {
        $mahasiswa = Mahasiswa::create([
            'nim' => '202601004',
            'nama' => 'Rina Melati',
            'email' => 'rina@example.com',
            'prodi' => 'Manajemen Informatika',
            'semester' => 3,
            'aktif' => true,
        ]);

        $response = $this->get(route('admin.mahasiswa.edit', $mahasiswa));

        $response->assertStatus(200);
        $response->assertSee('Edit Data Mahasiswa');
        $response->assertSee('202601004');
        $response->assertSee('Rina Melati');
    }

    public function test_update_modifies_mahasiswa_with_flash_message(): void
    {
        $mahasiswa = Mahasiswa::create([
            'nim' => '202601005',
            'nama' => 'Ahmad Fauzi',
            'email' => 'ahmad@example.com',
            'prodi' => 'Teknik Informatika',
            'semester' => 5,
            'aktif' => true,
        ]);

        $updateData = [
            'nim' => '202601005',
            'nama' => 'Ahmad Fauzi Update',
            'email' => 'ahmad.new@example.com',
            'prodi' => 'Teknik Informatika',
            'semester' => 6,
            // nonaktif (checkbox unchecked)
        ];

        $response = $this->put(route('admin.mahasiswa.update', $mahasiswa), $updateData);

        $response->assertRedirect(route('admin.mahasiswa.index'));
        $response->assertSessionHas('success', 'Data mahasiswa berhasil diperbarui.');
        $this->assertDatabaseHas('mahasiswas', [
            'id' => $mahasiswa->id,
            'nama' => 'Ahmad Fauzi Update',
            'email' => 'ahmad.new@example.com',
            'semester' => 6,
            'aktif' => 0,
        ]);
    }

    public function test_destroy_deletes_mahasiswa_with_flash_message(): void
    {
        $mahasiswa = Mahasiswa::create([
            'nim' => '202601006',
            'nama' => 'Dewi Lestari',
            'email' => 'dewi@example.com',
            'prodi' => 'Sistem Informasi',
            'semester' => 2,
            'aktif' => true,
        ]);

        $response = $this->delete(route('admin.mahasiswa.destroy', $mahasiswa));

        $response->assertRedirect(route('admin.mahasiswa.index'));
        $response->assertSessionHas('success', 'Data mahasiswa berhasil dihapus.');
        $this->assertDatabaseMissing('mahasiswas', [
            'id' => $mahasiswa->id,
        ]);
    }
}
