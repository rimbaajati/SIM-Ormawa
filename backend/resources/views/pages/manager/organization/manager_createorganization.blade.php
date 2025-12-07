@extends('layouts.manager_app')

@section('title', 'Daftarkan Organisasi Baru')

@section('content')

    {{-- 1. HEADER (Sudah saya perbaiki teksnya biar gak "All Proposals" lagi) --}}
    <div class="page-title-box d-flex align-items-center justify-content-between">
        <h4 class="mb-0">Tambah Organisasi</h4>
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('manager.organization.all') }}">Organisasi</a></li>
            <li class="breadcrumb-item active">Tambah Baru</li>
        </ol>
    </div>
    {{-- 2. CONTENT FORM --}}
    <div class="row">
        <div class="col-xl-8"> {{-- Pakai col-8 biar formnya gak terlalu lebar --}}
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Formulir Pendaftaran Ormawa/UKM</h4>

                    {{-- Form Start --}}
                    <form action="{{ route('organization.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Input: Nama Organisasi --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Organisasi <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" placeholder="Contoh: UKM Musik, HIMA TI"
                                required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Input: Ketua --}}
                        <div class="mb-3">
                            <label for="ketua" class="form-label">Nama Ketua / Penanggung Jawab <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('ketua') is-invalid @enderror" id="ketua"
                                name="ketua" value="{{ old('ketua') }}" required>
                            @error('ketua')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            {{-- Input: Kontak --}}
                            <div class="col-md-6 mb-3">
                                <label for="kontak" class="form-label">No. WhatsApp / HP <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kontak') is-invalid @enderror"
                                    id="kontak" name="kontak" value="{{ old('kontak') }}" required>
                                @error('kontak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Input: Email --}}
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Resmi</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}"
                                    placeholder="email@organisasi.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Input: Instagram --}}
                        <div class="mb-3">
                            <label for="instagram" class="form-label">Link Instagram</label>
                            <div class="input-group">
                                <span class="input-group-text" id="ig-addon">instagram.com/</span>
                                <input type="text" class="form-control @error('instagram') is-invalid @enderror"
                                    id="instagram" name="instagram" value="{{ old('instagram') }}"
                                    placeholder="username_ukm">
                            </div>
                            @error('instagram')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Input: Deskripsi --}}
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi / Profil Singkat <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5"
                                required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Input: Logo --}}
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo Organisasi <span
                                    class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo"
                                name="logo" accept="image/*" required>
                            <div class="form-text">Format: JPG, PNG, JPEG. Maksimal 2MB.</div>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Input: Status Aktif (Switch) --}}
                        <div class="mb-4">
                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                    value="1" checked>
                                <label class="form-check-label" for="is_active">Status Aktif</label>
                            </div>
                            <small class="text-muted">Jika dinonaktifkan, organisasi tidak akan muncul di halaman
                                publik.</small>
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                <i class="bx bx-save me-1"></i> Simpan Organisasi
                            </button>
                            <a href="{{ route('manager.organization.all') }}" class="btn btn-secondary waves-effect">
                                Batal
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
