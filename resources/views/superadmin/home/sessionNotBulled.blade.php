@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-flex justify-content-between">
                <div class="align-self-center mb-2">
                    <h2 class="common-title m-0">Activities Ready to Bill Not Billed</h2>
                </div>
                <div class="align-self-center mb-2">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <div class="dropdown">
                                <button class="btn btn-sm p-0 dropdown-toggle" type="button"
                                    data-toggle="dropdown">
                                    <i class="ri-download-2-line"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right download-icon-show">

                                    <a class="dropdown-item" href="#" id="download_pdf"><i class="fa fa-file-pdf-o mr-2 text-danger"></i>Download PDF</a>
                                    <a class="dropdown-item" href="#" id="download_csv"><i class="fa fa-file-excel-o mr-2 text-success"></i>Download CSV</a>
                                </div>
                            </div>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{route('superadmin.dashboard')}}" class="btn btn-sm btn-primary"
                                            title="Back to dashboard"><i
                            class="ri-arrow-left-circle-line mr-1 align-middle"></i>Back</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered c_table" id="export_table">
                    <thead>
                    <tr>
                        <th>Insurance</th>
                        <th>Patient Last Name</th>
                        <th>Patient First Name</th>
                        <th>Activity Type</th>
                        <th>Date of Service</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($count_app as $sess)
                        <?php
                        $client = \App\Models\Client::select('client_first_name', 'client_last_name')->where('id', $sess->client_id)->first();
                        $payor_name = \App\Models\All_payor::select('payor_name')->where('id', $sess->payor_id)->first();
                        $act = \App\Models\Client_authorization_activity::select('activity_name')->where('id', $sess->authorization_activity_id)->first();
                        ?>
                        <tr>
                            <td>
                                @if ($payor_name)
                                    {{$payor_name->payor_name}}
                                @endif

                            </td>
                            <td>
                                @if ($client)
                                    {{$client->client_last_name}}
                                @endif

                            </td>
                            <td>
                                @if ($client)
                                    {{$client->client_first_name}}
                                @endif

                            </td>
                            <td>
                                @if ($act)
                                    {{$act->activity_name}}
                                @endif

                            </td>
                            <td>
                                @if ($sess)
                                    {{\Carbon\Carbon::parse($sess->schedule_date)->format('m/d/Y')}}
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <input type="hidden" value="ReadyToBill_" id="fileName">

@endsection
@include('superadmin.home.include.export_include')
