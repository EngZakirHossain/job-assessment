<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Fashion Step</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <meta content="Admin & Dashboards Template" name="description" />
  <meta content="Pixeleyez" name="author" />

  <!-- layout setup -->
  <script type="module" src="{{asset('backend/assets')}}/js/layout-setup.js"></script>

  <!-- App favicon -->
  <link rel="shortcut icon" href="{{asset('backend/assets')}}/images/favicon.png">  <!-- Simplebar Css -->
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
</head>
<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="{{asset('backend/assets')}}/libs/swiper/swiper-bundle.min.js"></script>
    <script src="{{asset('backend/assets')}}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('backend/assets')}}/libs/simplebar/simplebar.min.js"></script>
    <script src="{{asset('backend/assets')}}/js/scroll-top.init.js"></script>
    <script src="{{asset('backend/assets')}}/js/auth/auth.init.js"></script>
</body>
</html>
