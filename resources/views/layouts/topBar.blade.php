<!-- Top Bar Start -->
<header class="app-header" id="appHeader">
    <div class="container-fluid w-100">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-inline-flex align-items-center gap-2">
                <a href="index.html" class="align-items-end logo-main d-none me-5">
                    <img height="35" width="34" class="logo-dark" alt="Dark Logo" src="{{asset('backend/assets')}}/images/logo-md.png">
                    <h3 class="text-body-emphasis fw-bolder mb-0 ms-1">Fashion Step Group</h3>
                </a>
                <button type="button" class="vertical-toggle btn header-btn" id="toggleSidebar" aria-label="Toggle Sidebar">
                    <i class="bi bi-arrow-bar-left header-icon"></i>
                </button>
                <button type="button" class="horizontal-toggle btn header-btn d-none" id="toggleHorizontal" aria-label="Toggle Menu">
                    <i class="ri-menu-2-line header-icon"></i>
                </button>
                <!-- Search Bar -->
                <div class="form-icon right d-none d-md-block" data-bs-toggle="modal" data-bs-target="#searchModal">
                    <input type="text" class="form-control form-control-icon bg-transparent rounded-pill min-w-300px" id="Search" placeholder="Search" required>
                    <div class="search-btn">
                        <div><i class="ri-search-line text-muted fs-16"></i></div>
                        <div><span class="badge bg-light-subtle text-muted">CTRL D</span></div>
                    </div>
                </div>
            </div>
            <div class="flex-shrink-0 d-flex align-items-center gap-4">
                <div class="dark-mode-btn" id="toggleMode">
                    <button class="btn header-btn active" id="lightModeBtn" type="button" aria-label="Switch to light mode">
                        <i class="bi bi-brightness-high"></i>
                    </button>
                    <button class="btn header-btn" id="darkModeBtn" type="button" aria-label="Switch to Dark mode">
                        <i class="bi bi-moon-stars"></i>
                    </button>
                </div>
                <div class="dropdown pe-dropdown-mega d-none d-md-block">
                    <button class="header-profile-btn btn gap-1 text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="d-none d-xl-block pe-2">
                            <span class="d-block mb-0 fs-12 fw-semibold">{{ auth()->check() ? auth()->user()->name : 'Guest' }}</span>
                            <span class="d-block mb-0 fs-10 text-muted">{{ auth()->check() ? auth()->user()->email : 'Guest' }}</span>
                        </div>
                        <span class="header-btn btn position-relative">
                            <img src="{{asset('backend/assets')}}/images/avatar/avatar-3.jpg" alt="Avatar Image" class="img-fluid rounded-circle">
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-mega-sm header-dropdown-menu p-3">
                        <div class="border-bottom pb-2 mb-2 d-flex align-items-center gap-2">
                            <img src="{{asset('backend/assets')}}/images/avatar/avatar-3.jpg" alt="Avatar Image" class="avatar-md">
                            <div>
                                <a href="javascript:void(0)">
                                    <h6 class="mb-0 lh-base">{{ auth()->check() ? auth()->user()->name : 'Guest' }}</h6>
                                </a>
                                <p class="mb-0 fs-13 text-muted">{{ auth()->check() ? auth()->user()->email : 'N/A' }}</p>
                            </div>
                        </div>
                        <ul class="list-unstyled mb-0">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">
                                    <i data-feather="power" class="align-self-center icon-xs icon-dual mr-1"></i> Logout
                                </button>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Top Bar End -->
