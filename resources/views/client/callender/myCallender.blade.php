@extends('layouts.client')
@section('client')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <h2 class="common-title">Manage Appointment</h2>
            <!-- Filter -->
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


    <div class="modal fade" id="createAppointement" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Update Appoinments</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('client.calender.appoinment.update.single') }}" method="post"
                          class="needs-validation"
                          novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label>App Type</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <div class="form-check-inline">
                                    <div class="custom-control custom-switch app-switch">
                                        <input type="checkbox" class="custom-control-input" id="accccc">
                                        <label class="custom-control-label" for="accccc">Billable</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Client Name</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm client_name" id="client_name"
                                        name="callender_client_id" readonly required>
                                    <option></option>
                                </select>
                                <input type="hidden" class="callender_edit_single" name="callender_edit_single">
                                <div class="invalid-feedback">Enter Client Name</div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Auth</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm authorization_id"
                                        name="callender_authorization_id" readonly
                                        id="authorization_id" required>
                                </select>
                                <div class="invalid-feedback">Enter Auth</div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label>Activity</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm activity_id" name="callender_activity_id"
                                        id="activity_id" readonly required>
                                </select>
                                <div class="invalid-feedback">Enter Activity</div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label>Provider Name</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm provider_id" name="callender_provider_id"
                                        id="provider_id" readonly required>
                                </select>
                                <div class="invalid-feedback">Enter Provider Name</div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label>Location</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm location" id="location" readonly
                                        name="callender_location"
                                        required>
                                    <option value=""></option>
                                    <option value="03">School (03)</option>
                                    <option value="11">Office (11)</option>
                                    <option value="12">Home (12)</option>
                                    <option value="99">Other Place of Service (99)</option>
                                    <option value="02">Telehealth (02)</option>
                                    <option value="41">Ambulance-Land (41)</option>
                                    <option value="53">Community Mental Health Center (53)</option>
                                </select>
                                <div class="invalid-feedback">Enter Location</div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label>Time Duration</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm time_duration" readonly
                                        name="callender_time_duration"
                                        id="time_duration" required>
                                    <option></option>
                                    <option value="15">15 mins</option>
                                    <option value="30">30 mins</option>
                                    <option value="45">45 mins</option>
                                    <option value="60">1 Hour</option>
                                    <option value="75">1 Hour 15 mins</option>
                                    <option value="90">1 Hour 30 mins</option>
                                    <option value="105">1 Hour 45 mins</option>
                                    <option value="120">2 Hour</option>
                                    <option value="135">2 Hour 15 mins</option>
                                    <option value="150">2 Hour 30 mins</option>
                                    <option value="165">2 Hour 45 mins</option>
                                    <option value="180">3 Hour</option>
                                    <option value="195">3 Hour 15 mins</option>
                                    <option value="210">3 Hour 30 mins</option>
                                    <option value="225">3 Hour 45 mins</option>
                                    <option value="240">4 Hour</option>
                                    <option value="255">4 Hour 15 mins</option>
                                    <option value="270">4 Hour 30 mins</option>
                                    <option value="285">4 Hour 45 mins</option>
                                    <option value="300">5 Hour</option>
                                    <option value="315">5 Hour 15 mins</option>
                                    <option value="330">5 Hour 30 mins</option>
                                    <option value="345">5 Hour 45 mins</option>
                                    <option value="360">6 Hour</option>
                                    <option value="375">6 Hour 15 mins</option>
                                    <option value="390">6 Hour 30 mins</option>
                                    <option value="405">6 Hour 45 mins</option>
                                    <option value="420">7 Hour</option>
                                    <option value="435">7 Hour 15 mins</option>
                                    <option value="450">7 Hour 30 mins</option>
                                    <option value="465">7 Hour 45 mins</option>
                                    <option value="480">8 Hour</option>
                                    <option value="495">8 Hour 15 mins</option>
                                    <option value="510">8 Hour 30 mins</option>
                                    <option value="525">8 Hour 45 mins</option>
                                    <option value="540">9 Hour</option>
                                    <option value="555">9 Hour 15 mins</option>
                                    <option value="570">9 Hour 30 mins</option>
                                    <option value="585">9 Hour 45 mins</option>
                                    <option value="600">10 Hour</option>
                                </select>
                                <div class="invalid-feedback">Enter Time Duration</div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label>Date & Time</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <div class="input-group">

                                    <input class="form-control form-control-sm from_time calendar-date-time"
                                           name="callender_from_time" readonly type="datetime-local" required>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label>Status</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm status" readonly name="callender_status"
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
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


@endsection

@include('client.callender.include.g_callender')
