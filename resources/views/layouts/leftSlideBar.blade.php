<!-- Left Sidenav -->
<div class="left-sidenav">
    <!-- LOGO -->
    <div class="brand">
        <a href="{{route('dashboard')}}" class="logo">
            <span>
                <img src="{{asset('assets')}}/images/logo.svg" alt="logo-small" class="logo-sm">
            </span>
        </a>
    </div>
    <!--end logo-->
    <div class="menu-content h-100" data-simplebar>
        <ul class="metismenu left-sidenav-menu">
            <li class="menu-label mt-0">Main</li>
            <li>
                <a href="{{route('dashboard')}}"><i data-feather="layers" class="align-self-center menu-icon"></i><span>Dashboard</span><span class="badge badge-soft-success menu-arrow">New</span></a>
            </li>
            <hr class="hr-dashed hr-menu">
            <li class="menu-label my-2">Task List</li>
            <li>
                <a href="javascript: void(0);"><i data-feather="grid" class="align-self-center menu-icon"></i><span>Products</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="javascript: void(0);"><i class="ti-control-record"></i>Sale <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="{{route('sales.create')}}">Add sales</a></li>
                            <li><a href="{{route('sales.index')}}">Sales</a></li>
                            <li><a href="{{route('sales.trash')}}">Trash</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>        
    </div>
</div>
<!-- end left-sidenav-->
