@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold text-primary">
                    <i class="bi bi-person-vcard me-2"></i>Detail Mahasiswa
                </h4>
                <div>
                    @if ($mahasiswa->aktif)
                        <span class="badge bg-success px-3 py-2 fs-6">Aktif</span>
                    @else
                        <span class="badge bg-secondary px-3 py-2 fs-6">Nonaktif</span>
                    @endif
                </div>
            </div>
            <div class="card-body p-4">
                <table class="table table-bordered mb-4">
                    <tbody>
                        <tr>
                            <th class="bg-light" style="width: 30%;">NIM</th>
                            <td class="fw-bold">{{ $mahasiswa->nim }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Nama Lengkap</th>
                            <td>{{ $mahasiswa->nama }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Email</th>
                            <td>{{ $mahasiswa->email }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Program Studi</th>
                            <td>{{ $mahasiswa->prodi }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Semester</th>
                            <td>Semester {{ $mahasiswa->semester }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Status Akademik</th>
                            <td>
                                {{ $mahasiswa->aktif ? 'Aktif' : 'Nonaktif' }}
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">Tanggal Didaftarkan</th>
                            <td>{{ $mahasiswa->created_at ? $mahasiswa->created_at->format('d M Y H:i') : '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Terakhir Diperbarui</th>
                            <td>{{ $mahasiswa->updated_at ? $mahasiswa->updated_at->format('d M Y H:i') : '-' }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.mahasiswa.edit', $mahasiswa) }}" class="btn btn-warning text-white">
                            <i class="bi bi-pencil me-1"></i> Edit Mahasiswa
                        </a>
                        <form action="{{ route('admin.mahasiswa.destroy', $mahasiswa) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
