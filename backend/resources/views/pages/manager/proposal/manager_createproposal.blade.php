@extends('layouts.manager_app')

@section('title', 'Ajukan Proposal')

@section('content')

    <div class="page-title-box d-flex align-items-center justify-content-between mb-0">
        <h4 class="mb-0">Ajukan Proposal</h4>
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item">Manager</li>
            <li class="breadcrumb-item active">Ajukan Proposals</li>
        </ol>
    </div>

    <div class="card shadow-sm p-10">
        <div class="w-100">
            <div class="card-body p-4">
                <h5 class="mb-4 y">Buat Proposal Baru</h5>
                <form action="{{ route('manager.proposal.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        {{-- JUDUL --}}
                        <div class="col-12 mb-3">
                            <label class="form-label fw-medium">Judul Proposal</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul"
                                value="{{ old('judul') }}" placeholder="Masukkan judul proposal">
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- ORGANISASI --}}
                        <div class="col-12 mb-3">
                            <label class="form-label fw-medium">Organisasi</label>

                            <select name="id_organization"
                                class="form-select @error('id_organization') is-invalid @enderror">
                                <option value="">-- Pilih Organisasi --</option>

                                @foreach ($organizations as $org)
                                    <option value="{{ $org->id }}"
                                        {{ old('id_organization') == $org->id ? 'selected' : '' }}>
                                        {{ $org->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('id_organization')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        {{-- DESKRIPSI --}}
                        <div class="col-12 mb-3">
                            <label class="form-label fw-medium">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="5"
                                placeholder="Tuliskan deskripsi proposal">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!--- WAKTU --->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Waktu Pelaksanaan</label>
                            <input type="date" class="form-control @error('waktu') is-invalid @enderror" name="waktu"
                                value="{{ old('waktu') }}">
                            @error('waktu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!--- TEMPAT --->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Tempat</label>
                            <input type="text" class="form-control @error('tempat') is-invalid @enderror" name="tempat"
                                value="{{ old('tempat') }}" placeholder="Masukkan lokasi kegiatan">
                            @error('tempat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!--- ANGGARAN --->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Anggaran (Rp)</label>

                            <input type="number" class="form-control bg-light @error('anggaran') is-invalid @enderror"
                                name="anggaran" value="{{ old('anggaran') }}" placeholder="Otomatis dihitung dari rincian"
                                readonly>

                            <small class="text-muted">Nominal akan terisi otomatis dari tabel rincian.</small>

                            @error('anggaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- FILE --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">File Proposal (PDF Maks 2 MB)</label>
                            <input type="file" class="form-control @error('file_proposal') is-invalid @enderror"
                                name="file_proposal">
                            @error('file_proposal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    {{-- BUTTON --}}
                    <div class="d-flex justify-content-end mt-4">
                        <button type="reset" class="btn btn-warning me-2 px-4">Reset</button>
                        <button type="submit" class="btn btn-primary px-4">Simpan</button>
                    </div>

                </form>

            </div>
        </div>

    </div>


    {{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/4.25.1-lts/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('deskripsi');
    </script>

@endsection
