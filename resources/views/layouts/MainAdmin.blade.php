<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administration</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/admin/')}}/images/favicon.ico"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/admin/')}}/css/bootstrap.min.css">
    <!-- Select 2  -->
    <link rel="stylesheet" href="{{asset('assets/admin/')}}/css/select2.min.css">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{asset('assets/admin/')}}/css/typography.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('assets/admin/')}}/css/style.css">
    <link rel="stylesheet" href="{{asset('assets/admin/')}}/css/custom.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('assets/admin/')}}/css/responsive.css">


    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">


</head>
<body class="sidebar-main-menu">
<!-- loader Start -->
<div id="loading">
    <div id="loading-center">
    </div>
</div>
<!-- loader END -->
<!-- Wrapper Start -->
<div class="wrapper">
    <!-- Page Content  -->
    <div id="content-page" class="content-page">
        <!-- Header -->
        <header class="iq-header">
            <div class="container-fluid">
                <div class="d-flex">
                    <div class="align-self-center">
                        <h5>Administration</h5>
                    </div>
                    <div class="align-self-center ml-auto">
                        <ul class="list-inline m-0">
                            <li class="list-inline-item">Welcome <span>{{Auth::user()->name}} | </span></li>
                            <li class="list-inline-item"><a href="{{route('mainadmin.dashboard')}}">Home | </a></li>
                            <li class="list-inline-item"><a href="{{route('mainadmin.logout')}}">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header END -->
        <div class="container-fluid">
            @yield('mainadmin')
        </div>
        <!-- Footer -->
        <footer class="bg-white iq-footer">
            <div class="container-fluid">
                Copyright 2021 All Rights Reserved.
            </div>
        </footer>
        <!-- Footer END -->
    </div>
</div>
<!-- Wrapper END -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('assets/admin/')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/admin/')}}/js/popper.min.js"></script>
<script src="{{asset('assets/admin/')}}/js/bootstrap.min.js"></script>
<!-- Appear JavaScript -->
<script src="{{asset('assets/admin/')}}/js/jquery.appear.js"></script>
<!-- Countdown JavaScript -->
<script src="{{asset('assets/admin/')}}/js/countdown.min.js"></script>
<!-- Counterup JavaScript -->
<script src="{{asset('assets/admin/')}}/js/waypoints.min.js"></script>
<script src="{{asset('assets/admin/')}}/js/jquery.counterup.min.js"></script>
<!-- Wow JavaScript -->
<script src="{{asset('assets/admin/')}}/js/wow.min.js"></script>
<!-- Apexcharts JavaScript -->
<script src="{{asset('assets/admin/')}}/js/apexcharts.js"></script>
<!-- Slick JavaScript -->
<script src="{{asset('assets/admin/')}}/js/slick.min.js"></script>
<!-- Select2 JavaScript -->
<script src="{{asset('assets/admin/')}}/js/select2.min.js"></script>
<!-- Owl Carousel JavaScript -->
<script src="{{asset('assets/admin/')}}/js/owl.carousel.min.js"></script>
<!-- Magnific Popup JavaScript -->
<script src="{{asset('assets/admin/')}}/js/jquery.magnific-popup.min.js"></script>
<!-- Smooth Scrollbar JavaScript -->
<script src="{{asset('assets/admin/')}}/js/smooth-scrollbar.js"></script>
<!-- lottie JavaScript -->
<script src="{{asset('assets/admin/')}}/js/lottie.js"></script>
<!-- am core JavaScript -->
<script src="{{asset('assets/admin/')}}/js/core.js"></script>
<!-- am charts JavaScript -->
<script src="{{asset('assets/admin/')}}/js/charts.js"></script>
<!-- am animated JavaScript -->
<script src="{{asset('assets/admin/')}}/js/animated.js"></script>
<!-- am kelly JavaScript -->
<script src="{{asset('assets/admin/')}}/js/kelly.js"></script>
<!-- Flatpicker Js -->
<script src="{{asset('assets/admin/')}}/js/flatpickr.js"></script>
<!-- Chart Custom JavaScript -->
<script src="{{asset('assets/admin/')}}/js/chart-custom.js"></script>
<!-- Custom JavaScript -->
<script src="{{asset('assets/admin/')}}/js/custom.js"></script>
<script src="{{ asset('assets/') }}/toastr/build/toastr.min.js"></script>

<!-- toastr init -->
<script src="{{ asset('assets/') }}/toastr/toastr.init.js"></script>

@yield('js')
@include('layouts.message')
</body>
</html>
