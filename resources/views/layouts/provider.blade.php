<?php

    $admin_id = Auth::user()->admin_id;

?>

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
        <a href="index.html">
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
                    <a href="{{route('provider.dashboard')}}" class="iq-waves-effect"><i
                            class="ri-home-4-line"></i><span>My Schedule</span></a>
                </li>
                <li>
                    <a href="{{route('provider.info')}}" class="iq-waves-effect"><i
                            class="fa fa-user-md"></i><span>Biographic</span></a>
                </li>
                <li>
                    <a href="{{route('provider.patient.list')}}" class="iq-waves-effect"><i class="fa fa-user-plus"></i><span>Patient(S) </span></a>
                </li>
                <li>
                    <a href="{{route('provider.payroll.timesheet')}}" class="iq-waves-effect"><i
                            class="ri-file-shred-line"></i><span>Timesheet(s) </span></a>
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
                                     alt="tpms"></h5>
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
                            <li class="nav-item iq-full-screen">
                                <a href="#" class="iq-waves-effect" id="btnFullscreen"><i
                                        class="ri-fullscreen-line"></i></a>
                            </li>
                            @if(\Auth::user()->session_check==1)
                            <li class="nav-item">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="las la-plus"></i></a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item cretApp" href="#sc_modal" data-toggle="modal" id="sc_btn"><i class="las la-calendar-plus mr-2"></i>Create
                                        Appoinment</a>
                                </div>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{route('provider.view.chat.page')}}" id="chat_icon"><i
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
                                    <h6 class="mb-0 line-height">{{Auth::user()->full_name}}</h6>
                                    <span class="font-size-12">{{Auth::user()->login_email}}</span>
                                </div>
                            </a>
                            <div class="iq-sub-dropdown iq-user-dropdown">
                                <div class="iq-card shadow-none m-0">
                                    <div class="iq-card-body p-0 ">
                                        <div class="bg-primary p-3">
                                            <h5 class="mb-0 text-white line-height">
                                                Hello {{Auth::user()->full_name}}</h5>
                                            <span class="text-white font-size-12">{{Auth::user()->login_email}}</span>
                                        </div>
                                        <a href="{{route('provider.info')}}"
                                           class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-file-user-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">My Profile</h6>
                                                    <p class="mb-0 font-size-12">View personal profile details.</p>
                                                </div>
                                            </div>
                                        </a>
                                        {{--                                        <a href="{{route('provider.profile')}}" class="iq-sub-card iq-bg-primary-hover">--}}
                                        {{--                                            <div class="media align-items-center">--}}
                                        {{--                                                <div class="rounded iq-card-icon iq-bg-primary">--}}
                                        {{--                                                    <i class="ri-file-user-line"></i>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="media-body ml-3">--}}
                                        {{--                                                    <h6 class="mb-0 ">My Profile</h6>--}}
                                        {{--                                                    <p class="mb-0 font-size-12">View personal profile details.--}}
                                        {{--                                                    </p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </a>--}}
                                        <a href="{{route('provider.profile.change.password')}}"
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
                                            <a class="bg-primary iq-sign-btn" href="{{route('provider.logout')}}"
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
            @yield('provider')
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


<div class="modal fade" id="sc_modal" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Add Appoinments</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="progress app_progress" style="height: 7px; margin-top: -17px; margin-left: -15px; margin-right: -15px; margin-bottom: 5px; background-color: white;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                </div>
                <form action="{{route('superadmin.appoinment.save')}}" id="sc_form" method="post"
                    class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label>App Type</label>
                        </div>
                        <div class="col-md-8 mb-2">
                            <div class="custom-control custom-switch app-switch">
                                <input type="checkbox" class="custom-control-input" id="bill_switch" checked>
                                <label class="custom-control-label" for="bill_switch">Billable</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Patient Name</label>
                        </div>
                        <div class="col-md-8 mb-2">
                            <select class="form-control form-control-sm client_name" id="sc_client_id" name="client_id" required>
                                <option></option>
                            </select>
                            <div class="invalid-feedback error_client">Enter Patient Name</div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Auth</label>
                        </div>
                        <div class="col-md-8 mb-2">
                            <select class="form-control form-control-sm" name="authorization_id" id="sc_auth_id" required>
                            </select>
                            <div class="invalid-feedback error_auth">Enter Auth</div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Service</label>
                        </div>
                        <div class="col-md-8 mb-2">
                            <select class="form-control form-control-sm" name="activity_id" id="sc_act_id" required>
                            </select>
                            <div class="invalid-feedback error_activity">Enter Service</div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Provider Name</label>
                        </div>
                        <div class="col-md-8 mb-2" id="sc_provider_box">
                            <select class="form-control form-control-sm" name="provider_id" id="sc_provider_id"required>
                            </select>
                            <div class="invalid-feedback error_provider">Enter Provider Name</div>
                        </div>
                        <div class="col-md-8 mb-2" id="sc_nb_provider_box">
                            <div class="input-group">
                                <select
                                    class="form-control form-control-sm multiselect" id="sc_nb_provider_id"
                                    multiple required>
                                </select>
                                <div class="input-group-append ml-2">
                                    <button type="button" class="btn btn-sm btn-primary" id="sc_sa_provider">
                                    Select All
                                    </button>
                                </div>
                            </div>
                            <div class="invalid-feedback error_provider">Enter Provider Name</div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>POS</label>
                        </div>
                        <div class="col-md-8 mb-2">
                            <?php
                                            $poin_service = \App\Models\point_of_service::where('admin_id', $admin_id)->get();
                            ?>
                            <select class="form-control form-control-sm" id="sc_location" required>
                                <option value="0"></option>
                                @foreach($poin_service as $pos_ser)
                                <option value="{{$pos_ser->pos_code}}">{{$pos_ser->pos_name}}
                                    ({{$pos_ser->pos_code}})
                                </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback error_location">Enter Location</div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label> From Date</label>
                        </div>
                        <div class="col-md-8 mb-2">
                            <div class="input-group">
                                <input class="form-control form-control-sm" type="text" readonly autocomplete="nope" placeholder="mm/dd/yyyy" id="datepicker_appoint">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <div class="invalid-feedback error_from_time">Enter Date & Time</div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>From Time</label>
                        </div>
                        <div class="col-md-8 mb-2">
                            <div class="row no-gutters">
                                <div class="col-md">
                                    <input class="form-control form-control-sm" type="time" id="sc_from_time" required>
                                </div>
                                <div class="col-md-3 text-center">
                                    <label>To Time</label>
                                </div>
                                <div class="col-md">
                                    <input class="form-control form-control-sm" type="time" id="sc_to_time" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Status</label>
                        </div>
                        <div class="col-md-8 mb-2">
                            <select class="form-control form-control-sm" name="status" id="sc_status" required>
                                <option value=""></option>
                                <option value="Scheduled">Scheduled</option>
                                <option value="No Show">No Show</option>
                                <option value="Hold">Hold</option>
                                <option value="Cancelled by Client">Cancelled by Client</option>
                                <option value="CC more than 24 hrs">CC more than 24 hrs</option>
                                <option value="CC less than 24 hrs">CC less than 24 hrs</option>
                                <option value="Cancelled by Provider">Cancelled by Provider</option>
                                <option value="Rendered">Rendered</option>
                            </select>
                            <div class="invalid-feedback error_status">Enter Status</div>
                        </div>
                        <div class="col-md-5">
                            <div class="custom-control custom-switch rpattern-switch">
                                <input type="checkbox" class="custom-control-input" id="sc_r_check">
                                <label class="custom-control-label" for="sc_r_check">Recurrence Pattern?</label>
                            </div>
                            <div class="custom-control custom-switch daily-switch" id="sc_daily_check_box">
                                <input type="checkbox" class="custom-control-input" id="sc_daily_check">
                                <label class="custom-control-label" for="sc_daily_check">Daily</label>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row" id="sc_end_date_box">
                                <div class="col-md-12 mb-2">
                                    <input class="form-control form-control-sm" type="text" readonly autocomplete="nope" placeholder="mm/dd/yyyy" id="datepicker_endpoint">
                                </div>
                            </div>
                            <div class="perday" id="week_days_box">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input sc_day_name" value="Sunday"
                                        name="day_name[]">SU
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input sc_day_name" value="Monday"
                                        name="day_name[]">MO
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input sc_day_name" value="Tuesday"
                                        name="day_name[]">TU
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input sc_day_name" value="Wednesday"
                                        name="day_name[]">WE
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input sc_day_name" value="Thursday"
                                        name="day_name[]">TH
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input sc_day_name" value="Friday"
                                        name="day_name[]">FR
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input sc_day_name" value="Saturday"
                                        name="day_name[]">SA
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="sc_sub_btn">
                    Add Appoinments <i class='bx bx-loader align-middle ml-2 btnloding' id="sc_loading"></i>
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
                
<div class="modal fade" id="su_modal" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Edit Appoinment</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="progress su_progress" style="height: 7px; margin-top: -17px; margin-left: -15px; margin-right: -15px; margin-bottom: 5px; background-color: white;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                </div>
                <form id="su_form" method="post" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-4 show_viewbtndiv1 align-self-center mb-2"></div>
                        <div
                            class="col-md-8 show_viewbtndiv align-self-center mb-2">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <button type="button"
                                    class="btn btn-sm btn-success telehealth_session_id"
                                    data-id=""
                                    data-toggle="modal"
                                    data-target="#vdoApp">
                                    <i class="ri-vidicon-fill align-middle mr-1"></i>
                                    <span class="align-middle"></span>Start
                                    Telehealth
                                    Appointment
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4 show_viewbtndiv">
                        </div>
                        <div class="col-md-8 mb-2 show_viewbtndiv">
                            <input type="email"
                            class="form-control form-control-sm client_email"
                            value=""
                            readonly>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Patient Name</label>
                        </div>
                        <div class="col-md-8 mb-2">
                            <select class="form-control form-control-sm client_name" id="su_client_id" name="client_id" required>
                                <option></option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Auth</label>
                        </div>
                        <div class="col-md-8 mb-2">
                            <select class="form-control form-control-sm" name="authorization_id" id="su_auth_id" required>
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Service</label>
                        </div>
                        <div class="col-md-8 mb-2">
                            <select class="form-control form-control-sm" name="activity_id" id="su_act_id" required>
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Provider Name</label>
                        </div>
                        <div class="col-md-8 mb-2" id="su_provider_box">
                            <select class="form-control form-control-sm" name="provider_id" id="su_provider_id"required>
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>POS</label>
                        </div>
                        <div class="col-md-8 mb-2">
                            <?php
                                $poin_service = \App\Models\point_of_service::where('admin_id', $admin_id)->get();
                            ?>
                            <select class="form-control form-control-sm" id="su_location" required>
                                <option value="0"></option>
                                @foreach($poin_service as $pos_ser)
                                <option value="{{$pos_ser->pos_code}}">{{$pos_ser->pos_name}}
                                    ({{$pos_ser->pos_code}})
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label> From Date</label>
                        </div>
                        <div class="col-md-8 mb-2">
                            <div class="input-group">
                                <input class="form-control form-control-sm" type="text" readonly autocomplete="nope" placeholder="mm/dd/yyyy" id="su_from_date">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>From Time</label>
                        </div>
                        <div class="col-md-8 mb-2">
                            <div class="row no-gutters">
                                <div class="col-md">
                                    <input class="form-control form-control-sm" type="time" id="su_from_time" required>
                                </div>
                                <div class="col-md-3 text-center">
                                    <label>To Time</label>
                                </div>
                                <div class="col-md">
                                    <input class="form-control form-control-sm" type="time" id="su_to_time" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Status</label>
                        </div>
                        <div class="col-md-8 mb-2">
                            <select class="form-control form-control-sm" name="status" id="su_status" required>
                                <option value=""></option>
                                <option value="Scheduled">Scheduled</option>
                                <option value="No Show">No Show</option>
                                <option value="Hold">Hold</option>
                                <option value="Cancelled by Client">Cancelled by Client</option>
                                <option value="CC more than 24 hrs">CC more than 24 hrs</option>
                                <option value="CC less than 24 hrs">CC less than 24 hrs</option>
                                <option value="Cancelled by Provider">Cancelled by Provider</option>
                                <option value="Rendered">Rendered</option>
                            </select>
                            <div class="invalid-feedback error_status">Enter Status</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="su_sub_btn">
                    Save Changes <i class='bx bx-loader align-middle ml-2 btnloding' id="su_loading"></i>
                    </button>
                    <button type="button" class="btn btn-primary" id="su_sub_lock_btn">Appointment is Locked</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Vdo App -->
<div class="modal fade" id="vdoApp">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Telehealth Checklist</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="#" id="video_check_form">
                <div class="modal-body">
                    <div class="mb-2">
                        <h2 class="common-title mb-2">BEFORE THE SESSION</h2>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Restart your computer.
                                Close
                                background
                                programs
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Test your internet
                                connection speed.
                                Speeds of
                                10mpbs will provide the best experience. To check
                                your speed, search Google speed test and click the
                                blue button
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Confirm that the webcam,
                                microphone,
                                and
                                speakers
                                are working.
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Make sure the audio is
                                not on mute
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Remove clutter and tidy
                                office
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">To prevent interruptions
                                during the
                                session, set your
                                cell phone to silent and consider hanging a “Do not
                                disturb” sign
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">If necessary, contact a
                                client’s
                                insurance to obtain
                                payment coverage authorization.
                            </label>
                        </div>
                    </div>
                    <div class="mb-2">
                        <h2 class="common-title mb-2">START OF SESSION</h2>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Verify client’s
                                identity, if needed.
                                Document full name
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Confirm client is in a
                                safe, private
                                place to talk
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Review the safety plan
                                with client.
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Review the back-up plan
                                in case the
                                connection fails.
                                Confirm their phone number on file.
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Inform the client of the
                                potential
                                risks and limitations of
                                receiving treatment via Telehealth.
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Remind client that there
                                are
                                alternative, non-video therapy
                                options
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Obtain verbal or written
                                consent, if
                                necessary, from the
                                client for the use of Telehealth
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Emphasize the importance
                                of
                                consistent therapy
                                attendance and homework completion.
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Review the protocol of
                                the
                                Telehealth visit and explain what
                                the client can expect
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Emphasize the importance
                                of speaking
                                clearly.
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Mention that you may
                                briefly look
                                away or down when
                                taking notes, but that doesn’t mean you aren’t listening
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Give client opportunity
                                to ask
                                questions about the session
                            </label>
                        </div>
                        <hr>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input check_all"><b>Aknowledged All</b>
                            </label>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary meet_start">Start your Session</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
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
<!-- Export Plugin -->
<script src="{{ asset('assets/') }}/dashboard/js/report_export/libs/jsPDF/jspdf.umd.min.js"></script>
<script src="{{ asset('assets/') }}/dashboard/js/report_export/libs/js-xlsx/xlsx.core.min.js"></script>
<script src="{{ asset('assets/') }}/dashboard/js/report_export/tableExport.min.js"></script>
<script src="{{ asset('assets/dashboard/') }}/vendor/table-sorting/jquery.tablesorter-activation.js"></script>
<script src="{{ asset('assets/') }}/dashboard/js/emojionearea.min.js"></script>


<script src="{{ asset('assets/') }}/toastr/build/toastr.min.js"></script>

<!-- toastr init -->
<script src="{{ asset('assets/') }}/toastr/toastr.init.js"></script>

<!--- Signature ---->
<script src="{{ asset('assets/dashboard/vendor/') }}/signature/sketchpad.js"></script>

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
@include('provider.include.appoinemnt_js')
<script>
    jQuery(document).ready(function ($) {


        $(document).ready(function () {
            $('input').attr('autocomplete', 'nope');
        });

        $('.daily').hide();
        $('.weekly').hide();
        $('.endate').hide();
        $('.perday').hide();
        $('.rpattern').click(function (event) {
            if ($(this).is(':checked')) {
                $('.daily').show();
                $('.weekly').show();
                $('.endate').show();
            } else {
                $('.daily').hide();
                $('.weekly').hide();
                $('.endate').hide();
                $('.perday').hide();
            }
        });
        $('.daily').click(function (event) {
            if ($(this).prop("checked", true)) {
                $('.perday').hide();
            }
        });
        $('.weekly').click(function (event) {
            if ($(this).prop("checked", true)) {
                $('.endate').show();
                $('.perday').show();
            }
        });
    });
</script>

<!-- Signature -->

@yield('js')
@include('layouts.message')
</body>

</html>
