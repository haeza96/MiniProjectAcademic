<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Mahasiswa::firstOrCreate(
            ['nim' => '202601001'],
            [
                'nama' => 'Mochammad Hadyan',
                'email' => 'hadyan@academic.id',
                'prodi' => 'Teknik Informatika',
                'semester' => 4,
                'aktif' => true,
            ]
        );

        Mahasiswa::firstOrCreate(
            ['nim' => '202601002'],
            [
                'nama' => 'Siti Nurhaliza',
                'email' => 'siti@academic.id',
                'prodi' => 'Sistem Informasi',
                'semester' => 2,
                'aktif' => true,
            ]
        );

        Mahasiswa::firstOrCreate(
            ['nim' => '202601003'],
            [
                'nama' => 'Budi Pratama',
                'email' => 'budi@academic.id',
                'prodi' => 'Teknik Informatika',
                'semester' => 6,
                'aktif' => false,
            ]
        );

        MataKuliah::firstOrCreate(
            ['kode' => 'PWL-101'],
            [
                'nama' => 'Pemrograman Web Lanjutan',
                'sks' => 3,
                'semester' => 4,
                'aktif' => true,
            ]
        );

        MataKuliah::firstOrCreate(
            ['kode' => 'BD-102'],
            [
                'nama' => 'Basis Data Lanjut',
                'sks' => 3,
                'semester' => 2,
                'aktif' => true,
            ]
        );

        MataKuliah::firstOrCreate(
            ['kode' => 'AI-103'],
            [
                'nama' => 'Kecerdasan Buatan',
                'sks' => 4,
                'semester' => 6,
                'aktif' => true,
            ]
        );
    }
}
