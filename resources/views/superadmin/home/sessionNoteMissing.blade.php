@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-flex justify-content-between">
                <div class="align-self-center mb-2">
                    <h2 class="common-title m-0">Session Note Missing</h2>
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
                        <th>Patient Last Name</th>
                        <th>Patient First Name</th>
                        <th>Actual Therapist</th>
                        <th>DOS</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($apps as $app)
                        <?php
                        $client_name = \App\Models\Client::select('client_first_name', 'client_last_name')
                            ->where('id', $app->client_id)
                            ->first();
                        $thera = \App\Models\Employee::select('full_name')
                            ->where('id', $app->provider_id)
                            ->first();
                        ?>
                        <tr>
                            <td>
                                @if ($client_name)
                                    {{$client_name->client_last_name}}
                                @endif

                            </td>
                            <td>
                                @if ($client_name)
                                    {{$client_name->client_first_name}}
                                @endif

                            </td>
                            <td>
                                @if ($thera)
                                    {{$thera->full_name}}
                                @endif

                            </td>
                            <td>{{\Carbon\Carbon::parse($app->schedule_date)->format('m/d/Y')}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <input type="hidden" value="NotesMissing_" id="fileName">

@endsection
@include('superadmin.home.include.export_include')
