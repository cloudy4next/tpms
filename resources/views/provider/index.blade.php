@extends('layouts.provider')
@section('provider')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <!-- title -->
            <div class="overflow-hidden mb-2">
                <div class="float-left">
                    <h5 class="m-0">Manage Sessions</h5>
                </div>
                <div class="float-right"><a href="{{ route('provider.calender') }}" class="btn btn-sm btn-primary"><i
                            class="fa fa-calendar" aria-hidden="true"></i> Calender View</a></div>
            </div>
            <div class="overflow-hidden">
                <div class="float-left">
                    <h5 class="common-title">Manage Sessions</h5>
                </div>
                <div class="float-right">
                    <div class="custom-control custom-switch billable-switch">
                        <input type="checkbox" class="custom-control-input ses_app_type" id="bn" checked>
                        <label class="custom-control-label" for="bn">Billable</label>
                    </div>
                </div>
            </div>
            <!-- filter -->
            <div class="d-flex">
                <div class="mr-2 mb-2">
                    <label>Provider</label>
                    <select class="form-control form-control-sm ses_proiders">
                        <option value="{{ $providers->id }}">{{ $providers->full_name }}</option>
                    </select>
                </div>
                <div class="mr-2 mb-2 schedule-filter">
                    <label>Search By</label>
                    <select class="form-control form-control-sm search_by">
                        <option value=""></option>
                        {{-- <option value="1">Today</option> --}}
                        {{-- <option value="2">Tomorrow</option> --}}
                        {{-- <option value="3">Yesterday</option> --}}
                        {{-- <option value="4">Next 7 days</option> --}}
                        {{-- <option value="5">Date Range</option> --}}
                        <option value="6">Client</option>
                        {{-- <option value="7">Last 15 days</option> --}}
                        {{-- <option value="8">Next 15 days</option> --}}
                        {{-- <option value="9">Last 30 days</option> --}}
                        {{-- <option value="10">Next 30 days</option> --}}
                        {{-- <option value="11">Pay period</option> --}}
                    </select>
                </div>

                <div class="mb-2 mr-2 client-filter">
                    <label>Client</label>
                    <select class="form-control form-control-sm ses_client multiselect" id="ses_client" multiple required>
                    </select>
                </div>
                <div class="mb-2 mr-2 daterange-filter">
                    <label>Date Range</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input class="form-control form-control-sm reportrange date_ranger">
                    </div>
                </div>
                <div class="mb-2 mr-2 payperiod-filter">
                    <label>Pay Period</label>
                    <select class="form-control form-control-sm">
                        <option>Select</option>
                        <option>12/13/2021-12/26/21</option>
                        <option>12/13/2021-12/26/21</option>
                    </select>
                </div>
                <div class="align-self-end mb-2">
                    <button type="button" class="btn btn-sm btn-primary goBtn" id="go_btn">Go</button>
                </div>
            </div>
            <!-- table -->
            <div class="providerScheduler-table">

                <div class="table-responsive">
                    <table class="table table-sm table-bordered c_table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="session_check_all"></th>
                                <th><i class="ri-lock-line text-white" title="Lock"></i></th>
                                <th class="p_th_remove b_col">Patients</th>
                                <th class="s_th_remove b_col" style="max-width:200px">Service & Hrs.</th>
                                <th style="max-width:200px">Provider</th>
                                <th>POS</th>
                                <th>Scheduled Date</th>
                                <th>Hours</th>
                                <th>Status</th>
                                <th style="width:50px">Action</th>
                            </tr>
                        </thead>
                        <tbody class="all_secction">
                        </tbody>
                        <tbody class="show_animation">
                            @for ($i = 0; $i < 40; $i++)
                                <tr data-tableexport-display="none">
                                    <td>
                                        <div class="comment br animate"></div>
                                    </td>
                                    <td>
                                        <div class="comment br animate"></div>
                                    </td>
                                    <td class="p_th_remove b_col">
                                        <div class="comment br animate"></div>
                                    </td>
                                    <td class="s_th_remove b_col">
                                        <div class="comment br animate"></div>
                                    </td>
                                    <td>
                                        <div class="comment br animate"></div>
                                    </td>
                                    <td>
                                        <div class="comment br animate"></div>
                                    </td>
                                    <td>
                                        <div class="comment br animate"></div>
                                    </td>
                                    <td>
                                        <div class="comment br animate"></div>
                                    </td>
                                    <td>
                                        <div class="comment br animate"></div>
                                    </td>
                                    <td>
                                        <div class="comment br animate"></div>
                                    </td>

                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <div class="d-flex">
                    <div class="mr-2 select-box">
                        <select class="form-control form-control-sm action_type">
                            <option value="0"></option>
                            <option value="1">Delete</option>
                            <option value="2">Monthly utilization & total utilization</option>
                            {{-- <option value="3">Open attached auth</option> --}}
                            <option value="4">Rendered all selected session</option>
                        </select>
                    </div>
                    <div class="align-self-end select_btn">
                        {{-- <a href="#" class="btn btn-sm btn-primary" >OK</a> --}}
                        <button class="btn btn-sm btn-primary" id="okBtn">OK</button>
                    </div>
                </div>
                <!-- Activity Table -->
                <div class="table-responsive activity-table utilization_table">

                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="signatureModalPatient" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <form method="post" id="client_sing_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Add signature</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#drawsig">Draw</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#uploadsig">Upload</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="selectsig">
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <label>Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="sig-name">
                                    </div>
                                </div>
                                <label>Preview</label>
                                <div class="signature-preview">
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="drawsig">
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <canvas id="sig-canvas"></canvas>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger p-2" id="sig-clearBtn">Clear
                                </button>
                                <input type="hidden" class="form-control-file sing_draw_txt" name="sing_draw_txt">
                                <input type="hidden" class="form-control-file sing_seccid" name="sessionid">
                                <input type="hidden" class="client_sing_id" name="sess_client_id">
                            </div>
                            <div class="tab-pane fade" id="uploadsig">
                                <label>Upload File</label>
                                <input type="file" class="form-control-file" name="sing_file">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary" id="sig-submitBtn">Save
                            Signature
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" id="signatureModalProvider" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <form method="post" id="client_sing_form_provider" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Add signature</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#drawsig1">Draw</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#uploadsig1">Upload</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="selectsig1">
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <label>Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="sig-name">
                                    </div>
                                </div>
                                <label>Preview</label>
                                <div class="signature-preview">
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="drawsig1">
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <canvas id="sig-canvas2" height="120" style="width: 100%;"></canvas>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger p-2" id="sig-clearBtn2">
                                    Clear
                                </button>
                                <input type="hidden" class="form-control-file sing_draw_txt_provider"
                                    name="sing_draw_txt_provider">
                                <input type="hidden" class="form-control-file sing_seccid_provider"
                                    name="sessionid_provider">
                                <input type="hidden" class="client_sing_id_provider" name="sess_client_id_provider">
                            </div>
                            <div class="tab-pane fade" id="uploadsig1">
                                <label>Upload File</label>
                                <input type="file" class="form-control-file" name="sing_file2">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary" id="">Save
                            Signature
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" id="viewSignature" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Signature</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#patSig">Patient
                                Signature</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#providerSig">Provider Signature</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="patSig">
                            <div class="show-sig">
                                <img src="" alt="Signature" class="img-fluid client_sig_image">
                                <p class="mt-2 client_sig_date"></p>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="providerSig">
                            <div class="show-sig">
                                <img src="" alt="Signature" class="img-fluid provider_sig_image">
                                <p class="mt-2 provider_sig_date"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addressModal" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Treatment Location</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body address_modal_body">

                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-primary">Go to Google Maps</a>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formNote" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm">
            <form action="{{ route('provider.session.note.form.open') }}" method="post" target="_blank">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Add Notes</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Select Form</label>
                                <select class="form-control form-control-sm formType" name="note_id">
                                </select>
                                <input type="hidden" name="from_session_id" class="from_session_id_hidden">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="noteSubmit">Go</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="createdFormNote" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm">
            <form action="{{ route('provider.session.note.createdform.open') }}" method="post" target="_blank">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>View Notes</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Select Form</label>
                                <select class="form-control form-control-sm CreatedformType" name="created_note_id"
                                    style="max-width: 300px;">
                                </select>
                                <input type="hidden" name="created_from_session_id"
                                    class="created_from_session_id_hidden">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="noteSubmit">Go</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade apmodelclose" id="eeditAppointement" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Edit Appoinments</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="appoinemtnsubmitform" method="post" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-4 show_viewbtndiv1 align-self-center mb-2 telehealth_check"></div>
                            <div class="col-md-8 show_viewbtndiv align-self-center mb-2 telehealth_check">
                                <ul class="list-inline ">
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-sm btn-success telehealth_session_id"
                                            data-id="" data-toggle="modal" data-target="#vdoApp">
                                            <i class="ri-vidicon-fill align-middle mr-1"></i>
                                            <span class="align-middle"></span>Start Telehealth
                                            Appointment
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-4 show_viewbtndiv telehealth_check">
                            </div>
                            <div class="col-md-8 mb-2 show_viewbtndiv telehealth_check">
                                <input type="email" class="form-control form-control-sm client_email" value=""
                                    readonly>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Patient Name</label>
                            </div>
                            <div class="col-md-8 mb-2 billable_check_true">
                                <select class="form-control form-control-sm client_name session_app_client_name"
                                    id="client_name" name="client_id" disabled>
                                </select>
                                <div class="invalid-feedback error_client">Enter Patient Name</div>
                                <input type="hidden" class="form-check-input edit_sess_id" name="edit_sess_id"
                                    value="0">
                            </div>

                            <div class="col-md-8 mb-2 billable_check_false">
                                <select class="form-control form-control-sm client_name session_app_client_name"
                                    id="client_name" name="client_id" disabled>
                                </select>
                                <div class="invalid-feedback error_client">Enter Patient Name</div>
                                <input type="hidden" class="form-check-input edit_sess_id" name="edit_sess_id"
                                    value="0">
                            </div>

                            <div class="col-md-4 mb-2">
                                <label>Auth</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm session_app_client_auth"
                                    name="authorization_id" id="authorization_id" disabled required>
                                </select>
                                <div class="invalid-feedback error_auth">Enter Auth</div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Service</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm session_app_client_act" name="activity_id"
                                    id="activity_id" disabled required>
                                </select>
                                <div class="invalid-feedback error_activity">Enter Service</div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Provider Name</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm session_app_provider" name="provider_id"
                                    id="provider_id" disabled required>
                                </select>
                                <div class="invalid-feedback error_provider">Enter Provider Name</div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>POS</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <?php
                                $poin_service = \App\Models\point_of_service::where('admin_id', Auth::user()->admin_id)->get();
                                ?>
                                <select class="form-control form-control-sm session_app_location" id="location"
                                    name="location" disabled required>
                                    <option value=""></option>
                                    @foreach ($poin_service as $pos_ser)
                                        <option value="{{ $pos_ser->pos_code }}">{{ $pos_ser->pos_name }}
                                            ({{ $pos_ser->pos_code }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback error_location">Enter Location</div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>From Date</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <div class="input-group">
                                    <input class="form-control form-control-sm proup_app_date_time" type="text"
                                        readonly autocomplete="nope" placeholder="mm/dd/yyyy" id="proup_app_date_time">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <div class="invalid-feedback">Enter Date &
                                        Time
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>From Time</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <div class="row no-gutters">
                                    <div class="col-md-5">
                                        <input class="form-control form-control-sm proedit_sess_start_time" type="time"
                                            readonly required>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <label class="mt-1">To Time</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control form-control-sm proedit_sess_to_time" type="time"
                                            readonly required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Status</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm session_app_time_status" name="status"
                                    id="status" required>
                                    <option value=""></option>
                                    <option value="Scheduled">
                                        Scheduled
                                    </option>
                                    <option value="No Show">
                                        No Show
                                    </option>
                                    <option value="Hold">
                                        Hold
                                    </option>
                                    <option value="Cancelled by Client">
                                        Cancelled by Client
                                    </option>
                                    <option value="CC more than 24 hrs">
                                        CC more than 24 hrs
                                    </option>
                                    <option value="CC less than 24 hrs">
                                        CC less than 24 hrs
                                    </option>
                                    <option value="Cancelled by Provider">
                                        Cancelled by Provider
                                    </option>
                                    <option value="Rendered">
                                        Rendered
                                    </option>
                                </select>
                                <div class="invalid-feedback error_status">Enter Status</div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary app_not_locket" id="update_appoinment">
                        Save
                    </button>
                    <button type="button" class="btn btn-primary ladda-button app_locked" data-style="expand-right"
                        id="submit_appoinments_locked">Appoinment Is Locked.
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Vdo App -->
    <div class="modal fade" id="vdoApp" data-backdrop="static" style="z-index: 99999;">
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
    <style>
        .modal {
            position: fixed;
            top: 3%;
            right: 3%;
            left: 3%;
            width: auto;
            margin: 0;
        }

        .modal-body {
            height: 60%;
            max-height: 350px;
            padding: 15px;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        #sig-canvas,
        #sig-canvas2 {
            margin-top: 20px;
        }

        #signatureModalPatient .modal-content .modal-body,
        #signatureModalProvider .modal-content .modal-body {
            display: -webkit-box;
            display: -ms-flexbox;
            display: block;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            height: 50vh !important;
            width: 100%;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            margin: 0;
            padding: 32px 16px;
            font-family: Helvetica, Sans-Serif;
        }
    </style>
@endsection
@include('provider.include.providerhome')
