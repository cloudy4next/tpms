@extends('layouts.superadmin')
@section('superadmin')
    <style>
        .fc-dayGridDay-button {
            background: #FBC02D !important;
        }

        .fc-timeGridWeek-button {
            background: #4CAF50 !important;
        }

        .fc-dayGridMonth-button {
            background: #1E88E5 !important;
        }

        .fc-next-button, .fc-prev-button {
            background: #4CAF50 !important;
        }

        .fc-prevYear-button, .fc-nextYear-button {
            background: #1E88E5 !important;
        }

        .fc-today-button {
            background: #0AA6B7 !important;
        }
    </style>
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">

            <div class="d-flex justify-content-between">
                <div class="align-self-center">
                    <h5 class="common-title">Manage Appointment</h5>
                </div>
                <div class="align-self-center">

                    <a href="#filterModal" class="btn btn-sm btn-danger mb-3"
                       data-toggle="modal">Filter</a>
                    {{-- <a href="{{route('superadmin.calender.sync')}}" class="btn btn-sm btn-primary mb-3"
                       target="_blank">
                        Sync With Google
                        Calender
                    </a> --}}
                   {{--  <a href="{{route('superadmin.calender.sync')}}" target="_blank" title="Sync with Google">
                        <img class="mb-3" style="width:38px;" src="{{asset("assets/dashboard/images/google.png")}}">
                    </a> --}}
                    <button class="btn btn-primary mb-3" id="print_calendar">Print</button>
                </div>
            </div>


            <div class="modal fade" id="filterModal" data-backdrop="static">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Filter By</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label>Patient</label>
                                    <select
                                        class="form-control form-control-sm a_Patient_name calender_filter_client multiselect"
                                        name="provider_id"
                                        id="ses_emaployee_id"
                                        multiple required>
                                        @foreach($all_patients as $patients)
                                            <option value="{{$patients->id}}">{{$patients->client_full_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Provider</label>
                                    <select
                                        class="form-control form-control-sm employee_name calender_filter_employee multiselect"
                                        name="provider_id"
                                        id="ses_emaployee_id"
                                        multiple required>
                                            <option value="{{$emp->id}}">{{$emp->full_name}}</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Place of Service</label>
                                    <select class="form-control form-control-sm calender_filter_location">
                                        <option></option>
                                        @foreach($poin_service as $pos_ser)
                                            <option value="{{$pos_ser->pos_code}}">{{$pos_ser->pos_name}}
                                                ({{$pos_ser->pos_code}})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Date</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fa fa-calendar"></i></span>
                                        </div>
                                        <input
                                            class="form-control form-control-sm reportrange calender_filter_reportrange">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Status</label>
                                    <select class="form-control form-control-sm">
                                        <option></option>
                                        <option value="Scheduled">Scheduled</option>
                                        <option value="No Show">No Show</option>
                                        <option value="Hold">Hold</option>
                                        <option value="Cancelled by Client">Cancelled by Client</option>
                                        <option value="CC more than 24 hrs">CC more than 24 hrs</option>
                                        <option value="CC less than 24 hrs">CC less than 24 hrs</option>
                                        <option value="Cancelled by Provider">Cancelled by Provider</option>
                                        <option value="Rendered">Rendered</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary go_btn" id="calender_go_btn">Go</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Calendar -->

            <input type="hidden" class="c_id" value="">
            <input type="hidden" class="auth_id" value="">
            <input type="hidden" class="act_id" value="">
            <input type="hidden" class="prov_id" value="">
            <input type="hidden" class="is_clicked" value="0">

            <div class="border border-primary rounded p-2">
                <div id='calendar'></div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="callenderAppointement" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Edit Appoinment</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('superadmin.get.calender.data.update') }}" method="post"
                          class="needs-validation"
                          novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-4 show_viewbtndiv1 align-self-center mb-2"></div>
                            <div class="col-md-8 show_viewbtndiv align-self-center mb-2">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <button type="button"
                                                class="btn btn-sm btn-success start_btn"
                                                data-id="" data-toggle="modal" data-target="#vdoApp">
                                            <i class="ri-vidicon-fill align-middle mr-1"></i>
                                            <span class="align-middle"></span>Start Telehealth
                                            Appointment
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-4 show_viewbtndiv">
                            </div>
                            <div class="col-md-8 mb-2 show_viewbtndiv">
                                <input type="email" class="form-control form-control-sm client_email" value="" readonly>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label>Client Name</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm callender_client_name" id="client_name"
                                        name="callender_client_id" required>
                                    <option></option>
                                </select>
                                <input type="hidden" class="form-check-input callender_edit_single "
                                       name="callender_edit_single">
                                <div class="invalid-feedback">Enter Client Name</div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Auth</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm callender_authorization_id"
                                        name="callender_authorization_id"
                                        id="authorization_id" required>
                                </select>
                                <div class="invalid-feedback">Enter Auth</div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label>Activity</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm callender_activity_id"
                                        name="callender_activity_id"
                                        id="activity_id" required>
                                </select>
                                <div class="invalid-feedback">Enter Activity</div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label>Provider Name</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm callender_provider_id"
                                        name="callender_provider_id"
                                        id="provider_id" required>
                                </select>
                                <div class="invalid-feedback">Enter Provider Name</div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label>Location</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm callender_location" id="callender_location"
                                        name="callender_location"
                                        required>
                                    <option value=""></option>
                                    @foreach($poin_service as $pos_ser)
                                        <option value="{{$pos_ser->pos_code}}">{{$pos_ser->pos_name}}
                                            ({{$pos_ser->pos_code}})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Enter Location</div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label>From Date</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <div class="input-group">

                                    <input class="form-control form-control-sm callender_from_date"
                                           type="date" name="callender_from_date"
                                    >

                                    <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i
                                                                                    class="fa fa-calendar"></i></span>
                                    </div>
                                    <div class="invalid-feedback">Enter Date & Time</div>
                                </div>
                            </div>


                            <div class="col-md-4 mb-2">
                                <label>From Time</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <div class="row no-gutters">
                                    <div class="col-md">
                                        <input
                                            class="form-control form-control-sm callender_form_time"
                                            type="time" name="callender_form_time"
                                            required>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <label>To Time</label>
                                    </div>
                                    <div class="col-md">
                                        <input
                                            class="form-control form-control-sm callender_to_time"
                                            type="time" name="callender_to_time"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label>Status</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm callender_status" name="callender_status"
                                        id="status"
                                        required>
                                    <option></option>
                                    <option value="Scheduled">Scheduled</option>
                                    <option value="No Show">No Show</option>
                                    <option value="Hold">Hold</option>
                                    <option value="Cancelled by Client">Cancelled by Client</option>
                                    <option value="CC more than 24 hrs">CC more than 24 hrs</option>
                                    <option value="CC less than 24 hrs">CC less than 24 hrs</option>
                                    <option value="Cancelled by Provider">Cancelled by Provider</option>
                                    <option value="Rendered">Rendered</option>
                                </select>
                                <div class="invalid-feedback">Enter Status</div>
                            </div>


                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary ladda-button" data-style="expand-right"
                            id="submit_appoinments_callender">Save
                    </button>

                    <button type="button" class="btn btn-primary ladda-button" data-style="expand-right"
                            id="submit_appoinments_callender_locked">Appoinment Is Locked
                    </button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </form>
                </div>

            </div>
        </div>
    </div>





    <div class="modal fade" id="callenderAppointementCreate" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Create Appoinment</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('superadmin.get.calender.data.update') }}" method="post"
                          class="needs-validation"
                          novalidate>
                        @csrf
                        <div class="row">


                            <div class="col-md-4 mb-2">
                                <label>Client Name</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm cal_create_client" id="cal_create_client"
                                        name="cal_create_client" required>
                                    <option></option>
                                </select>
                                <div class="invalid-feedback">Enter Client Name</div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Auth</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm cal_create_auth"
                                        name="callender_authorization_id"
                                        id="authorization_id" required>
                                </select>
                                <div class="invalid-feedback">Enter Auth</div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label>Activity</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm cal_create_act"
                                        name="callender_activity_id"
                                        id="activity_id" required>
                                </select>
                                <div class="invalid-feedback">Enter Activity</div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label>Provider Name</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm cal_create_pro"
                                        name="callender_provider_id"
                                        id="provider_id" required>
                                </select>
                                <div class="invalid-feedback">Enter Provider Name</div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label>Location</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm cal_create_location" id="callender_location"
                                        name="callender_location"
                                        required>
                                    <option value=""></option>
                                    @foreach($poin_service as $pos_ser)
                                        <option value="{{$pos_ser->pos_code}}">{{$pos_ser->pos_name}}
                                            ({{$pos_ser->pos_code}})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Enter Location</div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label>From Date</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <div class="input-group">

                                    <input
                                        class="form-control form-control-sm cal_create_form_date"
                                        type="text"
                                        readonly autocomplete="nope"
                                        placeholder="mm/dd/yyyy"
                                        id="cal_create_form_date">

                                    <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i
                                                                                    class="fa fa-calendar"></i></span>
                                    </div>
                                    <div class="invalid-feedback">Enter Date & Time</div>
                                </div>
                            </div>


                            <div class="col-md-4 mb-2">
                                <label>From Time</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <div class="row no-gutters">
                                    <div class="col-md">
                                        <input
                                            class="form-control form-control-sm cal_create_from_time"
                                            type="time" name="callender_form_time"
                                            required>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <label>To Time</label>
                                    </div>
                                    <div class="col-md">
                                        <input
                                            class="form-control form-control-sm cal_create_to_time"
                                            type="time" name="callender_to_time"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label>Status</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm cal_create_status" name="callender_status"
                                        id="status"
                                        required>
                                    <option></option>
                                    <option value="Scheduled">Scheduled</option>
                                    <option value="No Show">No Show</option>
                                    <option value="Hold">Hold</option>
                                    <option value="Cancelled by Client">Cancelled by Client</option>
                                    <option value="CC more than 24 hrs">CC more than 24 hrs</option>
                                    <option value="CC less than 24 hrs">CC less than 24 hrs</option>
                                    <option value="Cancelled by Provider">Cancelled by Provider</option>
                                    <option value="Rendered">Rendered</option>
                                </select>
                                <div class="invalid-feedback">Enter Status</div>
                            </div>


                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary ladda-button" data-style="expand-right"
                            id="cal_create_app_save">Save
                    </button>


                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Vdo App -->
    <div class="modal fade" id="vdoApp" data-backdrop="static">
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
                                    <input type="checkbox" class="form-check-input">Restart your computer. Close
                                    background
                                    programs
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Test your internet connection speed.
                                    Speeds of
                                    10mpbs will provide the best experience. To check
                                    your speed, search Google speed test and click the
                                    blue button
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Confirm that the webcam, microphone,
                                    and
                                    speakers
                                    are working.
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Make sure the audio is not on mute
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Remove clutter and tidy office
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">To prevent interruptions during the
                                    session, set your
                                    cell phone to silent and consider hanging a “Do not
                                    disturb” sign
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">If necessary, contact a client’s
                                    insurance to obtain
                                    payment coverage authorization.
                                </label>
                            </div>
                        </div>
                        <div class="mb-2">
                            <h2 class="common-title mb-2">START OF SESSION</h2>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Verify client’s identity, if needed.
                                    Document full name
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Confirm client is in a safe, private
                                    place to talk
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Review the safety plan with client.
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Review the back-up plan in case the
                                    connection fails.
                                    Confirm their phone number on file.
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Inform the client of the potential
                                    risks and limitations of
                                    receiving treatment via Telehealth.
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Remind client that there are
                                    alternative, non-video therapy
                                    options
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Obtain verbal or written consent, if
                                    necessary, from the
                                    client for the use of Telehealth
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Emphasize the importance of
                                    consistent therapy
                                    attendance and homework completion.
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Review the protocol of the
                                    Telehealth visit and explain what
                                    the client can expect
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Emphasize the importance of speaking
                                    clearly.
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Mention that you may briefly look
                                    away or down when
                                    taking notes, but that doesn’t mean you aren’t listening
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Give client opportunity to ask
                                    questions about the session
                                </label>
                            </div>
                            <hr>

                </form>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input check_all"><b>Aknowledged All</b>
                    </label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary meet_start">Start your Session</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
    </div>




@endsection
@include('superadmin.employee.include.scheduleInclude')
