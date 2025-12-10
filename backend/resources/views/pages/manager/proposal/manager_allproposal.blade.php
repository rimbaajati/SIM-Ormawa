@extends('layouts.manager_app')
@section('title', 'All Proposals')
@section('content')

    <div class="page-title-box d-flex align-items-center justify-content-between">
        <h4 class="mb-0">All Proposals</h4>
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item">Proposal</li>
            <li class="breadcrumb-item active">All Proposals</li>
        </ol>
    </div>

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Proposal Kegiatan</h5>
            <span class="badge bg-primary">{{ count($proposals ?? []) }} Total</span>
        </div>

        <div class="card-body">

            <!-- FILTER -->
            <form method="GET" action="{{ route('manager.proposal.all') }}" class="row g-2 mb-3">
                <div class="col-md-3">
                    <select name="status" class="form-control">
                        <option value="">-- All Status --</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                        <option value="revision">Revision</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search by activity name...">
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100">
                        <i data-feather="search"></i> Filter
                    </button>
                </div>

                <div class="col-md-2 ms-auto">
                    <a href="{{ route('manager.proposal.create') }}" class="btn btn-primary w-100">
                        <i data-feather="plus"></i> Create
                    </a>
                </div>
            </form>

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>Nomor Proposal</th>
                            <th>Kegiatan</th>
                            <th>Organisasi</th>
                            <th>Waktu</th>
                            <th>Anggaran</th>
                            <th>Status Pengajuan</th>
                            <th width="220">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($proposals as $proposal)
                            <tr>
                                <td>{{ $proposal->id_proposal }}</td>
                                <td>{{ $proposal->judul }}</td>
                                <td>{{ $proposal->organization->name ?? 'Organisasi Tidak Ditemukan' }}</td>
                                <td>
                                    <div>
                                        {{ \Carbon\Carbon::parse($proposal->waktu_mulai)->format('d M Y, H:i') }} WIB
                                    </div>
                                    <div class="text-muted small">s/d</div>
                                    <div>
                                        {{ \Carbon\Carbon::parse($proposal->waktu_selesai)->format('d M Y, H:i') }} WIB
                                    </div>
                                </td>
                                <td>Rp {{ number_format($proposal->anggaran, 0, ',', '.') }}</td>
                                <td>
                                    <span
                                        class="badge bg-{{ $proposal->status == 'approved'
                                            ? 'success'
                                            : ($proposal->status == 'pending'
                                                ? 'warning'
                                                : ($proposal->status == 'revision'
                                                    ? 'info'
                                                    : 'danger')) }}">
                                        {{ ucfirst($proposal->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('manager.proposal.detail', $proposal->id_proposal) }}"
                                        class="btn btn-sm btn-info">
                                        Detail
                                    </a>

                                    @if ($proposal->status == 'pending')
                                        <a href="" class="btn btn-sm btn-success">
                                            Approve
                                        </a>

                                        <a href="" class="btn btn-sm btn-danger">
                                            Reject
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No proposals found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>


        </div>
    </div>

@endsection
