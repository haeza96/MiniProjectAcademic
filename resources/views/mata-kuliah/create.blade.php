@extends('layouts.app')

@section('title', 'Tambah Mata Kuliah')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 fw-bold text-primary">
                    <i class="bi bi-journal-plus me-2"></i>Tambah Data Mata Kuliah
                </h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.mata-kuliah.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="kode" class="form-label fw-semibold">Kode Mata Kuliah <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="kode" 
                               id="kode" 
                               class="form-control @error('kode') is-invalid @enderror" 
                               value="{{ old('kode') }}" 
                               placeholder="Contoh: IF101 atau PWL2026" 
                               required>
                        @error('kode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label fw-semibold">Nama Mata Kuliah <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="nama" 
                               id="nama" 
                               class="form-control @error('nama') is-invalid @enderror" 
                               value="{{ old('nama') }}" 
                               placeholder="Contoh: Pemrograman Web Lanjutan" 
                               required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="sks" class="form-label fw-semibold">Bobot SKS (1 - 6) <span class="text-danger">*</span></label>
                            <input type="number" 
                                   name="sks" 
                                   id="sks" 
                                   min="1" 
                                   max="6" 
                                   class="form-control @error('sks') is-invalid @enderror" 
                                   value="{{ old('sks', 3) }}" 
                                   required>
                            @error('sks')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="semester" class="form-label fw-semibold">Semester (1 - 8) <span class="text-danger">*</span></label>
                            <input type="number" 
                                   name="semester" 
                                   id="semester" 
                                   min="1" 
                                   max="8" 
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
                        <label class="form-check-label fw-semibold" for="aktif">Status Mata Kuliah Aktif</label>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.mata-kuliah.index') }}" class="btn btn-outline-secondary">
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
