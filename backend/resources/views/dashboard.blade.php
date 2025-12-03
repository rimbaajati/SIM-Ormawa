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

    <!-- ===== SUMMARY CARDS ===== -->
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

<!-- ===== GRAFIK ===== -->
<div class="row mt-4">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <h6>Statistik Status Pengajuan</h6>
            </div>
            <div class="card-body">
                <div id="chart-status"></div>
            </div>
        </div>
    </div>

    <!-- ===== QUICK ACTION ===== -->
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
                                <span class="badge bg-{{ 
                                    $item->status == 'approved' ? 'success' :
                                    ($item->status == 'pending' ? 'warning' : 'danger') 
                                }}">
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
