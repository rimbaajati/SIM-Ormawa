@extends('layouts.manager_app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Manager Dashboard</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                    <li class="breadcrumb-item active">Manager</li>
                </ol>
            </div>

            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Pengajuan</h6>
                <h3>{{ $totalPengajuan ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Menunggu Verifikasi</h6>
                <h3 class="text-warning">{{ $pending ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Disetujui</h6>
                <h3 class="text-success">{{ $approved ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Ditolak</h6>
                <h3 class="text-danger">{{ $rejected ?? 0 }}</h3>
            </div>
        </div>
    </div>

</div>

<div class="row mt-4">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <h6>Statistik Status Pengajuan</h6>
            </div>
            <div class="card-body">
                <div id="chart-status"></div>
                {{-- Di sini tempat Anda menginisialisasi Chart JavaScript Anda menggunakan data dari Controller --}}
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h6>Aksi Cepat</h6>
            </div>
            <div class="card-body d-grid gap-2">
                <a href="/proposals/create" class="btn btn-primary">Ajukan Kegiatan</a>
                <a href="/proposals" class="btn btn-info">Lihat Proposal</a>
                <a href="/users" class="btn btn-warning">Kelola User</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h6>Pengajuan Terbaru</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kegiatan</th>
                            <th>Ormawa</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($recentProposals as $index => $proposal)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $proposal->activity_name }}</td>
                            <td>{{ $proposal->ormawa->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($proposal->date)->format('d M Y') }}</td>
                            <td>
                                @if($proposal->status == 'pending')
                                    <span class="badge bg-warning">Menunggu</span>
                                @elseif($proposal->status == 'approved')
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif($proposal->status == 'rejected')
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td><a href="/proposals/{{ $proposal->id }}" class="btn btn-sm btn-primary">Lihat</a></td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data pengajuan terbaru.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('chart-status').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'pie',  // Jenis chart: pie (bisa diganti ke 'bar', 'line', dll.)
            data: {
                labels: ['Menunggu Verifikasi', 'Disetujui', 'Ditolak'],  // Label sesuai view
                datasets: [{
                    data: [{{ $statusData['pending'] ?? 0 }}, {{ $statusData['approved'] ?? 0 }}, {{ $statusData['rejected'] ?? 0 }}],  // Data dari controller
                    backgroundColor: ['#ffc107', '#28a745', '#dc3545'],  // Warna sesuai badge di view
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    });
</script>
@endpush