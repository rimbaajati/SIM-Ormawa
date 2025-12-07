@extends('layouts.manager_app')

@section('title', 'Detail Proposal')

@section('content')
    {{-- Breadcrumb & Header --}}
    <div class="page-title-box d-flex align-items-center justify-content-between">
        <h4 class="mb-0">Detail Proposal</h4>
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="#">Proposal</a></li>
            <li class="breadcrumb-item"><a href="#">All Proposals</a></li>
            <li class="breadcrumb-item active">Detail Proposal</li>
        </ol>
    </div>

    {{-- Content Area --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    {{-- Header Proposal: Judul & Status --}}
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h3 class="card-title text-primary mb-1">{{ $proposal->judul_kegiatan }}</h3>
                            <p class="text-muted mb-0">ID Proposal: <strong>#{{ $proposal->id }}</strong></p>
                        </div>
                        <div>
                            {{-- Logika Badge Status --}}
                            @if ($proposal->status == 'approved' || $proposal->status == 'disetujui')
                                <span class="badge bg-success fs-6">Disetujui</span>
                            @elseif($proposal->status == 'rejected' || $proposal->status == 'ditolak')
                                <span class="badge bg-danger fs-6">Ditolak</span>
                            @else
                                <span class="badge bg-warning fs-6">Menunggu</span>
                            @endif
                        </div>
                    </div>

                    <hr>

                    {{-- Detail Informasi (Grid Layout) --}}
                    <div class="row">
                        {{-- Kolom Kiri --}}
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">Organisasi</th>
                                    <td>: {{ $proposal->organisasi }}</td>
                                </tr>
                                <tr>
                                    <th>Diajukan Oleh (User ID)</th>
                                    <td>: {{ $proposal->user_id }}
                                        {{-- Opsional: Jika ada relasi user, bisa pakai: {{ $proposal->user->name }} --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Diajukan</th>
                                    <td>: {{ \Carbon\Carbon::parse($proposal->created_at)->format('d M Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Waktu Kegiatan</th>
                                    <td>: {{ $proposal->waktu }}</td>
                                </tr>
                            </table>
                        </div>

                        {{-- Kolom Kanan --}}
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">Tempat</th>
                                    <td>: {{ $proposal->tempat }}</td>
                                </tr>
                                <tr>
                                    <th>Anggaran</th>
                                    <td class="text-success fw-bold">
                                        : Rp {{ number_format($proposal->anggaran, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>File Proposal</th>
                                    <td>
                                        @if ($proposal->file)
                                            : <a href="{{ asset('storage/' . $proposal->file) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bx bx-download"></i> Download File
                                            </a>
                                        @else
                                            : <span class="text-muted">Tidak ada file</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr>

                    {{-- Deskripsi Kegiatan --}}
                    <div class="mt-3">
                        <h5 class="font-size-15">Deskripsi Kegiatan</h5>
                        <p class="text-muted text-justify">
                            {{ $proposal->deskripsi }}
                        </p>
                    </div>

                    {{-- Tombol Aksi (Back) --}}
                    <div class="mt-4 text-end">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">
                            <i class="bx bx-arrow-back"></i> Kembali
                        </a>
                        {{-- Contoh tombol aksi tambahan jika diperlukan manager --}}
                        {{-- <button class="btn btn-success">Setujui</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- FORM INPUT RINCIAN ANGGARAN --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0">Input Rincian Anggaran (RAB)</h5>
                    <p class="text-muted mb-0 font-size-12">Silakan isi rincian barang/jasa. Total akan dihitung otomatis.
                    </p>
                </div>
                <div class="card-body">

                    <form action="" method="POST">
                        @csrf

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle" id="table-rincian">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" style="width: 50px">No</th> {{-- Kolom Nomor Baru --}}
                                        <th style="width: 40%">Uraian / Nama Barang</th>
                                        <th style="width: 20%">Harga Satuan (Rp)</th>
                                        <th style="width: 10%">Jumlah (Qty)</th>
                                        <th style="width: 20%">Subtotal (Rp)</th>
                                        <th style="width: 10%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="rincian-container">
                                    {{-- Baris Pertama (Default) --}}
                                    <tr>
                                        <td class="text-center row-number">1</td> {{-- Angka 1 Statis --}}
                                        <td>
                                            <input type="text" name="keterangan[]" class="form-control"
                                                placeholder="Contoh: Sewa Gedung" required>
                                        </td>
                                        <td>
                                            <input type="number" name="harga[]" class="form-control input-harga"
                                                placeholder="0" min="0" required>
                                        </td>
                                        <td>
                                            <input type="number" name="qty[]" class="form-control input-qty"
                                                placeholder="1" min="1" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control input-subtotal bg-light"
                                                placeholder="0" readonly>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-sm btn-hapus" disabled>
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Grand Total Anggaran:</td>
                                        <td colspan="2">
                                            <input type="hidden" name="total_anggaran_final" id="grand_total_input">
                                            <h4 class="text-primary mb-0 fw-bold" id="grand_total_display">Rp 0</h4>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-info" id="btn-tambah-baris">
                                <i class="bx bx-plus"></i> Tambah Item
                            </button>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bx bx-save"></i> Simpan & Update Anggaran
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT JAVASCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('rincian-container');
            const btnTambah = document.getElementById('btn-tambah-baris');
            const grandTotalDisplay = document.getElementById('grand_total_display');
            const grandTotalInput = document.getElementById('grand_total_input');

            // Fungsi Format Rupiah
            const formatRupiah = (number) => {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(number);
            }

            // Fungsi Hitung Total
            const calculateGrandTotal = () => {
                let total = 0;
                const rows = container.querySelectorAll('tr');

                rows.forEach(row => {
                    const harga = parseFloat(row.querySelector('.input-harga').value) || 0;
                    const qty = parseFloat(row.querySelector('.input-qty').value) || 0;
                    const subtotal = harga * qty;

                    // Update kolom subtotal per baris
                    row.querySelector('.input-subtotal').value = formatRupiah(subtotal);

                    total += subtotal;
                });

                // Update Grand Total di Footer
                grandTotalDisplay.innerText = formatRupiah(total);
                grandTotalInput.value = total;
            };

            // Fungsi Update Nomor Urut (Re-indexing)
            const updateRowNumbers = () => {
                const rows = container.querySelectorAll('tr');
                rows.forEach((row, index) => {
                    // Mengupdate text di kolom nomor (index dimulai dari 0, jadi ditambah 1)
                    row.querySelector('.row-number').innerText = index + 1;
                });
            };

            // Event Listener: Input Harga/Qty berubah
            container.addEventListener('input', function(e) {
                if (e.target.classList.contains('input-harga') || e.target.classList.contains(
                        'input-qty')) {
                    calculateGrandTotal();
                }
            });

            // Event Listener: Tombol Tambah Baris
            btnTambah.addEventListener('click', function() {
                const newRow = document.createElement('tr');
                // Kita kosongkan dulu nomornya, nanti diisi oleh updateRowNumbers()
                newRow.innerHTML = `
                <td class="text-center row-number"></td> 
                <td><input type="text" name="keterangan[]" class="form-control" required></td>
                <td><input type="number" name="harga[]" class="form-control input-harga" min="0" required></td>
                <td><input type="number" name="qty[]" class="form-control input-qty" min="1" value="1" required></td>
                <td><input type="text" class="form-control input-subtotal bg-light" readonly></td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm btn-hapus">
                        <i class="bx bx-trash"></i>
                    </button>
                </td>
            `;
                container.appendChild(newRow);
                updateRowNumbers(); // Update nomor setelah tambah
            });

            // Event Listener: Tombol Hapus Baris
            container.addEventListener('click', function(e) {
                if (e.target.closest('.btn-hapus')) {
                    const row = e.target.closest('tr');
                    if (container.querySelectorAll('tr').length > 1) {
                        row.remove();
                        updateRowNumbers(); // Update nomor setelah hapus
                        calculateGrandTotal(); // Hitung ulang total
                    } else {
                        alert("Minimal harus ada satu rincian.");
                    }
                }
            });
        });
    </script>
@endsection
