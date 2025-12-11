@extends('layouts.manager_app')

@section('title', 'Edit Data Organisasi')

@section('content')

    <div class="page-title-box d-flex align-items-center justify-content-between">
        <h4 class="mb-0">Edit Organisasi</h4>
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('manager.organization.all') }}">Organisasi</a></li>
            <li class="breadcrumb-item active">Edit Data</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Formulir Perubahan Data Ormawa/UKM</h4>

                    {{-- Form Start --}}
                    {{-- Perhatikan route mengarah ke UPDATE dan mengirim ID Organization --}}
                    <form action="{{ route('manager.organization.update', $organization->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- BAGIAN 1: IDENTITAS ORGANISASI --}}
                        <div class="row">
                            {{-- Kolom Kiri: Nama Singkatan --}}
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Singkatan <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" {{-- Mengambil data lama ($organization->name) jika tidak ada input baru --}}
                                    value="{{ old('name', $organization->name) }}" placeholder="Contoh: BEM, HIMA TI"
                                    required oninput="this.value = this.value.toUpperCase()">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Kolom Kanan: Nama Lengkap --}}
                            <div class="col-md-6 mb-3">
                                <label for="full_name" class="form-label">Nama Lengkap Organisasi</label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                    id="full_name" name="full_name" value="{{ old('full_name', $organization->full_name) }}"
                                    placeholder="Contoh: Badan Eksekutif Mahasiswa"
                                    oninput="this.value = this.value.replace(/\b\w/g, function(l){ return l.toUpperCase() })">
                                @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- BAGIAN 2: SDM --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="ketua" class="form-label">Nama Ketua / Penanggung Jawab <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('ketua') is-invalid @enderror"
                                    id="ketua" name="ketua" value="{{ old('ketua', $organization->ketua) }}"
                                    placeholder="Nama Mahasiswa" required>
                                @error('ketua')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="pembimbing" class="form-label">Dosen Pembimbing</label>
                                <input type="text" class="form-control @error('pembimbing') is-invalid @enderror"
                                    id="pembimbing" name="pembimbing"
                                    value="{{ old('pembimbing', $organization->pembimbing) }}"
                                    placeholder="Nama Dosen (Opsional)">
                                @error('pembimbing')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- BAGIAN 3: KONTAK --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kontak" class="form-label">No. WhatsApp / HP <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kontak') is-invalid @enderror"
                                    id="kontak" name="kontak" value="{{ old('kontak', $organization->kontak) }}"
                                    placeholder="08..." required>
                                @error('kontak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Resmi</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $organization->email) }}"
                                    placeholder="email@organisasi.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="instagram" class="form-label">Link Instagram</label>
                            <div class="input-group">
                                <span class="input-group-text" id="ig-addon">instagram.com/</span>
                                <input type="text" class="form-control @error('instagram') is-invalid @enderror"
                                    id="instagram" name="instagram"
                                    value="{{ old('instagram', $organization->instagram) }}" placeholder="username_ukm">
                            </div>
                            @error('instagram')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- BAGIAN 4: PROFIL LENGKAP --}}
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi / Profil Singkat</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4"
                                placeholder="Jelaskan secara singkat...">{{ old('deskripsi', $organization->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="visi" class="form-label">Visi Organisasi</label>
                            <textarea class="form-control @error('visi') is-invalid @enderror" id="visi" name="visi" rows="2"
                                placeholder="Cita-cita organisasi...">{{ old('visi', $organization->visi) }}</textarea>
                            @error('visi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="misi" class="form-label">Misi Organisasi</label>
                            <textarea class="form-control @error('misi') is-invalid @enderror" id="misi" name="misi" rows="4"
                                placeholder="Langkah-langkah konkret...">{{ old('misi', $organization->misi) }}</textarea>
                            @error('misi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- BAGIAN 5: LOGO & STATUS --}}
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo Organisasi</label>

                            {{-- Preview Logo Lama --}}
                            @if ($organization->logo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $organization->logo) }}" alt="Logo Lama"
                                        class="img-thumbnail" style="height: 100px;">
                                    <small class="d-block text-muted">Logo saat ini</small>
                                </div>
                            @endif

                            {{-- Input File (Tidak Required saat edit) --}}
                            <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                id="logo" name="logo" accept="image/*">
                            <div class="form-text">Biarkan kosong jika tidak ingin mengubah logo. (Max: 2MB)</div>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                {{-- Logic Checkbox: Centang jika old input '1' ATAU data database '1' --}}
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                    value="1" {{ old('is_active', $organization->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Status Aktif</label>
                            </div>
                            <small class="text-muted">Jika dinonaktifkan, organisasi tidak akan muncul di halaman
                                publik.</small>
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-warning waves-effect waves-light">
                                <i class="bx bx-save me-1"></i> Perbarui Data
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
