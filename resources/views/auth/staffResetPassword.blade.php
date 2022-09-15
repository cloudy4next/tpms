<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TherapyPMS | Account Setup</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/dashboard/')}}/images/favicon.ico"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/bootstrap.min.css">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/typography.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/style.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/custom.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/')}}/toastr/build/toastr.min.css">
</head>
<body>
<!-- loader Start -->
<div id="loading">
    <div id="loading-center">
    </div>
</div>
<!-- loader END -->
<!-- Sign in Start -->
<section class="sign-in-page">
    <div id="particles-js"></div>
    <div class="container sign-in-page-bg">
        <div class="row no-gutters">
            <div class="col-md-6 text-center align-self-center">

            </div>
            <div class="col-md-6 align-self-center">
                <div class="sign-in-from">
                    <img src="{{asset('assets/dashboard/images/site_logo.png')}}" class="img-fluid d-block mx-auto mb-3"
                         alt="">

                    <form class="needs-validation mt-3" novalidate action="{{route('staff.reset.password.by.link')}}"
                          method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">New Password</label>
                            <input type="password" name="pass" class="form-control mb-0" id="exampleInputEmail1"
                                   placeholder="Enter new Password" required>
                            <input type="hidden" name="token_id" value="{{$token}}"
                                   class="form-control mb-0" id="exampleInputEmail1" placeholder="Enter new Password"
                                   required>
                            <div class="invalid-feedback">Enter New Password</div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirm Password</label>
                            <input type="password" name="cpass" class="form-control mb-0 " id="exampleInputPassword1"
                                   placeholder="Enter Confirm Password" required>
                            <div class="invalid-feedback">Enter Confirm Password</div>
                        </div>
                        <div class="d-inline-block w-100">
                            <button type="submit" class="btn btn-primary float-right">Change Password</button>
                        </div>
                    </form>
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
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
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
<script src="{{asset('assets/toastr/')}}/build/toastr.min.js"></script>

<!-- toastr init -->
<script src="{{asset('assets/toastr/')}}/toastr.init.js"></script>
<!-- Custom JavaScript -->
<script src="{{asset('assets/dashboard/js/bootstrap-notify.min.js')}}"></script>
@include('layouts.message')
</body>
</html>
