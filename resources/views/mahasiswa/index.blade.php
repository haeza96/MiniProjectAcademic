@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h4 class="mb-0 fw-bold text-primary">
            <i class="bi bi-people me-2"></i>Daftar Mahasiswa
        </h4>
        <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Mahasiswa
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Email</th>
                        <th>Program Studi</th>
                        <th>Semester</th>
                        <th>Status</th>
                        <th class="text-center pe-3" style="width: 220px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mahasiswas as $mahasiswa)
                        <tr>
                            <td class="ps-3 fw-semibold">{{ $mahasiswa->nim }}</td>
                            <td>{{ $mahasiswa->nama }}</td>
                            <td>{{ $mahasiswa->email }}</td>
                            <td>{{ $mahasiswa->prodi }}</td>
                            <td>{{ $mahasiswa->semester }}</td>
                            <td>
                                @if ($mahasiswa->aktif)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-center pe-3">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('admin.mahasiswa.show', $mahasiswa) }}" class="btn btn-sm btn-info text-white" title="Lihat Detail">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('admin.mahasiswa.edit', $mahasiswa) }}" class="btn btn-sm btn-warning text-white" title="Edit Data">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.mahasiswa.destroy', $mahasiswa) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa {{ $mahasiswa->nama }} ({{ $mahasiswa->nim }})?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Data">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Belum ada data mahasiswa. Silakan tambah data baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
