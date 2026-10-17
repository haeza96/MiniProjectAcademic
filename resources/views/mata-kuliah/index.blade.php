@extends('layouts.app')

@section('title', 'Data Mata Kuliah')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h4 class="mb-0 fw-bold text-primary">
            <i class="bi bi-journal-text me-2"></i>Daftar Mata Kuliah
        </h4>
        <a href="{{ route('admin.mata-kuliah.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Mata Kuliah
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Kode MK</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Status</th>
                        <th class="text-center pe-3" style="width: 220px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mataKuliahs as $mataKuliah)
                        <tr>
                            <td class="ps-3 fw-semibold">{{ $mataKuliah->kode }}</td>
                            <td>{{ $mataKuliah->nama }}</td>
                            <td>{{ $mataKuliah->sks }} SKS</td>
                            <td>Semester {{ $mataKuliah->semester }}</td>
                            <td>
                                @if ($mataKuliah->aktif)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-center pe-3">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('admin.mata-kuliah.show', $mataKuliah) }}" class="btn btn-sm btn-info text-white" title="Lihat Detail">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('admin.mata-kuliah.edit', $mataKuliah) }}" class="btn btn-sm btn-warning text-white" title="Edit Data">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.mata-kuliah.destroy', $mataKuliah) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata kuliah {{ $mataKuliah->nama }} ({{ $mataKuliah->kode }})?');">
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
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Belum ada data mata kuliah. Silakan tambah data baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
