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
                    {{-- Header Proposal: Judul & Status & Tombol Edit --}}
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h3 class="card-title text-primary mb-1">{{ $proposal->judul }}</h3>
                            <p class="text-muted mb-0">ID Proposal: <strong>{{ $proposal->id_proposal }}</strong></p>
                        </div>
                        <div class="d-flex gap-2">
                            {{-- TOMBOL EDIT DATA (Hanya muncul jika proposal BELUM disetujui/ditolak, atau tergantung kebijakan) --}}
                            <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal"
                                data-bs-target="#modalEditData">
                                <i class="bx bx-edit"></i> Edit Data
                            </button>

                            {{-- Badge Status --}}
                            @if ($proposal->status == 'approved')
                                <span class="badge bg-success fs-6 py-2">Disetujui</span>
                            @elseif($proposal->status == 'rejected')
                                <span class="badge bg-danger fs-6 py-2">Ditolak</span>
                            @elseif($proposal->status == 'revision')
                                <span class="badge bg-info fs-6 py-2">Revisi</span>
                            @else
                                <span class="badge bg-warning fs-6 py-2">Menunggu</span>
                            @endif
                        </div>
                    </div>

                    <hr>

                    {{-- Detail Informasi --}}
                    <div class="row">
                        {{-- Kolom Kiri --}}
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">Organisasi</th>
                                    <td>: {{ $proposal->organization->name ?? 'Organisasi Tidak Ditemukan' }}</td>
                                </tr>
                                <tr>
                                    <th>Diajukan Oleh (User ID)</th>
                                    <td>: {{ $proposal->id_user }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Diajukan</th>
                                    <td>: {{ \Carbon\Carbon::parse($proposal->created_at)->format('d M Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Waktu Kegiatan</th>
                                    <td>:
                                        {{ \Carbon\Carbon::parse($proposal->waktu_mulai)->format('d M Y') }}
                                        s.d.
                                        {{ \Carbon\Carbon::parse($proposal->waktu_selesai)->format('d M Y') }}
                                    </td>
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
                                        @if ($proposal->file_proposal)
                                            :
                                            <div class="d-inline-flex">
                                                {{-- TOMBOL 1: LIHAT (Preview di Tab Baru) --}}
                                                <a href="{{ asset('storage/' . $proposal->file_proposal) }}" target="_blank"
                                                    class="btn btn-sm btn-info text-white mr-1 me-1"> {{-- mr-1/me-1 untuk jarak --}}
                                                    <i class="bx bx-show"></i> Lihat
                                                </a>

                                                {{-- TOMBOL 2: DOWNLOAD --}}
                                                <a href="{{ asset('storage/' . $proposal->file_proposal) }}" download
                                                    class="btn btn-sm btn-primary">
                                                    <i class="bx bx-download"></i> Download
                                                </a>

                                            </div>
                                        @else
                                            : <span class="text-muted font-italic">Tidak ada file</span>
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

                    {{-- Tombol Back --}}
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
                    <form action="{{ route('manager.proposal.update_budget', $proposal->id) }}" method="POST">
                        @csrf

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle" id="table-rincian">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" style="width: 50px">No</th>
                                        <th style="width: 40%">Uraian / Nama Barang</th>
                                        <th style="width: 20%">Harga Satuan (Rp)</th>
                                        <th style="width: 10%">Jumlah (Qty)</th>
                                        <th style="width: 20%">Subtotal (Rp)</th>
                                        <th style="width: 10%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="rincian-container">
                                    {{-- CEK: Apakah sudah ada data rincian di database? --}}
                                    @if ($proposal->budgets->count() > 0)

                                        {{-- JIKA ADA DATA: Looping data dari database ke dalam INPUT --}}
                                        @foreach ($proposal->budgets as $item)
                                            <tr>
                                                <td class="text-center row-number"></td> {{-- Nanti diisi otomatis oleh JS --}}
                                                <td>
                                                    <input type="text" name="nama_barang[]" class="form-control"
                                                        value="{{ $item->nama_barang }}" placeholder="Contoh: Sewa Gedung"
                                                        required>
                                                </td>
                                                <td>
                                                    {{-- value diisi dari database --}}
                                                    <input type="number" name="harga[]" class="form-control input-harga"
                                                        value="{{ $item->harga }}" placeholder="0" min="0"
                                                        required>
                                                </td>
                                                <td>
                                                    {{-- value diisi dari database --}}
                                                    <input type="number" name="jumlah[]" class="form-control input-qty"
                                                        value="{{ $item->jumlah }}" placeholder="1" min="1"
                                                        required>
                                                </td>
                                                <td>
                                                    {{-- Subtotal hitungan awal (tampilan saja) --}}
                                                    <input type="text" class="form-control input-subtotal bg-light"
                                                        value="Rp {{ number_format($item->subtotal, 0, ',', '.') }}"
                                                        readonly>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger btn-sm btn-hapus">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center row-number">1</td>
                                            <td>
                                                <input type="text" name="nama_barang[]" class="form-control"
                                                    placeholder="Contoh: Sewa Gedung" required>
                                            </td>
                                            <td>
                                                <input type="number" name="harga[]" class="form-control input-harga"
                                                    placeholder="0" min="0" required>
                                            </td>
                                            <td>
                                                <input type="number" name="jumlah[]" class="form-control input-qty"
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

                                    @endif
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
                        {{-- Card Import Excel --}}
                        <div class="card mt-4 mb-3">
                            <div class="card-body bg-soft-primary">
                                <h5 class="card-title text-primary"><i class="mdi mdi-microsoft-excel"></i> Import
                                    Anggaran via Excel</h5>
                                <p class="card-text text-muted mb-3">
                                    Gunakan fitur ini untuk upload banyak data sekaligus.
                                    <a href="{{ route('manager.proposal.download_template') }}"
                                        class="fw-bold text-decoration-underline">Download Template Disini</a>.
                                </p>

                                <form action="{{ route('manager.proposal.import_budget', $proposal->id) }}"
                                    method="POST" enctype="multipart/form-data" class="row align-items-end">
                                    @csrf

                                    <div class="col-md-8">
                                        <label for="file_excel" class="form-label fw-bold">Pilih File (.xlsx /
                                            .xls)</label>
                                        <input type="file" class="form-control" name="file_excel" id="file_excel"
                                            required>
                                    </div>

                                    <div class="col-md-4 mt-2 mt-md-0">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="bx bx-upload"></i> Upload & Proses
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- CONTAINER AKSI REAKSI ! --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="bx bx-cog"></i> Update Status Pengajuan</h5>

                    @if ($proposal->status == 'pending')
                        <p class="text-muted mb-3">Tentukan keputusan untuk proposal ini:</p>
                        <div class="d-flex gap-2 flex-wrap">

                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#modalApprove">
                                <i class="bx bx-check-circle me-1"></i> Setujui
                            </button>

                            <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal"
                                data-bs-target="#modalRevision">
                                <i class="bx bx-edit me-1"></i> Minta Revisi
                            </button>

                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#modalReject">
                                <i class="bx bx-x-circle me-1"></i> Tolak
                            </button>
                        </div>
                    @else
                        <div
                            class="alert alert-{{ $proposal->status == 'approved' ? 'success' : ($proposal->status == 'revision' ? 'warning' : 'danger') }} mb-0">
                            <div class="d-flex align-items-center">
                                <i class="bx bx-info-circle me-2 fs-4"></i>
                                <div>
                                    <strong>Status Proposal:</strong> {{ strtoupper($proposal->status) }}
                                    @if ($proposal->catatan_revisi)
                                        <div class="mt-2 p-2 bg-white bg-opacity-50 rounded">
                                            <strong>Catatan Manager:</strong><br>
                                            {{ $proposal->catatan_revisi }}
                                        </div>
                                    @endif
                                    <div class="mt-1 small opacity-75">
                                        Diproses pada: {{ $proposal->updated_at->format('d M Y, H:i') }} WIB
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- 1. MODAL APPROVE --}}
    <div class="modal fade" id="modalApprove" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                {{-- Form mengarah ke Route manager.proposal.action --}}
                <form action="{{ route('manager.proposal.action', $proposal->id) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- Method PUT untuk Update --}}
                    <input type="hidden" name="action" value="approved">

                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Persetujuan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center py-4">
                        <i class="bx bx-check-circle text-success display-1 mb-3"></i>
                        <p class="mb-1">Apakah Anda yakin ingin menyetujui proposal ini?</p>
                        <h5 class="text-primary">{{ $proposal->judul }}</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Ya, Setujui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- 2. MODAL REVISION --}}
    <div class="modal fade" id="modalRevision" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('manager.proposal.action', $proposal->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="action" value="revision">

                    <div class="modal-header">
                        <h5 class="modal-title text-warning">Permintaan Revisi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning">
                            <i class="bx bx-info-circle me-1"></i> Status proposal akan berubah menjadi Revisi.
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Catatan Revisi (Wajib Diisi)</label>
                            <textarea name="catatan" class="form-control" rows="5" required
                                placeholder="Tuliskan bagian mana yang perlu diperbaiki..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning text-white">Kirim Revisi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- 3. MODAL REJECT --}}
    <div class="modal fade" id="modalReject" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('manager.proposal.action', $proposal->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="action" value="rejected">

                    <div class="modal-header">
                        <h5 class="modal-title text-danger">Tolak Proposal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger">
                            <i class="bx bx-error me-1"></i> Proposal akan ditolak permanen.
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Alasan Penolakan (Wajib Diisi)</label>
                            <textarea name="catatan" class="form-control" rows="5" required
                                placeholder="Jelaskan alasan kenapa proposal ini ditolak..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Tolak Proposal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="mb-4 d-flex justify-content-end">
        <a href="{{ route('manager.proposal.all') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back me-1"></i> Kembali
        </a>
    </div>

    </div> {{-- End card-body --}}
    </div> {{-- End card --}}
    </div>
    </div>

    {{-- JANGAN LUPA: KODE MODAL (Approve, Revisi, Reject) HARUS TETAP ADA DI BAWAH SINI --}}

    {{-- SCRIPT JAVASCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Definisi Elemen DOM
            const container = document.getElementById('rincian-container');
            const btnTambah = document.getElementById('btn-tambah-baris');
            const grandTotalDisplay = document.getElementById('grand_total_display');
            const grandTotalInput = document.getElementById('grand_total_input');

            // 2. Fungsi Format Rupiah (IDR)
            const formatRupiah = (number) => {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(number);
            }

            // 3. Fungsi Hitung Total (Grand Total & Subtotal per baris)
            const calculateGrandTotal = () => {
                let total = 0;
                const rows = container.querySelectorAll('tr');

                rows.forEach(row => {
                    // Ambil elemen input
                    const hargaInput = row.querySelector('.input-harga');
                    const qtyInput = row.querySelector('.input-qty');
                    const subtotalInput = row.querySelector('.input-subtotal');

                    // Ambil nilai (jika kosong/NaN, anggap 0)
                    const harga = parseFloat(hargaInput.value) || 0;
                    const qty = parseFloat(qtyInput.value) || 0;

                    // Hitung Subtotal
                    const subtotal = harga * qty;

                    // Tampilkan Subtotal di input readonly (Format Rupiah)
                    if (subtotalInput) {
                        subtotalInput.value = formatRupiah(subtotal);
                    }

                    // Tambahkan ke Grand Total
                    total += subtotal;
                });

                // Update Tampilan Grand Total (Teks Rp ...)
                if (grandTotalDisplay) {
                    grandTotalDisplay.innerText = formatRupiah(total);
                }

                // Update Input Hidden Grand Total (Angka Murni untuk dikirim ke Controller)
                if (grandTotalInput) {
                    grandTotalInput.value = total;
                }
            };

            // 4. Fungsi Update Nomor Urut
            const updateRowNumbers = () => {
                const rows = container.querySelectorAll('tr');
                rows.forEach((row, index) => {
                    const numberCell = row.querySelector('.row-number');
                    if (numberCell) {
                        numberCell.innerText = index + 1;
                    }
                });
            };

            // 5. Event Listener: Deteksi Perubahan Input (Harga / Qty)
            // Menggunakan 'input' agar real-time saat diketik
            container.addEventListener('input', function(e) {
                if (e.target.classList.contains('input-harga') || e.target.classList.contains(
                        'input-qty')) {
                    calculateGrandTotal();
                }
            });

            // 6. Event Listener: Tombol Tambah Baris
            if (btnTambah) {
                btnTambah.addEventListener('click', function() {
                    const newRow = document.createElement('tr');

                    // --- PERUBAHAN PENTING DI SINI ---
                    // name="keterangan[]" -> diganti jadi name="nama_barang[]"
                    // name="qty[]"        -> diganti jadi name="jumlah[]"
                    // Class "input-qty" tetap dibiarkan untuk selektor JavaScript
                    newRow.innerHTML = `
                    <td class="text-center row-number"></td> 
                    <td>
                        <input type="text" name="nama_barang[]" class="form-control" placeholder="Nama Barang..." required>
                    </td>
                    <td>
                        <input type="number" name="harga[]" class="form-control input-harga" min="0" placeholder="0" required>
                    </td>
                    <td>
                        <input type="number" name="jumlah[]" class="form-control input-qty" min="1" value="1" required>
                    </td>
                    <td>
                        <input type="text" class="form-control input-subtotal bg-light" readonly>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm btn-hapus">
                            <i class="bx bx-trash"></i>
                        </button>
                    </td>
                `;
                    container.appendChild(newRow);
                    updateRowNumbers(); // Update nomor urut
                    calculateGrandTotal(); // Hitung ulang (opsional)
                });
            }

            // 7. Event Listener: Tombol Hapus Baris
            container.addEventListener('click', function(e) {
                // Cek apakah elemen yang diklik adalah tombol hapus atau icon di dalamnya
                if (e.target.closest('.btn-hapus')) {
                    const row = e.target.closest('tr');

                    // Cegah penghapusan jika hanya sisa 1 baris
                    if (container.querySelectorAll('tr').length > 1) {
                        row.remove();
                        updateRowNumbers(); // Susun ulang nomor
                        calculateGrandTotal(); // Hitung ulang total
                    } else {
                        alert("Minimal harus ada satu baris rincian.");
                    }
                }
            });

            // --- INISIALISASI ---
            // Jalankan fungsi ini sekali saat halaman baru dibuka
            updateRowNumbers();
            calculateGrandTotal();
        });
    </script>
@endsection
