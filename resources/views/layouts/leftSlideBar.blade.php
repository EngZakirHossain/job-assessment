<div class="modal fade search-modal" id="searchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header d-block">
            <div class="form-icon">
            <input type="text" class="form-control form-control-icon" id="searchInputInModal" placeholder="Search" required>
            <div class="search-btn w-44px">
                <i class="ri-search-line text-muted fs-16"></i>
            </div>
            <button type="button" class="btn-close position-absolute end-0 top-50 translate-middle-y d-inline-block m-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div>
        <div class="modal-body" data-simplebar id="list-items">
            <ul class="list-unstyled mb-0" id="searchList"></ul>
        </div>
        </div>
    </div>
</div>
<aside class="pe-app-sidebar" id="sidebar">
    <div class="pe-app-sidebar-logo px-6 d-flex align-items-center position-relative">
        <!--begin::Brand Image-->
        <a href="index.html" class="d-flex align-items-end logo-main">
            <img height="35" width="34" class="logo-dark" alt="Dark Logo" src="{{asset('backend/assets')}}/images/logo-md.png">
            <img height="35" width="34" class="logo-light" alt="Light Logo" src="{{asset('backend/assets')}}/images/logo-md-light.png">
            <h3 class="text-body-emphasis fw-bolder mb-0 ms-1">FS</h3>
        </a>
        <button type="button" id="sidebarDefaultArrow" class="btn btn-sm p-0 fs-16 text-body-emphasis ms-auto float-end d-none icon-hover-btn d-none"><i class="ri-arrow-right-line fs-5"></i></button>
        <!--end::Brand Image-->
    </div>
    <nav class="pe-app-sidebar-menu nav nav-pills" data-simplebar id="sidebar-simplebar">
        <div class="d-flex align-items-start flex-column w-100">
            <ul class="pe-main-menu list-unstyled">
                <!-- Main Menu -->
                <li class="pe-menu-title">Main</li>
                <li class="pe-slide pe-has-sub">
                    <a href="#collapseDashboards" class="pe-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('dashboard') ? 'true' : 'false' }}"
                    aria-controls="collapseDashboards">
                        <i class="ri-dashboard-line pe-nav-icon"></i>
                        <span class="pe-nav-content">Dashboards</span>
                        <i class="ri-arrow-down-s-line pe-nav-arrow"></i>
                    </a>

                    <ul class="pe-slide-menu collapse {{ request()->routeIs('dashboard') ? 'show' : '' }}" id="collapseDashboards">
                        <li class="pe-slide-item">
                            <a href="{{ route('dashboard') }}" class="pe-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                Fabric Home
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Pages -->
                <li class="pe-menu-title">Task List</li>
                <li class="pe-slide pe-has-sub">
                   <a href="#collapseAuth" class="pe-nav-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}"
                    data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('suppliers.*') ? 'true' : 'false' }}"
                    aria-controls="collapseAuth">
                        <i class="ri-user-line pe-nav-icon"></i>
                        <span class="pe-nav-content">Suppliers</span>
                        <i class="ri-arrow-down-s-line pe-nav-arrow"></i>
                    </a>

                    <ul class="pe-slide-menu collapse {{ request()->routeIs('suppliers.*') ? 'show' : '' }}" id="collapseAuth">
                        <li class="pe-slide-item">
                            <a href="{{ route('suppliers.index') }}" class="pe-nav-link {{ request()->routeIs('suppliers.index') ? 'active' : '' }}">
                                Suppliers
                            </a>
                        </li>
                        <li class="pe-slide-item">
                            <a href="{{ route('suppliers.trash') }}" class="pe-nav-link {{ request()->routeIs('suppliers.trash') ? 'active' : '' }}">
                                Trash Supplier
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="pe-slide pe-has-sub">
                    <a href="#collapsePages" class="pe-nav-link {{ request()->routeIs('fabrics.*') ? 'active' : '' }}"
                    data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('fabrics.*') ? 'true' : 'false' }}"
                    aria-controls="collapsePages">
                        <i class="ri-pages-line pe-nav-icon"></i>
                        <span class="pe-nav-content">Fabrics</span>
                        <i class="ri-arrow-down-s-line pe-nav-arrow"></i>
                    </a>

                    <ul class="pe-slide-menu collapse {{ request()->routeIs('fabrics.*') ? 'show' : '' }}" id="collapsePages">
                        <li class="pe-slide-item">
                            <a href="{{ route('fabrics.index') }}" class="pe-nav-link {{ request()->routeIs('fabrics.index') ? 'active' : '' }}">
                            Fabrics
                            </a>
                        </li>
                        <li class="pe-slide-item">
                            <a href="{{ route('fabrics.trash') }}" class="pe-nav-link {{ request()->routeIs('fabrics.trash') ? 'active' : '' }}">
                                Trash Fabrics
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</aside>
