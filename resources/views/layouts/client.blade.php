<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Practice Management</title>


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->

    <link rel="shortcut icon" href="{{asset('assets/dashboard/')}}/images/favicon.png">

    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/bootstrap.min.css">


    <link rel="stylesheet" href="{{ asset('assets/dashboard/') }}/vendor/multiselect/bootstrap-multiselect.css">


    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/typography.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/style.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/responsive.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/custom.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/table.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/emojione.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/emojionearea.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/vendor/lightbox/css/lightbox.css">


    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/vendor/date-time/flatpickr.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/vendor/date/mc-calendar.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/vendor/date-picker/daterangepicker.css">

    <link rel="stylesheet" href="{{ asset('assets/dashboard/') }}/vendor/calendar/lib/main.css">


    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">
    @yield('css')
</head>

<body class="sidebar-main-menu">
<!-- Preloader  -->
<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
        <a href="{{route('client.dashboard')}}">
            <img src="{{asset('assets/dashboard/')}}/images/logo-new.png" class="img-fluid logo-big" alt="tpms">
            <img src="{{asset('assets/dashboard/')}}/images/favicon.png" class="img-fluid logo-small" alt="tpms">
        </a>
        <div class="iq-menu-bt-sidebar">
            <div class="iq-menu-bt align-self-center">
                <div class="wrapper-menu">
                    <div class="main-circle"><i class="ri-more-fill"></i></div>
                    <div class="hover-circle"><i class="ri-more-2-fill"></i></div>
                </div>
            </div>
        </div>
    </div>


    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li>
                    <a href="{{route('client.dashboard')}}" class="iq-waves-effect"><i
                            class="ri-calendar-line"></i><span>My Schedule </span></a>
                </li>
                <li>
                    <a href="{{route('client.myinfo')}}" class="iq-waves-effect"><i class="fa fa-user-plus"></i><span>My Info
							</span></a>
                </li>
                <li>
                    <a href="{{route('client.mystatement')}}" class="iq-waves-effect"><i
                            class="ri-shield-star-line"></i><span>My Statement </span></a>
                </li>
            </ul>
        </nav>
        <div class="p-3"></div>
    </div>


</div>
<!-- Sidebar  -->

<!-- Wrapper Start -->
<div class="wrapper">
    <!-- Page Content  -->
    <div id="content-page" class="content-page">
        <!-- TOP Nav Bar -->
        <div class="iq-top-navbar header-top-sticky">
            <div class="iq-navbar-custom">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <div class="iq-search-bar">
                        <?php
                        $fs_name = \App\Models\setting_name_location::where('admin_id', Auth::user()->admin_id)->first();
                        ?>
                        @if ($fs_name)
                            <h5><img src="{{asset('assets/dashboard/')}}/images/man.jpg"
                                     class="img-fluid rounded-circle logo-big"
                                     alt="tpms">{{$fs_name->facility_name}}</h5>
                        @else
                            <h5><img src="{{asset('assets/dashboard/')}}/images/man.jpg"
                                     class="img-fluid rounded-circle logo-big"
                                     alt="tpms">ABC Behavioral Therapy Center</h5>
                        @endif

                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ri-menu-3-line"></i>
                    </button>
                    <div class="iq-menu-bt align-self-center">
                        <div class="wrapper-menu">
                            <div class="main-circle"><i class="ri-more-fill"></i></div>
                            <div class="hover-circle"><i class="ri-more-2-fill"></i></div>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto navbar-list">
                            <?php
                            $out_balance_copay = \App\Models\patient_statement::where('admin_id', Auth::user()->admin_id)
                                ->where('client_id', Auth::user()->id)
                                ->where('is_paid', 0)
                                ->sum('co_pay');

                            $out_balance_coins = \App\Models\patient_statement::where('admin_id', Auth::user()->admin_id)
                                ->where('client_id', Auth::user()->id)
                                ->where('is_paid', 0)
                                ->sum('coins');

                            $out_balance_ded = \App\Models\patient_statement::where('admin_id', Auth::user()->admin_id)
                                ->where('client_id', Auth::user()->id)
                                ->where('is_paid', 0)
                                ->sum('ded');

                            $sum_out = $out_balance_copay + $out_balance_coins + $out_balance_ded;

                            ?>
                            <li class="nav-item">
                                <span class="badge badge-danger"
                                      style="margin-top: 5px;font-size: 14px">OUTSTANDING DUES $ {{number_format($sum_out,2)}}</span>
                            </li>
                            <li class="nav-item iq-full-screen">
                                <a href="#" class="iq-waves-effect" id="btnFullscreen"><i
                                        class="ri-fullscreen-line"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('client.view.chat.page')}}" id="chat_icon"><i
                                        class="ri-chat-1-line"></i></a>
                            </li>

                        </ul>
                    </div>
                    <ul class="navbar-list">
                        <li>
                            <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                                <img src="{{asset('assets/dashboard/')}}/images/user/1.jpg"
                                     class="img-fluid rounded mr-3" alt="user">
                                <div class="caption">
                                    <h6 class="mb-0 line-height">{{Auth::user()->client_full_name}}</h6>
                                    <span class="font-size-12">{{Auth::user()->login_email}}</span>
                                </div>
                            </a>
                            <div class="iq-sub-dropdown iq-user-dropdown">
                                <div class="iq-card shadow-none m-0">
                                    <div class="iq-card-body p-0 ">
                                        <div class="bg-primary p-3">
                                            <h5 class="mb-0 text-white line-height">
                                                Hello {{Auth::user()->client_full_name}}</h5>
                                            <span class="text-white font-size-12">{{Auth::user()->login_email}}</span>
                                        </div>
                                        {{-- <a href="{{route('client.profile')}}" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-file-user-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">My Profile</h6>
                                                    <p class="mb-0 font-size-12">View personal profile details.
                                                    </p>
                                                </div>
                                            </div>
                                        </a> --}}
                                        <a href="{{route('client.profile.change.password')}}"
                                           class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-lock-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">Change Password</h6>
                                                    <p class="mb-0 font-size-12">Update your password.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="d-inline-block w-100 text-center p-3">
                                            <a class="bg-primary iq-sign-btn" href="{{route('client.logout')}}"
                                               role="button">Sign out<i class="ri-login-box-line ml-2"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Main Content-->
        <div class="container-fluid">
            @yield('client')
        </div>
        <footer class="footer">
            <div class="container-fluid">
                Copyright
                <script>
                    document.write(new Date().getFullYear())
                </script> &copy; <span class="text-primary">TherapyPMS.</span> All rights reserved.
            </div>
        </footer>
        <!--/ Main Content-->
    </div>
</div>
<!-- Jq Files -->
<script src="{{asset('assets/dashboard/')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/js/popper.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/js/bootstrap.min.js"></script>


<script src="{{asset('assets/dashboard/')}}/vendor/multiselect/bootstrap-multiselect.js"></script>
<script src="{{asset('assets/dashboard/')}}/vendor/multiselect/multiselect-activation.js"></script>
<script src="{{asset('assets/dashboard/')}}/vendor/date-picker/moment.min.js"></script>

<!-- Plugin -->
<script src="{{ asset('assets/dashboard/') }}/vendor/date-time/flatpickr.js"></script>
<script src="{{ asset('assets/dashboard/') }}/vendor/date-time/flatpickr-activation.js"></script>
<script src="{{ asset('assets/dashboard/') }}/vendor/date-picker/daterangepicker.js"></script>


<script src="{{ asset('assets/dashboard/') }}/vendor/date/mc-calendar.min.js"></script>
<script src="{{ asset('assets/dashboard/') }}/vendor/date/mc-calendar-activation.js"></script>
<script src="{{ asset('assets/dashboard/') }}/vendor/date-picker/daterangepicker.js"></script>

<script src="{{asset('assets/dashboard/')}}/vendor/jquery.mask.js"></script>
<!-- Custom JavaScript -->
<script src="{{asset('assets/dashboard/')}}/js/custom.js"></script>

<script src="{{ asset('assets/dashboard/') }}/vendor/calendar/lib/main.js"></script>


<script src="{{ asset('assets/dashboard/') }}/vendor/table-sorting/jquery.tablesorter.js"></script>
<script src="{{ asset('assets/dashboard/') }}/vendor/table-sorting/jquery.tablesorter-activation.js"></script>
<script src="{{ asset('assets/') }}/dashboard/js/emojionearea.min.js"></script>


<script src="{{ asset('assets/') }}/toastr/build/toastr.min.js"></script>

<!-- toastr init -->
<script src="{{ asset('assets/') }}/toastr/toastr.init.js"></script>

<script>
    $('.daterange-filter').hide();
    $('.client-filter').hide();
    $('.payperiod-filter').hide();
    $('.providerScheduler-table').hide();
    $('.activity-table').hide();
    $('.goBtn').click(function (event) {
        $('.providerScheduler-table').show();
    });
    $('.schedule-filter select').change(function (event) {
        let v = $(this).val();
        if (v == 5) {
            $('.daterange-filter').show();
            $('.client-filter').hide();
            $('.payperiod-filter').hide();
        } else if (v == 6) {
            $('.daterange-filter').hide();
            $('.client-filter').show();
            $('.payperiod-filter').hide();
        } else if (v == 11) {
            $('.daterange-filter').hide();
            $('.client-filter').hide();
            $('.payperiod-filter').show();
        } else {
            $('.daterange-filter').hide();
            $('.client-filter').hide();
            $('.payperiod-filter').hide();
        }
    });
    $('.select-box select').change(function (event) {
        let v1 = $(this).val();
        if (v1 == 2) {
            document.getElementById("okBtn").onclick = function () {
                $('.activity-table').show();
            };
        } else {
            $('.activity-table').hide();
        }
    });
</script>


<!-- Signature -->

@yield('js')
@include('layouts.message')
</body>

</html>
