
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Job Assessment</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Job Assessment" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets')}}/images/favicon1.ico">

        <!-- jvectormap -->
        <link href="{{asset('assets')}}/plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">

        <!-- App css -->
        <link href="{{asset('assets')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets')}}/css/jquery-ui.min.css" rel="stylesheet">
        <link href="{{asset('assets')}}/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets')}}/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets')}}/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets')}}/css/app.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        @stack('styles')

    </head>

    <body class="dark-sidenav">
        @include('layouts.leftSlideBar')
        <div class="page-wrapper">
            @include('layouts.topBar')

            <!-- Page Content-->
            <div class="page-content">
                <div class="container-fluid">
                    @include('layouts.breadcrumb')
                    @yield('content')
                </div><!-- container -->

                <footer class="footer text-center text-sm-left">
                    &copy; {{date('Y')}} Job Assessment <span class="d-none d-sm-inline-block float-right">Developed <i class="mdi mdi-heart text-danger"></i> by Zakir Hossain</span>
                </footer><!--end footer-->
            </div>
            <!-- end page content -->
        </div>
        <!-- end page-wrapper -->

        <!-- jQuery  -->
        <script src="{{asset('assets')}}/js/jquery.min.js"></script>
        <script src="{{asset('assets')}}/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('assets')}}/js/metismenu.min.js"></script>
        <script src="{{asset('assets')}}/js/waves.js"></script>
        <script src="{{asset('assets')}}/js/feather.min.js"></script>
        <script src="{{asset('assets')}}/js/simplebar.min.js"></script>
        <script src="{{asset('assets')}}/js/jquery-ui.min.js"></script>
        <script src="{{asset('assets')}}/js/moment.js"></script>
        <script src="{{asset('assets')}}/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <!-- App js -->
        <script src="{{asset('assets')}}/js/app.js"></script>
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
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "showDuration": "3000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
        </script>

        @stack('scripts')

    </body>

</html>
