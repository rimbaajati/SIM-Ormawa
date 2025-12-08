@extends('layouts.manager_app')

@section('title', 'Kelola Periode Kepengurusan')

@section('content')
    <div class="page-title-box d-flex align-items-center justify-content-between">
        <h4 class="mb-0">Periode Kepengurusan</h4>
        <div class="page-title-right">
            {{-- Tombol Trigger Modal --}}
            <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                data-bs-target="#addPeriodModal">
                <i class="bx bx-plus me-1"></i> Tambah Periode
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- Alert Sukses/Gagal (Opsional, jika controller pakai with('success')) --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bx bx-check-circle me-1"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bx bx-error me-1"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive nowrap w-100 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Nama Periode</th>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                    <th>Status</th>
                                    <th style="width: 15%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($periods as $period)
                                    {{-- Baris hijau jika aktif --}}
                                    <tr class="{{ $period->is_active ? 'table-success' : '' }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="fw-bold">{{ $period->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($period->start_date)->format('d M Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($period->end_date)->format('d M Y') }}</td>
                                        <td>
                                            @if ($period->is_active)
                                                <span class="badge bg-success font-size-12">
                                                    <i class="bx bx-check-double me-1"></i> AKTIF
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">Non-Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                {{-- 1. Tombol Edit --}}
                                                <a href="{{ route('manager.period.edit', $period->id) }}"
                                                    class="btn btn-warning btn-sm" title="Edit Data">
                                                    <i class="bx bx-edit"></i>
                                                </a>

                                                {{-- 2. Tombol Aktifkan (Hanya muncul jika TIDAK aktif) --}}
                                                @if (!$period->is_active)
                                                    <form action="{{ route('manager.period.activate', $period->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success btn-sm"
                                                            title="Set Aktif">
                                                            <i class="bx bx-power-off"></i>
                                                        </button>
                                                    </form>

                                                    {{-- 3. Tombol Hapus (Hanya muncul jika TIDAK aktif untuk keamanan) --}}
                                                    <button type="button" class="btn btn-danger btn-sm" title="Hapus Data"
                                                        onclick="confirmDeletePeriod({{ $period->id }})">
                                                        <i class="bx bx-trash"></i>
                                                    </button>

                                                    {{-- Form Hapus Tersembunyi --}}
                                                    <form id="delete-period-{{ $period->id }}"
                                                        action="{{ route('manager.period.destroy', $period->id) }}"
                                                        method="POST" style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="bx bx-calendar-x display-4 mb-2"></i>
                                                <p>Belum ada data periode.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH DATA (SUDAH DIPERBAIKI) --}}
    <div class="modal fade" id="addPeriodModal" tabindex="-1" aria-labelledby="addPeriodModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPeriodModalLabel">Tambah Periode Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                {{-- PERBAIKAN: Action mengarah ke STORE, bukan ACTIVATE --}}
                <form action="{{ route('manager.period.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Periode</label>
                            <input type="text" name="name" class="form-control" placeholder="Contoh: 2024/2025"
                                required>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label">Tanggal Mulai</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Tanggal Selesai</label>
                                <input type="date" name="end_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="isActive" name="is_active" value="1">
                            <label class="form-check-label" for="isActive">Set sebagai Periode Aktif?</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- SCRIPT DELETE SWEETALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDeletePeriod(id) {
            Swal.fire({
                title: 'Hapus Periode?',
                text: "Data yang terkait (Ketua, Visi, Misi pada tahun ini) akan ikut terhapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-period-' + id).submit();
                }
            })
        }
    </script>
@endsection
