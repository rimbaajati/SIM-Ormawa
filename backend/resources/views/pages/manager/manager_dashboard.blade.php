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

        <div class="row">

            <!-- Total Pengajuan -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-7">
                                <span class="text-muted mb-2 d-block">Total Pengajuan</span>
                                <h4 class="mb-0">
                                    <span class="counter-value" data-target="120">0</span>
                                </h4>
                            </div>

                            <div class="col-5">
                                <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts"></div>
                            </div>
                        </div>
                        <span class="badge bg-primary-subtle text-primary">+12</span>
                        <span class="text-muted ms-1 font-size-12">Bulan ini</span>
                    </div>
                </div>
            </div>

            <!-- Menunggu Verifikasi -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-7">
                                <span class="text-muted mb-2 d-block">Menunggu Verifikasi</span>
                                <h4 class="mb-0">
                                    <span class="counter-value" data-target="32">0</span>
                                </h4>
                            </div>
                            <div class="col-5">
                                <div id="mini-chart2" data-colors='["#fa896b"]' class="apex-charts"></div>
                            </div>
                        </div>
                        <span class="badge bg-warning-subtle text-warning">+5</span>
                        <span class="text-muted ms-1 font-size-12">Pengajuan baru</span>
                    </div>
                </div>
            </div>

            <!-- Disetujui -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-7">
                                <span class="text-muted mb-2 d-block">Disetujui</span>
                                <h4 class="mb-0">
                                    <span class="counter-value" data-target="76">0</span>
                                </h4>
                            </div>
                            <div class="col-5">
                                <div id="mini-chart3" data-colors='["#34c38f"]' class="apex-charts"></div>
                            </div>
                        </div>
                        <span class="badge bg-success-subtle text-success">+3</span>
                        <span class="text-muted ms-1 font-size-12">Bulan ini</span>
                    </div>
                </div>
            </div>

            <!-- Ditolak -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-7">
                                <span class="text-muted mb-2 d-block">Ditolak</span>
                                <h4 class="mb-0">
                                    <span class="counter-value" data-target="14">0</span>
                                </h4>
                            </div>
                            <div class="col-5">
                                <div id="mini-chart4" data-colors='["#f46a6a"]' class="apex-charts"></div>
                            </div>
                        </div>
                        <span class="badge bg-danger-subtle text-danger">+1</span>
                        <span class="text-muted ms-1 font-size-12">Bulan ini</span>
                    </div>
                </div>
            </div>

        </div>


    </div>

    <!-- ===== GRAFIK ===== -->

    <div class="row mt-4">

        <!-- ===== CHART STATISTIK ===== -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 text- fw-bold" style="color:#ff6600;">Statistik Pengajuan (1 Tahun)</h6>
                    <span class="text-muted small">{{ now()->year }}</span>
                </div>

                <div class="card-body p-4">
                    <div id="chart-status" style="min-height: 350px;"></div>

                    <!-- Custom Legend -->
                    <div class="mt-4 d-flex justify-content-around">

                        <div class="text-center">
                            <span class="badge px-3 py-2" style="background:#e6f7f1;color:#34c38f;">
                                Disetujui
                            </span>
                            <h5 class="mt-2 fw-bold" style="color:#34c38f;">120</h5>
                        </div>

                        <div class="text-center">
                            <span class="badge px-3 py-2" style="background:#fff3cd;color:#f1b44c;">
                                Diproses
                            </span>
                            <h5 class="mt-2 fw-bold" style="color:#f1b44c;">45</h5>
                        </div>

                        <div class="text-center">
                            <span class="badge px-3 py-2" style="background:#fdecea;color:#f46a6a;">
                                Ditolak
                            </span>
                            <h5 class="mt-2 fw-bold" style="color:#f46a6a;">32</h5>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- ===== QUICK ACTION ===== -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-bottom">
                    <h6 class="mb-0 fw-bold" style="color:#ff6600;">Aksi Cepat</h6>
                </div>

                <div class="card-body d-grid gap-3">

                    <a href="/proposals/create" class="btn d-flex align-items-center gap-2"
                        style="background:#5156be;color:white;">
                        <i class="mdi mdi-plus-circle-outline fs-5"></i> Ajukan Kegiatan
                    </a>

                    <a href="/proposals" class="btn d-flex align-items-center gap-2"
                        style="background:#556ee6;color:white;">
                        <i class="mdi mdi-file-document-outline fs-5"></i> Lihat Proposal
                    </a>

                    <a href="/users" class="btn d-flex align-items-center gap-2"
                        style="background:#f1b44c;color:white;">
                        <i class="mdi mdi-account-cog-outline fs-5"></i> Kelola User
                    </a>

                </div>
            </div>
        </div>

    </div>

    <!-- ================= SCRIPT CHART (DILUAR GRID) ================= -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            var options = {
                series: [120, 45, 32],
                chart: {
                    height: 350,
                    type: 'donut',
                },
                labels: ["Disetujui", "Diproses", "Ditolak"],
                colors: [
                    '#34c38f', // hijau - approved
                    '#f1b44c', // kuning - process
                    '#f46a6a' // merah - rejected
                ],
                plotOptions: {
                    pie: {
                        donut: {
                            size: '78%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total',
                                    fontSize: '18px',
                                    fontWeight: 'bold',
                                    formatter: () => 120 + 45 + 32
                                }
                            }
                        }
                    }
                },
                stroke: {
                    width: 0,
                },
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart-status"), options);
            chart.render();
        });
    </script>


    <!-- ===== TABLE PENGAJUAN TERBARU ===== -->
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
                            @forelse($latestPengajuan ?? [] as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_kegiatan }}</td>
                                    <td>{{ $item->organization->name ?? '-' }}</td>
                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $item->status == 'approved' ? 'success' : ($item->status == 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="/proposals/{{ $item->id }}" class="btn btn-sm btn-primary">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada pengajuan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
@endsection

@push('js')
    <script>
        var options = {
            series: [{
                name: 'Jumlah',
                data: [
                    {{ $pending ?? 0 }},
                    {{ $approved ?? 0 }},
                    {{ $rejected ?? 0 }}
                ]
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            xaxis: {
                categories: ['Pending', 'Approved', 'Rejected']
            }
        };

        var chart = new ApexCharts(
            document.querySelector("#chart-status"),
            options
        );
        chart.render();
    </script>
@endpush
=======

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
>>>>>>> 6685c1a7c51705e86f36864ff5180a4852fb1fa0
