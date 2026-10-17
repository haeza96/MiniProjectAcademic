<?php

namespace Tests\Feature;

use App\Models\MataKuliah;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MataKuliahCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_mata_kuliah_list(): void
    {
        MataKuliah::create([
            'kode' => 'MK-101',
            'nama' => 'Algoritma dan Pemrograman',
            'sks' => 3,
            'semester' => 1,
            'aktif' => true,
        ]);

        $response = $this->get(route('admin.mata-kuliah.index'));

        $response->assertStatus(200);
        $response->assertSee('Daftar Mata Kuliah');
        $response->assertSee('MK-101');
        $response->assertSee('Algoritma dan Pemrograman');
    }

    public function test_create_displays_form(): void
    {
        $response = $this->get(route('admin.mata-kuliah.create'));

        $response->assertStatus(200);
        $response->assertSee('Tambah Data Mata Kuliah');
        $response->assertSee('Kode Mata Kuliah');
    }

    public function test_store_fails_with_empty_data(): void
    {
        $response = $this->post(route('admin.mata-kuliah.store'), []);

        $response->assertSessionHasErrors(['kode', 'nama', 'sks', 'semester']);
        $this->assertDatabaseCount('mata_kuliahs', 0);
    }

    public function test_store_fails_with_invalid_sks_or_semester(): void
    {
        $response = $this->post(route('admin.mata-kuliah.store'), [
            'kode' => 'MK-102',
            'nama' => 'Basis Data',
            'sks' => 10, // Max is 6
            'semester' => 12, // Max is 8
        ]);

        $response->assertSessionHasErrors(['sks', 'semester']);
    }

    public function test_store_creates_mata_kuliah_with_flash_message(): void
    {
        $data = [
            'kode' => 'PWL-2026',
            'nama' => 'Pemrograman Web Lanjutan',
            'sks' => 3,
            'semester' => 4,
            'aktif' => '1',
        ];

        $response = $this->post(route('admin.mata-kuliah.store'), $data);

        $response->assertRedirect(route('admin.mata-kuliah.index'));
        $response->assertSessionHas('success', 'Data mata kuliah berhasil ditambahkan.');
        $this->assertDatabaseHas('mata_kuliahs', [
            'kode' => 'PWL-2026',
            'nama' => 'Pemrograman Web Lanjutan',
            'sks' => 3,
            'semester' => 4,
            'aktif' => 1,
        ]);
    }

    public function test_store_fails_with_duplicate_kode(): void
    {
        MataKuliah::create([
            'kode' => 'PWL-2026',
            'nama' => 'Pemrograman Web Lanjutan',
            'sks' => 3,
            'semester' => 4,
            'aktif' => true,
        ]);

        $response = $this->post(route('admin.mata-kuliah.store'), [
            'kode' => 'PWL-2026',
            'nama' => 'Pemrograman Web Lanjutan Duplikat',
            'sks' => 4,
            'semester' => 4,
        ]);

        $response->assertSessionHasErrors(['kode']);
    }

    public function test_show_displays_detail_using_model_binding(): void
    {
        $mk = MataKuliah::create([
            'kode' => 'JARKOM-301',
            'nama' => 'Jaringan Komputer',
            'sks' => 4,
            'semester' => 5,
            'aktif' => true,
        ]);

        $response = $this->get(route('admin.mata-kuliah.show', $mk));

        $response->assertStatus(200);
        $response->assertSee('Detail Mata Kuliah');
        $response->assertSee('JARKOM-301');
        $response->assertSee('Jaringan Komputer');
    }

    public function test_show_returns_404_when_not_found(): void
    {
        $response = $this->get('/admin/mata-kuliah/99999');

        $response->assertStatus(404);
    }

    public function test_edit_displays_form_with_existing_data(): void
    {
        $mk = MataKuliah::create([
            'kode' => 'AI-401',
            'nama' => 'Kecerdasan Buatan',
            'sks' => 3,
            'semester' => 6,
            'aktif' => true,
        ]);

        $response = $this->get(route('admin.mata-kuliah.edit', $mk));

        $response->assertStatus(200);
        $response->assertSee('Edit Data Mata Kuliah');
        $response->assertSee('AI-401');
        $response->assertSee('Kecerdasan Buatan');
    }

    public function test_update_modifies_mata_kuliah_with_flash_message(): void
    {
        $mk = MataKuliah::create([
            'kode' => 'RPL-201',
            'nama' => 'Rekayasa Perangkat Lunak',
            'sks' => 3,
            'semester' => 3,
            'aktif' => true,
        ]);

        $updateData = [
            'kode' => 'RPL-201',
            'nama' => 'Rekayasa Perangkat Lunak Lanjut',
            'sks' => 4,
            'semester' => 4,
            // nonaktif
        ];

        $response = $this->put(route('admin.mata-kuliah.update', $mk), $updateData);

        $response->assertRedirect(route('admin.mata-kuliah.index'));
        $response->assertSessionHas('success', 'Data mata kuliah berhasil diperbarui.');
        $this->assertDatabaseHas('mata_kuliahs', [
            'id' => $mk->id,
            'nama' => 'Rekayasa Perangkat Lunak Lanjut',
            'sks' => 4,
            'semester' => 4,
            'aktif' => 0,
        ]);
    }

    public function test_destroy_deletes_mata_kuliah_with_flash_message(): void
    {
        $mk = MataKuliah::create([
            'kode' => 'SI-101',
            'nama' => 'Sistem Informasi Manajemen',
            'sks' => 3,
            'semester' => 2,
            'aktif' => true,
        ]);

        $response = $this->delete(route('admin.mata-kuliah.destroy', $mk));

        $response->assertRedirect(route('admin.mata-kuliah.index'));
        $response->assertSessionHas('success', 'Data mata kuliah berhasil dihapus.');
        $this->assertDatabaseMissing('mata_kuliahs', [
            'id' => $mk->id,
        ]);
    }
}
