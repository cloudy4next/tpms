<?php
if (Auth::user()->is_up_admin == 1) {
    $admin_id = Auth::user()->id;
} else {
    $admin_id = Auth::user()->up_admin_id;
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Practice Management</title>
    <link rel="shortcut icon" href="{{ asset('assets/dashboard/') }}/images/favicon.png">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/') }}/vendor/multiselect/bootstrap-multiselect.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('assets/dashboard/') }}/css/typography.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/') }}/css/responsive.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/') }}/css/custom.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/') }}/css/table.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/') }}/css/emojione.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/') }}/css/emojionearea.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/') }}/vendor/lightbox/css/lightbox.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/') }}/vendor/date-time/flatpickr.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/') }}/vendor/date/mc-calendar.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/') }}/vendor/date-picker/daterangepicker.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/') }}/vendor/calendar/lib/main.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">
    @yield('css')
</head>

<body class="sidebar-main-menu">
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <div class="loading2"></div>
    <div class="iq-sidebar">
        <div class="iq-sidebar-logo d-flex justify-content-between">
            <a href="{{ route('superadmin.dashboard') }}">
                <img src="{{ asset('assets/dashboard/') }}/images/logo-new.png" class="img-fluid logo-big"
                    alt="tpms">
                <img src="{{ asset('assets/dashboard/') }}/images/favicon.png" class="img-fluid logo-small"
                    alt="tpms">
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
                @include('superadmin.include.main_menu')
            </nav>
            <div class="p-3"></div>
        </div>
    </div>
    <div class="wrapper">
        <div id="content-page" class="content-page">
            <!-- TOP Nav Bar -->
            <div class="iq-top-navbar header-top-sticky">
                <div class="iq-navbar-custom">
                    <nav class="navbar navbar-expand-lg navbar-light p-0">
                        <div class="iq-search-bar">
                            <?php
                            if (Auth::user()->is_up_admin == 1) {
                                $fs_name = \App\Models\setting_name_location::where('admin_id', Auth::user()->id)->first();
                            } else {
                                $fs_name = \App\Models\setting_name_location::where('admin_id', Auth::user()->up_admin_id)->first();
                            }
                            ?>
                            @if ($fs_name)
                                <h5>
                                    <?php
                                    $gen = \App\Models\general_setting::where('admin_id', $admin_id)->first();
                                    ?>
                                    @if ($gen)
                                        @if (!empty($gen->logo) && file_exists($gen->logo))
                                            <img src="{{ asset($gen->logo) }}"
                                                class="img-fluid rounded-circle logo-big" alt="tpms">
                                        @else
                                            <img src="{{ asset('assets/dashboard/') }}/images/man.jpg"
                                                class="img-fluid rounded-circle logo-big" alt="tpms">
                                        @endif
                                    @else
                                        <img src="{{ asset('assets/dashboard/') }}/images/man.jpg"
                                            class="img-fluid rounded-circle logo-big" alt="tpms">
                                    @endif
                                    {{ $fs_name->facility_name }}
                                </h5>
                            @else
                                <h5>
                                    <?php
                                    $gen = \App\Models\general_setting::where('admin_id', $admin_id)->first();
                                    ?>
                                    @if ($gen)
                                        @if (!empty($gen->logo) && file_exists($gen->logo))
                                            <img src="{{ asset($gen->logo) }}"
                                                class="img-fluid rounded-circle logo-big" alt="tpms">
                                        @else
                                            <img src="{{ asset('assets/dashboard/') }}/images/man.jpg"
                                                class="img-fluid rounded-circle logo-big" alt="tpms">
                                        @endif
                                    @else
                                        <img src="{{ asset('assets/dashboard/') }}/images/man.jpg"
                                            class="img-fluid rounded-circle logo-big" alt="tpms">
                                    @endif

                                </h5>
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
                                <li class="nav-item">
                                    <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                            class="las la-plus"></i></a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#createClient"><i class="las la-plus-circle mr-2"></i>Create
                                            Patient</a>
                                        <a class="dropdown-item" href="#sc_modal" data-toggle="modal"
                                            id="sc_btn"><i class="las la-calendar-plus mr-2"></i>Create
                                            Appoinment</a>
                                    </div>
                                </li>
                                <li class="nav-item" id="">
                                    {{-- <a href="#" id="wid_get"><i class="fa fa-fw fa-bullhorn black" --}}
                                    {{-- style="padding-left: 8px; font-size: 20px"></i> --}}
                                    {{-- </a> --}}
                                    <a href="#" id="wid_get">
                                        <i class="fa fa-fw fa-bullhorn black"
                                            style=" padding-left: 8px;font-size: 20px;" id=""></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('superadmin.view.chat.page') }}" id="chat_icon"><i
                                            class="ri-chat-1-line"></i></a>
                                </li>
                                <style>
                                    .HW_badge_cont {
                                        height: 0px !important;
                                    }

                                    #HW_badge {
                                        margin-top: -34px !important;
                                        margin-left: 20px !important;
                                    }
                                </style>
                                <li class="nav-item dropdown">
                                    <a href="#" class="search-toggle iq-waves-effect">
                                        <i class="ri-download-2-line"></i>
                                    </a>
                                    <div class="iq-sub-dropdown">
                                        <div class="iq-card shadow-none m-0">
                                            <div class="iq-card-body p-0 ">
                                                <?php
                                                $count_export = \App\Models\report_notification::select('id', 'admin_id')
                                                    ->where('admin_id', $admin_id)
                                                    ->count();
                                                $export_data = \App\Models\report_notification::select('id', 'admin_id', 'file_name', 'status', 'created_at', 'report_name')
                                                    ->where('admin_id', $admin_id)
                                                    ->orderBy('id', 'desc')
                                                    ->take(5)
                                                    ->get();
                                                ?>
                                                <div class="bg-primary p-3">
                                                    <h5 class="mb-0 text-white">Scheduled Export<small
                                                            class="badge  badge-light float-right pt-1">{{ $count_export }}</small>
                                                    </h5>
                                                </div>
                                                <div class="iq-sub-card download mh-300">
                                                    @if ($count_export > 0)
                                                        @foreach ($export_data as $ex_dt)
                                                            <div class="d-flex">
                                                                <div class="mr-3">
                                                                    <?php
                                                                    if ($ex_dt->report_name == 'kpi') {
                                                                        $name = public_path('report/pdf/' . $ex_dt->file_name . '.pdf');
                                                                    } else {
                                                                        $name = public_path('report/' . $ex_dt->file_name . '.csv');
                                                                    }
                                                                    ?>
                                                                    @if (file_exists($name))
                                                                        @if ($ex_dt->report_name == 'kpi')
                                                                            <a href="{{ asset('report/pdf/') }}/{{ $ex_dt->file_name }}.pdf"
                                                                                download="">
                                                                            @else
                                                                                <a href="{{ asset('report/') }}/{{ $ex_dt->file_name }}.csv"
                                                                                    download="">
                                                                        @endif
                                                                        <button type="button" class="btn p-0"><img
                                                                                class="avatar-30 rounded"
                                                                                src="{{ asset('assets/dashboard/') }}/images/cloud-computing.png"
                                                                                alt="tpms"></button>
                                                                        </a>
                                                                    @else
                                                                        <button type="button" class="btn p-0"><img
                                                                                class="avatar-30 rounded"
                                                                                src="{{ asset('assets/dashboard/') }}/images/cloud-computing.png"
                                                                                alt="tpms"></button>
                                                                    @endif
                                                                </div>
                                                                <div class="flex-fill right-side">
                                                                    <h6 title="{{ $ex_dt->file_name }}">
                                                                        {{ $ex_dt->file_name }}</h6>
                                                                    <div class="overflow-hidden rounded-0">
                                                                        @if ($ex_dt->report_name == 'kpi')
                                                                            <p class="float-left m-0 text-success">PDF
                                                                                File</p>
                                                                        @else
                                                                            <p class="float-left m-0 text-success">CSV
                                                                                File</p>
                                                                        @endif
                                                                    </div>
                                                                    {{-- <p class="text-muted m-0">{{\Carbon\Carbon::parse($ex_dt->created_at)->diffForHumans()}}</p> --}}
                                                                    <p class="m-0">
                                                                        {{ \Carbon\Carbon::parse($ex_dt->created_at)->diffForHumans() }}
                                                                    </p>
                                                                    @if ($ex_dt->status == 'Complete')
                                                                        <p class="badge badge-primary text-white">
                                                                            Ready To Download
                                                                        </p>
                                                                    @else
                                                                        <p class="badge badge-danger text-white">
                                                                            Pending
                                                                        </p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <p class="text-center"><strong>No Record</strong></p>
                                                    @endif
                                                </div>
                                                <div class="text-center my-2">
                                                    <a href="{{ route('superadmin.report.export.view') }}"
                                                        class="btn btn-sm btn-primary">
                                                        View More
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <ul class="navbar-list">
                            <li>
                                <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                                    <img src="{{ asset('assets/dashboard/') }}/images/user/1.jpg"
                                        class="img-fluid rounded mr-3" alt="user">
                                    <div class="caption">
                                        <h6 class="mb-0 line-height">{{ Auth::user()->name }}</h6>
                                        <span class="font-size-12">{{ Auth::user()->email }}</span>
                                    </div>
                                </a>
                                <div class="iq-sub-dropdown iq-user-dropdown">
                                    <div class="iq-card shadow-none m-0">
                                        <div class="iq-card-body p-0 ">
                                            <div class="bg-primary p-3">
                                                <h5 class="mb-0 text-white line-height">
                                                    Hello {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                                </h5>
                                                <span class="text-white font-size-12">{{ Auth::user()->email }}</span>
                                            </div>
                                            <a href="{{ route('superadmin.profile') }}"
                                                class="iq-sub-card iq-bg-primary-hover">
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
                                            </a>
                                            <a href="{{ route('superadmin.profile.change.password') }}"
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
                                                <a class="bg-primary iq-sign-btn"
                                                    href="{{ route('superadmin.logout') }}" role="button">Sign out<i
                                                        class="ri-login-box-line ml-2"></i></a>
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
                @yield('superadmin')
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    Copyright
                    <script>
                        document.write(new Date().getFullYear())
                    </script> &copy; <span class="text-primary">TherapyPMS.</span> All rights reserved.
                </div>
            </footer>
        </div>
    </div>
    <div class="modal fade" id="createClient" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Create Patient</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('superadmin.create.client') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label>First Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" name="client_first_name"
                                    required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Last Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" name="client_last_name"
                                    required>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>DOB<span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" name="client_dob"
                                    required>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Gender<span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm" name="client_gender" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>POS<span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm" name="location" required>
                                    <option value="Main Office">Main Office</option>
                                    <option value="Telehealth">Telehealth</option>
                                    <option value="Home">Home</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Email Address <i class="ri-question-line"
                                        title="To grant Client Portal access, enter an email address"></i><span
                                        class="text-danger"></span></label>
                                <div class="row no-gutters">
                                    <div class="col-md-8 mb-2">
                                        <input type="email" class="form-control form-control-sm" name="email">
                                    </div>
                                    <div class="col-md-4 pl-2 mb-2">
                                        <select class="form-control form-control-sm" name="email_type">
                                            <option value="Work">Work</option>
                                            <option value="Home">Home</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="email_reminder" value="1"
                                                    class="form-check-input">Send me an email reminder
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Phone Number<span class="text-danger"></span></label>
                                <div class="row no-gutters">
                                    <div class="col-md-8 mb-2">
                                        <input type="text" class="form-control form-control-sm"
                                            name="phone_number" data-mask="(000)-000-0000" pattern=".{14,}"
                                            autocomplete="off" maxlength="14">
                                    </div>
                                    <div class="col-md-4 pl-2 mb-2">
                                        <select class="form-control form-control-sm" name="phone_type">
                                            <option value="Work">Work</option>
                                            <option value="Home">Home</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="is_send_sms"
                                                    value="1">Send
                                                me a text message
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="is_voice_sms"
                                                    value="1">Send
                                                me a voice message
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary ladda-button" data-style="expand-right">Create
                            &
                            Continue
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
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
                    <div class="progress app_progress"
                        style="height: 7px; margin-top: -17px; margin-left: -15px; margin-right: -15px; margin-bottom: 5px; background-color: white;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                            role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                            style="width: 0%"></div>
                    </div>
                    <form action="{{ route('superadmin.appoinment.save') }}" id="sc_form" method="post"
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
                                <select class="form-control form-control-sm client_name" id="sc_client_id"
                                    name="client_id" required>
                                    <option></option>
                                </select>
                                <div class="invalid-feedback error_client">Enter Patient Name</div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Auth</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm" name="authorization_id" id="sc_auth_id"
                                    required>
                                </select>
                                <div class="invalid-feedback error_auth">Enter Auth</div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Service</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm" name="activity_id" id="sc_act_id"
                                    required>
                                </select>
                                <div class="invalid-feedback error_activity">Enter Service</div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Provider Name</label>
                            </div>
                            <div class="col-md-8 mb-2" id="sc_provider_box">
                                <select class="form-control form-control-sm" name="provider_id"
                                    id="sc_provider_id"required>
                                </select>
                                <div class="invalid-feedback error_provider">Enter Provider Name</div>
                            </div>
                            <div class="col-md-8 mb-2" id="sc_nb_provider_box">
                                <div class="input-group">
                                    <select class="form-control form-control-sm multiselect" id="sc_nb_provider_id"
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
                                    @foreach ($poin_service as $pos_ser)
                                        <option value="{{ $pos_ser->pos_code }}">{{ $pos_ser->pos_name }}
                                            ({{ $pos_ser->pos_code }})
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
                                    <input class="form-control form-control-sm" type="text" readonly
                                        autocomplete="nope" placeholder="mm/dd/yyyy" id="datepicker_appoint">
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
                                        <input class="form-control form-control-sm" type="time" id="sc_from_time"
                                            required>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <label>To Time</label>
                                    </div>
                                    <div class="col-md">
                                        <input class="form-control form-control-sm" type="time" id="sc_to_time"
                                            required>
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
                                        <input class="form-control form-control-sm" type="text" readonly
                                            autocomplete="nope" placeholder="mm/dd/yyyy" id="datepicker_endpoint">
                                    </div>
                                </div>
                                <div class="perday" id="week_days_box">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input sc_day_name"
                                                value="Sunday" name="day_name[]">SU
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input sc_day_name"
                                                value="Monday" name="day_name[]">MO
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input sc_day_name"
                                                value="Tuesday" name="day_name[]">TU
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input sc_day_name"
                                                value="Wednesday" name="day_name[]">WE
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input sc_day_name"
                                                value="Thursday" name="day_name[]">TH
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input sc_day_name"
                                                value="Friday" name="day_name[]">FR
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input sc_day_name"
                                                value="Saturday" name="day_name[]">SA
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
                    <div class="progress su_progress"
                        style="height: 7px; margin-top: -17px; margin-left: -15px; margin-right: -15px; margin-bottom: 5px; background-color: white;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                            role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                            style="width: 0%"></div>
                    </div>
                    <form id="su_form" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-4 show_viewbtndiv1 align-self-center mb-2"></div>
                            <div class="col-md-8 show_viewbtndiv align-self-center mb-2">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-sm btn-success telehealth_session_id"
                                            data-id="" data-toggle="modal" data-target="#vdoApp">
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
                                <input type="email" class="form-control form-control-sm client_email"
                                    value="" readonly>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Patient Name</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm client_name" id="su_client_id"
                                    name="client_id" required>
                                    <option></option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Auth</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm" name="authorization_id" id="su_auth_id"
                                    required>
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Service</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm" name="activity_id" id="su_act_id"
                                    required>
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Provider Name</label>
                            </div>
                            <div class="col-md-8 mb-2" id="su_provider_box">
                                <select class="form-control form-control-sm" name="provider_id"
                                    id="su_provider_id"required>
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
                                    @foreach ($poin_service as $pos_ser)
                                        <option value="{{ $pos_ser->pos_code }}">{{ $pos_ser->pos_name }}
                                            ({{ $pos_ser->pos_code }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label> From Date</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <div class="input-group">
                                    <input class="form-control form-control-sm" type="text" readonly
                                        autocomplete="nope" placeholder="mm/dd/yyyy" id="su_from_date">
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
                                        <input class="form-control form-control-sm" type="time" id="su_from_time"
                                            required>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <label>To Time</label>
                                    </div>
                                    <div class="col-md">
                                        <input class="form-control form-control-sm" type="time" id="su_to_time"
                                            required>
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
                    <button type="button" class="btn btn-primary" id="su_sub_lock_btn">Appointment is
                        Locked</button>
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

    <script src="{{ asset('assets/dashboard/') }}/js/jquery.min.js"></script>
    <script src="{{ asset('assets/dashboard/') }}/js/popper.min.js"></script>
    <script src="{{ asset('assets/dashboard/') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/dashboard/') }}/vendor/multiselect/bootstrap-multiselect.js"></script>
    <script src="{{ asset('assets/dashboard/') }}/vendor/multiselect/multiselect-activation.js"></script>
    <script src="{{ asset('assets/dashboard/') }}/vendor/date-picker/moment.min.js"></script>
    <!-- Plugin -->
    <script src="{{ asset('assets/dashboard/') }}/vendor/date-time/flatpickr.js"></script>
    <script src="{{ asset('assets/dashboard/') }}/vendor/date-time/flatpickr-activation.js"></script>
    <script src="{{ asset('assets/dashboard/') }}/vendor/date-picker/daterangepicker.js"></script>
    <script src="{{ asset('assets/dashboard/') }}/vendor/date-picker/daterangepicker.js"></script>
    <script src="{{ asset('assets/dashboard/') }}/vendor/date/mc-calendar.min.js"></script>
    <script src="{{ asset('assets/dashboard/') }}/vendor/date/mc-calendar-activation.js"></script>
    <script src="{{ asset('assets/dashboard/') }}/vendor/lightbox/lightbox.js"></script>
    <script src="{{ asset('assets/dashboard/') }}/vendor/jquery.mask.js"></script>
    <!-- Custom JavaScript -->
    <script src="{{ asset('assets/dashboard/') }}/js/custom.js"></script>
    <script src="{{ asset('assets/dashboard/') }}/vendor/calendar/lib/main.js"></script>
    <script src="{{ asset('assets/dashboard/') }}/vendor/table-sorting/jquery.tablesorter.js"></script>
    <script src="{{ asset('assets/dashboard/') }}/vendor/table-sorting/jquery.tablesorter-activation.js"></script>
    <script src="{{ asset('assets/') }}/toastr/build/toastr.min.js"></script>
    <!-- toastr init -->
    <script src="{{ asset('assets/') }}/toastr/toastr.init.js"></script>
    <!-- Export Plugin -->
    <script src="{{ asset('assets/') }}/dashboard/js/report_export/libs/jsPDF/jspdf.umd.min.js"></script>
    <script src="{{ asset('assets/') }}/dashboard/js/report_export/libs/js-xlsx/xlsx.core.min.js"></script>
    <script src="{{ asset('assets/') }}/dashboard/js/report_export/tableExport.min.js"></script>
    <script src="{{ asset('assets/') }}/dashboard/js/emojionearea.min.js"></script>
    <!-- toastr init -->
    @yield('js')
    <script>
        function initFreshChat() {
            window.fcWidget.init({
                token: "5e3f6a84-bc82-4af1-8192-786e2221942e",
                host: "https://wchat.in.freshchat.com"
            });
        }

        function initialize(i, t) {
            var e;
            i.getElementById(t) ? initFreshChat() : ((e = i.createElement("script")).id = t, e.async = !0, e.src =
                "https://wchat.in.freshchat.com/js/widget.js", e.onload = initFreshChat, i.head.appendChild(e))
        }

        function initiateCall() {
            initialize(document, "Freshdesk Messaging-js-sdk")
        }
        window.addEventListener ? window.addEventListener("load", initiateCall, !1) : window.attachEvent("load",
            initiateCall, !1);
    </script>
    @livewireScripts
    <script type="text/javascript">
        window.livewire.on('clientstore', () => {
            $('#createClient').modal('hide');
            swal("Client Successfully Created", "", "success");
        });
    </script>
    <script>
        // @see https://docs.headwayapp.co/widget for more configuration options.
        var HW_config = {
            selector: "#wid_get", // CSS selector where to inject the badge
            account: "7vWVzJ"
        }
    </script>
    <script async src="https://cdn.headwayapp.co/widget.js"></script>
    <script>
        // jQuery(document).ready(function ($) {
        // 				$('#getdetail').click(function (event) {
        // 								/* Act on the event */
        // 								$('.schl_table').show();
        // 				});
        // 				// Recurrence
        // 				$('#rpcheck').click(function (event) {
        // 								$('.daily_div').toggle();
        // 				});
        // 				$('#dailychk').click(function (event) {
        // 								$('.enday_div').show();
        // 								$('.allday').hide();
        // 				});
        // 				$('#weeklychk').click(function (event) {
        // 								$('.enday_div').show();
        // 								$('.allday').show();
        // 				});
        // });
    </script>
    @include('superadmin.include.appoinemnt_js')
    <script>
        jQuery(document).ready(function($) {
            $('input').attr('autocomplete', 'nope');
            // $('.daily').hide();
            // $('.weekly').hide();
            // $('.endate').hide();
            // $('.perday').hide();
            // $('.rpattern').click(function (event) {
            // 				if ($(this).is(':checked')) {
            // 								$('.daily').show();
            // 								$('.weekly').show();
            // 								$('.endate').show();
            // 				} else {
            // 								$('.daily').hide();
            // 								$('.weekly').hide();
            // 								$('.endate').hide();
            // 								$('.perday').hide();
            // 				}
            // });
            // $('.daily').click(function (event) {
            // 				if ($(this).prop("checked", true)) {
            // 								$('.perday').hide();
            // 				}
            // });
            // $('.weekly').click(function (event) {
            // 				if ($(this).prop("checked", true)) {
            // 								$('.endate').show();
            // 								$('.perday').show();
            // 				}
            // });
        });
    </script>
    @include('layouts.message')
    <script type="text/javascript">
        var idleTime;
        $(document).ready(function() {
            // reloadPage();
            $('html').bind(
                'mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick',
                function() {
                    clearTimeout(idleTime);
                    // reloadPage();
                });
        });
        {{-- function reloadPage() { --}}
        {{-- clearTimeout(idleTime); --}}
        {{-- idleTime = setTimeout(function () { --}}
        {{-- window.location.href = "{{route('user.login.locked',Auth::user()->id)}}"; --}}
        {{-- }, 1000 * 60 * 60); --}}
        {{-- } --}}
        // 300000
    </script>

    <script></script>
</body>

</html>
