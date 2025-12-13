@extends('layouts.manager_app')

@section('title', 'Surat & Permohonan')

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Email Inbox</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Email</a></li>
                                    <li class="breadcrumb-item active">Email Inbox</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <!-- Left sidebar -->
                        <div class="email-leftbar card">
                            <button type="button" class="btn btn-danger w-100 waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target="#composemodal">
                                Compose
                            </button>
                            <div class="mail-list mt-4">
                                <a href="#" class="active"><i class="mdi mdi-email-outline me-2"></i> Inbox <span
                                        class="ms-1 float-end">(18)</span></a>
                                <a href="#"><i class="mdi mdi-star-outline me-2"></i>Starred</a>
                                <a href="#"><i class="mdi mdi-diamond-stone me-2"></i>Important</a>
                                <a href="#"><i class="mdi mdi-file-outline me-2"></i>Draft</a>
                                <a href="#"><i class="mdi mdi-email-check-outline me-2"></i>Sent Mail</a>
                                <a href="#"><i class="mdi mdi-trash-can-outline me-2"></i>Trash</a>
                            </div>

                            <h6 class="mt-4">Labels</h6>

                            <div class="mail-list mt-1">
                                <a href="#"><span
                                        class="mdi mdi-arrow-right-drop-circle text-info float-end"></span>Theme Support</a>
                                <a href="#"><span
                                        class="mdi mdi-arrow-right-drop-circle text-warning float-end"></span>Freelance</a>
                                <a href="#"><span
                                        class="mdi mdi-arrow-right-drop-circle text-primary float-end"></span>Social</a>
                                <a href="#"><span
                                        class="mdi mdi-arrow-right-drop-circle text-danger float-end"></span>Friends</a>
                                <a href="#"><span
                                        class="mdi mdi-arrow-right-drop-circle text-success float-end"></span>Family</a>
                            </div>

                            <h6 class="mt-4">Chat</h6>

                            <div class="mt-2">
                                <a href="javascript: void(0);" class="d-flex align-items-start">
                                    <img class="flex-shrink-0 me-3 rounded-circle" src="assets/images/users/avatar-2.jpg"
                                        alt="Generic placeholder image" height="36">
                                    <div class="flex-grow-1 chat-user-box">
                                        <p class="user-title m-0">Scott Median</p>
                                        <p class="text-muted">Hello</p>
                                    </div>
                                </a>

                                <a href="javascript: void(0);" class="d-flex align-items-start">
                                    <img class="flex-shrink-0 me-3 rounded-circle" src="assets/images/users/avatar-3.jpg"
                                        alt="Generic placeholder image" height="36">
                                    <div class="flex-grow-1 chat-user-box">
                                        <p class="user-title m-0">Julian Rosa</p>
                                        <p class="text-muted">What about our next..</p>
                                    </div>
                                </a>

                                <a href="javascript: void(0);" class="d-flex align-items-start">
                                    <img class="flex-shrink-0 me-3 rounded-circle" src="assets/images/users/avatar-4.jpg"
                                        alt="Generic placeholder image" height="36">
                                    <div class="flex-grow-1 chat-user-box">
                                        <p class="user-title m-0">David Medina</p>
                                        <p class="text-muted">Yeah everything is fine</p>
                                    </div>
                                </a>

                                <a href="javascript: void(0);" class="d-flex align-items-start">
                                    <img class="flex-shrink-0 me-3 rounded-circle" src="assets/images/users/avatar-6.jpg"
                                        alt="Generic placeholder image" height="36">
                                    <div class="flex-grow-1 chat-user-box">
                                        <p class="user-title m-0">Jay Baker</p>
                                        <p class="text-muted">Wow that's great</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- End Left sidebar -->


                        <!-- Right Sidebar -->
                        <div class="email-rightbar mb-3">

                            <div class="card">
                                <div class="btn-toolbar gap-2 p-3" role="toolbar">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary waves-light waves-effect"><i
                                                class="fa fa-inbox"></i></button>
                                        <button type="button" class="btn btn-primary waves-light waves-effect"><i
                                                class="fa fa-exclamation-circle"></i></button>
                                        <button type="button" class="btn btn-primary waves-light waves-effect"><i
                                                class="far fa-trash-alt"></i></button>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button"
                                            class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-folder"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Updates</a>
                                            <a class="dropdown-item" href="#">Social</a>
                                            <a class="dropdown-item" href="#">Team Manage</a>
                                        </div>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button"
                                            class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-tag"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Updates</a>
                                            <a class="dropdown-item" href="#">Social</a>
                                            <a class="dropdown-item" href="#">Team Manage</a>
                                        </div>
                                    </div>

                                    <div class="btn-group">
                                        <button type="button"
                                            class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            More <i class="mdi mdi-dots-vertical ms-2"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Mark as Unread</a>
                                            <a class="dropdown-item" href="#">Mark as Important</a>
                                            <a class="dropdown-item" href="#">Add to Tasks</a>
                                            <a class="dropdown-item" href="#">Add Star</a>
                                            <a class="dropdown-item" href="#">Mute</a>
                                        </div>
                                    </div>
                                </div>
                                <ul class="message-list">
                                    @forelse ($suratMasuk as $item)
                                        {{-- LOGIKA UNREAD: Jika tanggal surat == hari ini, maka class="unread" --}}
                                        <li class="{{ $item->created_at->isToday() ? 'unread' : '' }}">

                                            <div class="col-mail col-mail-1">
                                                <div class="checkbox-wrapper-mail">
                                                    <input type="checkbox" id="chk-{{ $item->id }}">
                                                    <label for="chk-{{ $item->id }}" class="toggle"></label>
                                                </div>

                                                {{-- JUDUL / PENGIRIM --}}
                                                <a href="#" class="title">{{ $item->asal }}</a>
                                                <span class="star-toggle far fa-star"></span>
                                            </div>

                                            <div class="col-mail col-mail-2">
                                                {{-- LINK KE FILE PDF --}}
                                                <a href="{{ $item->file ? Storage::url($item->file) : '#' }}"
                                                    target="_blank" class="subject">

                                                    {{-- BADGE JENIS SURAT --}}
                                                    <span class="bg-{{ $loop->even ? 'success' : 'primary' }} badge me-2">
                                                        {{ $item->jenisSurat->nama_jenis }}
                                                    </span>

                                                    {{-- PERIHAL --}}
                                                    {{ $item->perihal }} –

                                                    {{-- TEASER (Keterangan Organisasi) --}}
                                                    <span class="teaser">
                                                        Untuk: {{ $item->organization->name }}
                                                    </span>
                                                </a>

                                                {{-- TANGGAL --}}
                                                <div class="date">
                                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M') }}
                                                </div>
                                            </div>
                                        </li>
                                    @empty
                                        <li>
                                            <div class="col-mail col-mail-2">
                                                <a href="#" class="subject">Tidak ada surat masuk.</a>
                                            </div>
                                        </li>
                                    @endforelse
                                </ul>

                            </div> <!-- card -->

                            <div class="row">
                                <div class="col-7">
                                    Showing 1 - 20 of 1,524
                                </div>
                                <div class="col-5">
                                    <div class="btn-group float-end">
                                        <button type="button" class="btn btn-sm btn-success waves-effect"><i
                                                class="fa fa-chevron-left"></i></button>
                                        <button type="button" class="btn btn-sm btn-success waves-effect"><i
                                                class="fa fa-chevron-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end Col-9 -->

                    </div>

                </div><!-- End row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!-- Modal -->
        <div class="modal fade" id="composemodal" tabindex="-1" role="dialog" aria-labelledby="composemodalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-size-16" id="composemodalTitle">New Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="To">
                            </div>

                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Subject">
                            </div>
                            <div class="mb-3 email-editor">
                                <div id="email-editor"></div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send <i
                                class="fab fa-telegram-plane ms-1"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main content-->
