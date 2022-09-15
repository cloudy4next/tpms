<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TherapyPMS</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/dashboard/')}}/images/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/bootstrap.min.css">
    <!-- Plugin -->
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/vendor/date-picker/daterangepicker.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/vendor/ladda-button/ladda.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/vendor/select2/select2.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/vendor/selectize/selectize.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/typography.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/style.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/responsive.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/custom.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">
</head>
<body>
<!-- Sign in Start -->
<section class="sign-in-page">
    <div id="particles-js"></div>
    <div class="container sign-in-page-bg">
        <div class="row no-gutters">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="sign-in-from">
                    <img src="{{asset('assets/dashboard/')}}//images/logo.png" class="img-fluid d-block mx-auto mb-3"
                         alt="">
                    @if (Session::has('login_error'))
                        <div class="alert alert-danger mt-3" role="alert">
                            {{Session::get('login_error')}}
                        </div>
                    @endif

                    <form class="needs-validation mt-3" action="{{route('user.custom.login.submit')}}" method="post"
                          novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email Address</label>
                            <input type="email" name="email" class="form-control mb-0" id="exampleInputEmail1"
                                   placeholder="Enter Email" required>
                            <div class="invalid-feedback">Enter Email</div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <a href="{{route('user.forgot.password')}}" class="float-right">Forgot Password?</a>
                            <input type="password" name="password" class="form-control mb-0" id="exampleInputPassword1"
                                   placeholder="Password" required>
                            <div class="invalid-feedback">Enter Password</div>
                        </div>
                        <div class="d-inline-block w-100">
                            <div class="custom-control custom-checkbox d-inline-block pt-1">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Remember Me</label>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Sign in</button>
                        </div>
                    </form>
                    {{--                    <h3>The site is under maintenance</h3>--}}
                    {{--                    <p>Sorry for the inconvenience. To improve our services, we have momentarily shutdown our site.</p>--}}
                    <div class="privacy mt-3">
                        Therapy PMS respects the privacy of our users and values their trust.
                        Please read our <a href="{{route('privacy.policy')}}" target="_blank">privacy policy</a>
                        carefully.
                        If you do not agree with the terms of our privacy policy, then please do not access the
                        site.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Sign in END -->
<!-- Jq Files -->
<script src="{{asset('assets/dashboard/')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/js/popper.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/js/bootstrap.min.js"></script>
<!-- Plugin -->
<script src="{{asset('assets/dashboard/')}}/vendor/date-picker/moment.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/vendor/date-picker/daterangepicker.js"></script>
<script src="{{asset('assets/dashboard/')}}/vendor/ladda-button/spin.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/vendor/ladda-button/ladda.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/vendor/ladda-button/ladda-activation.js"></script>
<script src="{{asset('assets/dashboard/')}}/vendor/select2/select2.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/vendor/selectize/selectize.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/vendor/jquery.mask.js"></script>
<script src="{{asset('assets/dashboard/')}}/vendor/tablesorter.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/vendor/particle-js/particles.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/vendor/particle-js/app.js"></script>
<!-- Custom JavaScript -->
<script src="{{asset('assets/dashboard/')}}/js/custom.js"></script>

<script src="{{ asset('assets/') }}/toastr/build/toastr.min.js"></script>

<!-- toastr init -->
<script src="{{ asset('assets/') }}/toastr/toastr.init.js"></script>
@include('layouts.message')
</body>
</html>
