<?php

if (Auth::user()->is_up_admin == 1) {
    $admin_id = Auth::user()->id;
} else {
    $admin_id = Auth::user()->up_admin_id;
}

?>

@extends('layouts.superadmin')
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
@endsection
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
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
            <div class="d-flex">
                <!-- Client Name -->
                <div class="mr-2 mb-2 patient">
                    <label>Patients</label>
                    <select class="form-control form-control-sm ses_client_id multiselect" name="ses_client_id"
                        id="ses_client_id" multiple required>
                    </select>
                </div>
                <!-- Provider Name -->
                <div class="mr-2 mb-2">
                    <label>Provider</label>
                    <select class="form-control form-control-sm ses_emaployee_id multiselect" name="provider_id"
                        id="ses_emaployee_id" multiple required>
                    </select>
                </div>
                <!-- Location -->
                <div class="mr-2 mb-2 pos">
                    <label>Place Of Service</label>
                    <select class="form-control form-control-sm ses_location">
                        <option></option>
                        <option value="03">School (03)</option>
                        <option value="11">Office (11)</option>
                        <option value="12">Home (12)</option>
                        <option value="99">Others (99)</option>
                        <option value="02">Telehealth (02)</option>
                    </select>
                </div>
                <!-- Date Range -->
                <div class="mr-2 mb-2 date">
                    <label>Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input class="form-control form-control-sm ses_reportrange reportrange" readonly>
                    </div>
                </div>
                <!-- Status -->
                <div class="mr-2 mb-2 status">
                    <label>Status</label>
                    <select class="form-control form-control-sm ses_status">
                        <option></option>
                        <option>Scheduled</option>
                        <option>No Show</option>
                        <option>Hold</option>
                        <option>Cancelled by Client</option>
                        <option>CC more than 24 hrs</option>
                        <option>CC less than 24 hrs</option>
                        <option>Cancelled by Provider</option>
                        <option>Rendered</option>
                    </select>
                </div>

                <div class="align-self-end mb-2">
                    <button type="button" class="btn btn-sm btn-primary go_btn" id="getdetailappoinment">Go</button>
                </div>
                <div class="align-self-end ml-auto download_div">
                    <div class="dropdown">
                        <button class="btn btn-sm p-0 dropdown-toggle" type="button" data-toggle="dropdown">
                            <i class="ri-download-2-line"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right download-icon-show">
                            <a class="dropdown-item" href="#" id="download_pdf"><i
                                    class="fa fa-file-pdf-o mr-2 text-danger"></i>Download PDF</a>
                            <a class="dropdown-item" href="#" id="download_csv"><i
                                    class="fa fa-file-excel-o mr-2 text-success"></i>Download CSV</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table -->
            <div class="calendar_table session_table">
                <div class="table-responsive appointement_page" onscroll="GetScrollerEndPoint()">
                    <table class="table table-sm table-bordered c_table ses_table appointment" id="export_table">
                        <thead>
                            <tr>
                                <th data-tableexport-display="none" class="checkbox1_th"><input type="checkbox"
                                        class="session_check_all"></th>
                                <th data-tableexport-display="none" class="lock_th"><i class="ri-lock-line text-white"
                                        title="Lock"></i>
                                </th>
                                <th class="p_th_remove patient_th">Patients</th>
                                <th class="s_th_remove service_th" style="max-width:200px" data-tableexport-display="none">Service & Hrs.</th>
                                <th data-tableexport-display="always" style="display:none;">Service</th>
                                <th data-tableexport-display="always" style="display:none;">Hours</th>
                                <th style="display:none;" data-tableexport-display="always">Auth Number</th>
                                <th style="max-width:200px" class="provider_th">Provider</th>
                                <th class="pos_th">POS</th>
                                <th class="sch_date_th">Scheduled Date</th>
                                <th class="hrs_th">Hours</th>
                                <th class="status_th">Status</th>
                                <th class="action_th" style="width:50px" data-tableexport-display="none">Action</th>
                            </tr>
                        </thead>

                        <tbody class="show_data">

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
                                    <td class="p_th_remove">
                                        <div class="comment br animate"></div>
                                    </td>
                                    <td class="s_th_remove">
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
                <div class="d-flex option_div">
                    <div class="mr-2 select_box">
                        <select class="form-control form-control-sm chnage_session_status">
                            <option value=""></option>
                            <option value="Scheduled">Scheduled</option>
                            <option value="No Show">No Show</option>
                            <option value="Hold">Hold</option>
                            <option value="Cancelled by Client">Cancelled by Client</option>
                            <option value="Cancelled by Provider">Cancelled by Provider</option>
                            <option value="Rendered">Rendered</option>
                            <option value="Bulk Delete">Bulk Delete</option>
                        </select>
                    </div>

                    <div class="align-self-end select_btn">
                        <button class="btn btn-sm btn-primary" id="update_status">Go</button>
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
    </div>
    <div class="modal fade" id="formNote" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <form action="{{ route('superadmin.session.note.form.open') }}" method="post" target="_blank">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Add Notes</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>Select Form</label>
                        <select class="form-control form-control-sm formType" name="note_id">
                        </select>
                        <input type="hidden" name="from_session_id" class="from_session_id_hidden">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="noteSubmit">
                            Go
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <div class="modal fade" id="createdFormNote" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <form action="{{ route('superadmin.session.note.createdform.open') }}" method="post" target="_blank">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>View Notes</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>Select Form</label>
                        <select class="form-control form-control-sm CreatedformType" name="created_note_id">
                        </select>
                        <input type="hidden" name="created_from_session_id" class="created_from_session_id_hidden">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="noteSubmit">
                            Go
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@include('superadmin.appoinment.include.manage_sesstion_include')
