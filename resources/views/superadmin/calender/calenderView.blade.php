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
                    <a href="{{route('superadmin.calender.sync')}}" target="_blank" title="Sync with Google">
                        <img class="mb-3" style="width:38px;" src="{{asset("assets/dashboard/images/google.png")}}">
                    </a>
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
                                        @foreach($all_provider as $providers)
                                            <option value="{{$providers->id}}">{{$providers->full_name}}</option>
                                        @endforeach
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

@endsection
@include('superadmin.calender.include.callenderInclude')
