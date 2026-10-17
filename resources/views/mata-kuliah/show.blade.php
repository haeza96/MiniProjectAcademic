@extends('layouts.app')

@section('title', 'Detail Mata Kuliah')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold text-primary">
                    <i class="bi bi-journal-check me-2"></i>Detail Mata Kuliah
                </h4>
                <div>
                    @if ($mataKuliah->aktif)
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
                            <th class="bg-light" style="width: 30%;">Kode Mata Kuliah</th>
                            <td class="fw-bold">{{ $mataKuliah->kode }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Nama Mata Kuliah</th>
                            <td>{{ $mataKuliah->nama }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Bobot SKS</th>
                            <td>{{ $mataKuliah->sks }} SKS</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Semester Ditawarkan</th>
                            <td>Semester {{ $mataKuliah->semester }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Status Kurikulum</th>
                            <td>
                                {{ $mataKuliah->aktif ? 'Aktif' : 'Nonaktif' }}
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">Tanggal Didaftarkan</th>
                            <td>{{ $mataKuliah->created_at ? $mataKuliah->created_at->format('d M Y H:i') : '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Terakhir Diperbarui</th>
                            <td>{{ $mataKuliah->updated_at ? $mataKuliah->updated_at->format('d M Y H:i') : '-' }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.mata-kuliah.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.mata-kuliah.edit', $mataKuliah) }}" class="btn btn-warning text-white">
                            <i class="bi bi-pencil me-1"></i> Edit Mata Kuliah
                        </a>
                        <form action="{{ route('admin.mata-kuliah.destroy', $mataKuliah) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mata kuliah ini?');">
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
