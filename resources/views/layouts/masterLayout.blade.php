<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8" />
    <title>Fashion Step Group</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="Admin & Dashboards Template" name="description" />
    <meta content="Pixeleyez" name="author" />

    <!-- layout setup -->
    <script type="module" src="{{asset('backend/assets')}}/js/layout-setup.js"></script>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('backend/assets')}}/images/favicon.png">    <link rel="stylesheet" href="{{asset('backend/assets')}}/libs/gridjs/theme/mermaid.min.css">
    <!-- Simplebar Css -->
    <link rel="stylesheet" href="{{asset('backend/assets')}}/libs/simplebar/simplebar.min.css">
    <!-- Swiper Css -->
    <link href="{{asset('backend/assets')}}/libs/swiper/swiper-bundle.min.css" rel="stylesheet">
    <!-- Nouislider Css -->
    <link href="{{asset('backend/assets')}}/libs/nouislider/nouislider.min.css" rel="stylesheet">
    <!-- Bootstrap Css -->
    <link href="{{asset('backend/assets')}}/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!--icons css-->
    <link href="{{asset('backend/assets')}}/css/icons.min.css" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{asset('backend/assets')}}/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">

        @stack('styles')

    </head>

    <body class="dark-sidenav">
        @include('layouts.leftSlideBar')
        <div class="page-wrapper">
            @include('layouts.topBar')

            <!-- Page Content-->
            <main class="app-wrapper">
                <div class="container-fluid">
                    @include('layouts.breadcrumb')
                    @yield('content')
                </div><!-- container -->
            </main>>
            <!-- end page content -->
        </div>
        <!-- end page-wrapper -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center gap-2">
                    <script>document.write(new Date().getFullYear())</script> © Zakir
                    <div class="text-sm-end d-none d-sm-block">
                        Develop by Zakir Hossain
                    </div>
                </div>
            </div>
        </footer>

        <!-- jQuery  -->
        <script src="{{asset('backend/assets')}}/libs/swiper/swiper-bundle.min.js"></script>
        <script src="{{asset('backend/assets')}}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('backend/assets')}}/libs/simplebar/simplebar.min.js"></script>
        <script src="{{asset('backend/assets')}}/js/scroll-top.init.js"></script>    <script src="{{asset('backend/assets')}}/libs/gridjs/gridjs.umd.js" type="text/javascript"></script>

        <script src="{{asset('backend/assets')}}/libs/apexcharts/apexcharts.min.js"></script>
        <!-- File js -->
        <script src="{{asset('backend/assets')}}/js/dashboard/e-commerce.init.js"></script>
        <!-- App js -->
        <script type="module" src="{{asset('backend/assets')}}/js/app.js"></script>

        <!-- App js -->
        <script src="{{asset('backend/assets')}}/js/app.js"></script>
        <script>
            $(document).ready(function() {
                @if(session('success'))
                    toastr.success("{{ session('success') }}");
                @endif

                @if(session('error'))
                    toastr.error("{{ session('error') }}");
                @endif

                @if(session('warning'))
                    toastr.warning("{{ session('warning') }}");
                @endif

                @if(session('info'))
                    toastr.info("{{ session('info') }}");
                @endif
            });
        </script>

        @stack('scripts')

    </body>

</html>
