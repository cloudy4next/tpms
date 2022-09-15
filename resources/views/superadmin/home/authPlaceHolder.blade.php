@extends('layouts.superadmin')
@section('superadmin')
    <style>
        .down_icons {
            font-size: 15px;
        }
    </style>
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-flex justify-content-between">
                <div class="align-self-center mb-2">
                    <h2 class="common-title m-0">Auth Place Holders</h2>
                </div>
                <div class="align-self-center mb-2">
                    <ul class="list-inline">
                        <li class="list-inline-item">
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
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ route('superadmin.dashboard') }}" class="btn btn-sm btn-primary"
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
                            <th>Patient Last Name</th>
                            <th>Patient First Name</th>
                            <th>Supervisor</th>
                            <th>Authorization</th>
                            <th>Insurance</th>
                            <th>Treatment Type</th>
                            <th>Authorization Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($client_auth as $cl_auth)
                            <?php
                            $client_name = \App\Models\Client::select('client_first_name', 'client_last_name')
                                ->where('id', $cl_auth->client_id)
                                ->first();

                            $sup = \App\Models\Employee::select('id', 'admin_id', 'full_name')
                                ->where('id', $cl_auth->supervisor_id)
                                ->first();
                            ?>
                            <tr>
                                <td>
                                    @if ($client_name)
                                        {{ $client_name->client_last_name }}
                                    @endif
                                </td>
                                <td>
                                    @if ($client_name)
                                        {{ $client_name->client_first_name }}
                                    @endif

                                </td>
                                <td>
                                    @if ($sup)
                                        {{ $sup->full_name }}
                                    @endif

                                </td>
                                <td>
                                    {{ $cl_auth->description }}

                                </td>
                                <td>
                                    <?php

                                        $payor = \App\Models\All_payor::where('id',$cl_auth->payor_id)->first();
                                        if($payor){
                                            $payor_name = $payor->payor_name;
                                        }
                                        else{
                                            $payor_name = '';
                                        }
                                    ?>
                                    {{ $payor_name }}

                                </td>
                                <td>
                                    {{ $cl_auth->treatment_type }}

                                </td>
                                <td>
                                    {{ $cl_auth->authorization_number }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <input type="hidden" value="AuthPlaceHolders_" id="fileName">
@endsection
@include('superadmin.home.include.export_include')
