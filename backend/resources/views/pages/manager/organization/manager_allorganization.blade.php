@extends('layouts.manager_app')
@section('title', 'All Ormawa')
@section('content')

    <div id="layout-wrapper">
        <div class="main-content p-0 m-0 ">
            <div class="page-content p-0">
                <div class="container-fluid">

                    <!--- PESAN SUKSES --->
                    @if (@session('success'))
                        <div class="alert alert-success alert-dismible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dimiss="alert" aria-label="Close">
                        </div>
                        @endsession

                        <!--- Start Page Title --->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">All Ormawa</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Organization</a></li>
                                            <li class="breadcrumb-item active">All Ormawa</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--- End Page Title  --->

                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h4 class="card-title">Ormawa List <span class="text-muted fw-normal ms-2">(834)</span>
                                    </h4>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                                    <div>
                                        <a href="{{ route('manager.organization.create') }}" class="btn btn-primary">
                                            <i class="bx bx-plus me-1"></i> Add New</a>
                                    </div>

                                    <div class="dropdown">
                                        <a class="btn btn-link text-muted py-1 font-size-16 shadow-none dropdown-toggle"
                                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-horizontal-rounded"></i>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--- End Row --->

                        <div class="row mt-3">
                            {{-- LOOPING DATA ORMAWAAAAAAAAAAAA --}}
                            @forelse($organizations as $org)
                                <div class="col-xl-3 col-sm-6 mb-3">
                                    <div class="card text-center">
                                        <div class="card-body">

                                            <div class="dropdown text-end">
                                                <a class="text-muted dropdown-toggle font-size-16" href="#"
                                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Remove</a>
                                                </div>
                                            </div>

                                            <!--- LOGO SECTION --->
                                            <div class="mx-auto mb-4">
                                                @if ($org->logo)
                                                    <img src="{{ asset('storage/' . $org->logo) }}"
                                                        alt="{{ $org->name }}"
                                                        class="avatar-xl rounded-circle img-thumbnail">
                                                @else
                                                    <div class="avatar-xl mx-auto">
                                                        <div
                                                            class="avatar-title bg-light-subtle text-primary display-4 m-0 rounded-circle">
                                                            <i class="bx bxs-user-circle"></i>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <h5 class="font-size-16 mb-1"><a href="#"
                                                    class="text-body">{{ $org->name }}</a>
                                            </h5>
                                            <p class="text-muted mb-2">{{ $org->deskripsi }}</p>
                                        </div>

                                        <div class="btn-group" role="group">
                                            <a href="{{ route('manager.organization.profile', $org->id) }}">
                                                <button type="button" class="btn btn-outline-light text-truncate"><i
                                                        class="uil uil-user me-1"></i> Profile</button></a>
                                        </div>
                                    </div>
                                    <!--- End Card --->
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <h5>No organizations found.</h5>
                                </div>
                            @endforelse
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
