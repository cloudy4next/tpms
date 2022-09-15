<?php
    if(\Auth::user()->is_up_admin==1){
        $admin_id=\Auth::user()->id;
    }
    else{
        $admin_id=\Auth::user()->up_admin_id;
    }

?>

@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-flex justify-content-between">
                <div class="align-self-center mb-2">
                    <h2 class="common-title m-0">Provider Missing Signature Sessions</h2>
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

                <table class="table table-sm table-bordered c_table sig_table" id="export_table">
                    <thead>
                    <tr>
                        <th width="15%"> Provider Name</th>
                        <th width="8%"> DOS</th>
                        <th width="15%"> Patient Name</th>
                        <th width="10%"> Session Time</th>
                        <th width="20%"> Service & Hrs.</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($apps as $q)
                            @php
                                $provider=\App\Models\Employee::select('full_name')->where('id',$q->provider_id)->first();
                                $client=\App\Models\Client::select('client_full_name')->where('id',$q->client_id)->first();
                                $auth = \App\Models\Client_authorization_activity::select('id', 'activity_name')->where('id', $q->authorization_activity_id)->first();
                                $hours = $q->time_duration / 60;
                            @endphp
                            <tr>
                                <td>
                                    @if($provider)
                                        {{$provider->full_name}}
                                    @endif    
                                </td>
                                <td>
                                    {{\Carbon\Carbon::parse($q->schedule_date)->format('m/d/Y')}}    
                                </td>
                                <td>
                                    @if($client)
                                        {{$client->client_full_name}}
                                    @elseif($q->billable==2)
                                        Non-Billable Client
                                    @endif   
                                </td>
                                <td>  
                                   {{\Carbon\Carbon::parse($q->from_time)->format('g:i a').' to '.\Carbon\Carbon::parse($q->to_time)->format('g:i a')}} 
                                </td>
                                <td>
                                    @if ($auth)
                                        {{$auth->activity_name}}
                                        @if ($hours >= 1)
                                            ({{number_format($hours,2)}} Hr)
                                        @else
                                            ({{number_format($hours,2)}} Hrs)
                                        @endif
                                    @elseif($q->billable==2)
                                        NONCLI01323_AUTH249
                                        @if ($hours >= 1)
                                            ({{number_format($hours,2)}} Hr)
                                        @else
                                            ({{number_format($hours,2)}} Hrs)
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <input type="hidden" value="ProviderMissingSign_" id="fileName">

@endsection
@include('superadmin.home.include.export_include')
