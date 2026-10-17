@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 fw-bold text-primary">
                    <i class="bi bi-person-plus me-2"></i>Tambah Data Mahasiswa
                </h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.mahasiswa.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nim" class="form-label fw-semibold">NIM <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="nim" 
                               id="nim" 
                               class="form-control @error('nim') is-invalid @enderror" 
                               value="{{ old('nim') }}" 
                               placeholder="Contoh: 202601001" 
                               required>
                        @error('nim')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label fw-semibold">Nama Mahasiswa <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="nama" 
                               id="nama" 
                               class="form-control @error('nama') is-invalid @enderror" 
                               value="{{ old('nama') }}" 
                               placeholder="Contoh: Mochammad Hadyan" 
                               required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email') }}" 
                               placeholder="Contoh: hadyan@example.com" 
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="prodi" class="form-label fw-semibold">Program Studi <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="prodi" 
                                   id="prodi" 
                                   class="form-control @error('prodi') is-invalid @enderror" 
                                   value="{{ old('prodi') }}" 
                                   placeholder="Contoh: Teknik Informatika" 
                                   required>
                            @error('prodi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="semester" class="form-label fw-semibold">Semester <span class="text-danger">*</span></label>
                            <input type="number" 
                                   name="semester" 
                                   id="semester" 
                                   min="1" 
                                   max="14" 
                                   class="form-control @error('semester') is-invalid @enderror" 
                                   value="{{ old('semester', 1) }}" 
                                   required>
                            @error('semester')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4 form-check">
                        <input type="checkbox" 
                               name="aktif" 
                               id="aktif" 
                               value="1" 
                               class="form-check-input" 
                               {{ old('aktif', '1') == '1' ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="aktif">Status Mahasiswa Aktif</label>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
