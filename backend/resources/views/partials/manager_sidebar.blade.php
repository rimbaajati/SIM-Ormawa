<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('manager.dashboard') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Proposals</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('manager.proposal.all') }}">
                                <span data-key="t-calendar">All Proposal</span>
                            </a>
                        </li>

                        <li>
                            <a href="apps-chat.html">
                                <span data-key="t-chat">Pending Verification</span>
                            </a>
                        </li>

                        <li>
                            <a href="apps-chat.html">
                                <span data-key="t-chat">Approved</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="">
                                <span data-key="t-blog">Blog</span>
                                <span class="badge rounded-pill badge-soft-danger float-end" key="t-new">New</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="apps-blog-grid.html" data-key="t-blog-grid">Blog Grid</a></li>
                                <li><a href="apps-blog-list.html" data-key="t-blog-list">Blog List</a></li>
                                <li><a href="apps-blog-detail.html" data-key="t-blog-details">Blog Details</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-authentication">Organizations</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('manager.organization.all') }}">All Organizations</a></li>
                        <li><a href="auth-register.html" data-key="t-register">Active Ormawa</a></li>
                        <li><a href="auth-recoverpw.html" data-key="t-recover-password">Inactive Ormawa</a></li>
                        <li><a href="auth-lock-screen.html" data-key="t-lock-screen">Activity History</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="mail"></i>
                        <span>Surat & Permohonan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('manager.mail.all') }}">Semua Surat</a></li>
                        <li><a href="auth-register.html" data-key="t-register">Surat Masuk</a></li>
                        <li><a href="auth-recoverpw.html" data-key="t-recover-password">Surat Keluar</a></li>
                        <li><a href="auth-lock-screen.html" data-key="t-lock-screen">Riawayat Aktivitas</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="file-text"></i>
                        <span data-key="t-pages">User</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="pages-starter.html" data-key="t-starter-page">Starter Page</a></li>
                        <li><a href="pages-maintenance.html" data-key="t-maintenance">Maintenance</a></li>
                        <li><a href="pages-comingsoon.html" data-key="t-coming-soon">Coming Soon</a></li>
                        <li><a href="pages-timeline.html" data-key="t-timeline">Timeline</a></li>
                        <li><a href="pages-faqs.html" data-key="t-faqs">FAQs</a></li>
                        <li><a href="pages-pricing.html" data-key="t-pricing">Pricing</a></li>
                        <li><a href="pages-404.html" data-key="t-error-404">Error 404</a></li>
                        <li><a href="pages-500.html" data-key="t-error-500">Error 500</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="file-text"></i>
                        <span data-key="t-pages">Schedules</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('manager.schedules.all') }}" data-key="t-starter-page">All Schedules</a>
                        </li>
                        <li><a href="pages-maintenance.html" data-key="t-maintenance">Today Activities</a></li>
                        <li><a href="pages-comingsoon.html" data-key="t-coming-soon">Coming Soon</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="file-text"></i>
                        <span data-key="t-pages">Report</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="pages-starter.html" data-key="t-starter-page">All LPJ</a></li>
                    </ul>
                </li>
                @if(Auth::user()->role === 'manager')
    <a class="dropdown-item" href="{{ route('manager.dashboard') }}">
        <i class="ri-dashboard-line"></i> Manager Dashboard
    </a>
@endif

@if(Auth::user()->role === 'user')
    <a class="dropdown-item" href="{{ route('user.dashboard') }}">
        <i class="ri-user-line"></i> User Dashboard
    </a>
@endif

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->
