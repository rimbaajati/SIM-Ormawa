@extends('layouts.manager_app')

@section('title', 'All Schedules')

@push('styles')
<link href="{{ asset('assets/libs/fullcalendar/main.min.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

        <!-- start page title -->
            <div class="row">
               <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">All Schedules</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Apps</a></li>
                                <li class="breadcrumb-item active">Calendar</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
        <!-- end page title -->

            <div class="row">
                <div class="col-12">
                               
                    <div class="row">
                        <div class="col-xl-3 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-grid">
                                        <button class="btn font-16 btn-primary" id="btn-new-event"><i class="mdi mdi-plus-circle-outline"></i> Create
                                            New Event
                                        </button>
                                    </div>
                                                
                                    <div id="external-events" class="mt-2">
                                        <br>
                                        <p class="text-muted">Drag and drop your event or click in the calendar</p>
                                        <div class="external-event fc-event text-success bg-success-subtle" data-class="bg-success">
                                            <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>New Event Planning
                                        </div>
                                        <div class="external-event fc-event text-info bg-info-subtle" data-class="bg-info">
                                            <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Meeting
                                        </div>
                                        <div class="external-event fc-event text-warning bg-warning-subtle" data-class="bg-warning">
                                            <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Generating Reports
                                        </div>
                                        <div class="external-event fc-event text-danger bg-danger-subtle" data-class="bg-danger">
                                            <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Create New theme
                                        </div>
                                        <div class="external-event fc-event text-dark bg-dark-subtle" data-class="bg-dark">
                                            <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Team Meeting
                                        </div>
                                    </div>

                                    <div class="row justify-content-center mt-5">
                                        <div class="col-lg-12 col-sm-6">
                                            <img src="assets/images/undraw-calendar.svg" alt="" class="img-fluid d-block">
                                        </div>
                                    </div>
                                            
                                </div>
                            </div>
                        </div> <!-- end col-->

                        <div class="col-xl-9 col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div> <!-- end col -->

                    </div>
                <!-- end row -->

                    <div style='clear:both'></div>

                <!-- Add New Event MODAL -->
                    <div class="modal fade" id="event-modal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header py-3 px-4 border-bottom-0">
                                    <h5 class="modal-title" id="modal-title">Event</h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>

                                </div>

                                <div class="modal-body p-4">
                                    <form class="needs-validation" name="event-form" id="form-event" novalidate>
                                        <input type="hidden" name="eventid" id="eventid">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Event Name</label>
                                                    <input class="form-control" placeholder="Insert Event Name"
                                                        type="text" name="title" id="event-title" required value="" />
                                                    <div class="invalid-feedback">Please provide a valid event name</div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Category</label>
                                                    <select class="form-control form-select" name="category" id="event-category">
                                                        <option  selected> --Select-- </option>
                                                        <option value="bg-danger">Danger</option>
                                                        <option value="bg-success">Success</option>
                                                        <option value="bg-primary">Primary</option>
                                                        <option value="bg-info">Info</option>
                                                        <option value="bg-dark">Dark</option>
                                                        <option value="bg-warning">Warning</option>
                                                        </select>
                                                    <div class="invalid-feedback">Please select a valid event category</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6">
                                                <button type="button" class="btn btn-danger" id="btn-delete-event">Delete</button>
                                            </div>
                                            <div class="col-6 d-flex text-end">
                                                <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success" id="btn-save-event">Save</button>
                                                <button type="submit" class="btn btn-success" id="edit-event-btn">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> <!-- end modal-content-->
                        </div> <!-- end modal dialog-->
                    </div>
                <!-- end modal-->

                </div>
            </div>
                        
        </div> <!-- container-fluid -->
    </div>
<!-- End Page-content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Minia.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design & Develop by <a href="#!" class="text-decoration-underline">Themesbrand</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>


    <!-- calendar min js -->
        <script src="{{ asset('assets/libs/fullcalendar/index.global.min.js') }}"></script>
    <!-- Calendar init -->
        <script src="{{ asset('assets/js/pages/calendar.init.js') }}"></script>

    <link href="{{ asset('assets/libs/fullcalendar/main.min.css') }}" rel="stylesheet">

