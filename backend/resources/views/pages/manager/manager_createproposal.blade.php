<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Proposal Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: #f2f2f2">

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">

                        <h4 class="mb-4">Buat Proposal Baru</h4>

                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- JUDUL --}}
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Judul Proposal</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                    name="judul" value="{{ old('judul') }}" placeholder="Masukkan judul proposal">

                                @error('judul')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- DESKRIPSI --}}
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="5"
                                    placeholder="Tuliskan deskripsi proposal">{{ old('deskripsi') }}</textarea>

                                @error('deskripsi')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- WAKTU --}}
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Waktu Pelaksanaan</label>
                                <input type="date" class="form-control @error('waktu') is-invalid @enderror"
                                    name="waktu" value="{{ old('waktu') }}">

                                @error('waktu')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- TEMPAT --}}
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Tempat</label>
                                <input type="text" class="form-control @error('tempat') is-invalid @enderror"
                                    name="tempat" value="{{ old('tempat') }}" placeholder="Masukkan lokasi kegiatan">

                                @error('tempat')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ANGGARAN --}}
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Anggaran (Rp)</label>
                                <input type="number" class="form-control @error('anggaran') is-invalid @enderror"
                                    name="anggaran" value="{{ old('anggaran') }}"
                                    placeholder="Masukkan nominal anggaran">

                                @error('anggaran')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- FILE PROPOSAL --}}
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">File Proposal (PDF Maks 2 MB)</label>
                                <input type="file" class="form-control @error('file_proposal') is-invalid @enderror"
                                    name="file_proposal">

                                @error('file_proposal')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- BUTTON --}}
                            <button type="submit" class="btn btn-primary me-3">Simpan</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Jika mau CKEditor untuk deskripsi --}}
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('deskripsi');
    </script>

</body>

</html>
