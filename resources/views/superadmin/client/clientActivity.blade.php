@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <h5 class="mb-2">
                <a href="{{route('superadmin.client.list')}}" title="Back To Client"><i
                        class="ri-arrow-left-circle-line text-primary"></i> </a>
                <a href="{{route('superadmin.client.list')}}"
                   class="cmn_a">{{$client_id->client_first_name}} {{$client_id->client_middle}} {{$client_id->client_last_name}}</a>
                | <small>
                    <span
                        class=" font-weight-bold text-orange">DOB:</span> {{\Carbon\Carbon::parse($client_id->client_dob)->format('m/d/Y')}}
                    |
                    <span class=" font-weight-bold text-orange">Phone:</span> {{$client_id->phone_number}} |
                    <span class=" font-weight-bold text-orange">Address:</span>
                    {{$client_id->client_street}} {{$client_id->client_city}} {{$client_id->client_state}} {{$client_id->client_zip}}


                </small>
            </h5>
            <div class="d-lg-flex">
                <div class="client_menu mr-2">
                    <ul class="nav flex-column setting_menu">
                        <li class="nav-item border-0"><img src="{{asset('assets/dashboard/')}}/images/user/01.jpg"
                                                           class="img-fluid d-block mx-auto" alt=""></li>
                        <li class="nav-item"><a class="nav-link active"
                                                href="{{route('superadmin.client.info',$client_id->id)}}">Patient
                                Info</a></li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('superadmin.client.authorization',$client_id->id)}}">Ins/Authorization</a>
                        </li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('superadmin.client.documents',$client_id->id)}}">Documents</a>
                        </li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('superadmin.client.portal',$client_id->id)}}">Patient
                                Portal</a></li>
                        {{--                        <li class="nav-item"><a class="nav-link" href="{{route('superadmin.client.activity',$client_id->id)}}">Patient Activity</a></li>--}}
                    </ul>
                </div>
                <div class="all_content flex-fill">
                    <h5 class="mb-3">Patient Activity</h5>
                    <!-- single activity-->
                    @foreach($client_activities as $activitied)
                        <div class="d-flex">
                            <div class="mr-4 datetime">
                                <p class="today mb-0">19 November 2019</p>
                                <p class="time">2:59 PM</p>
                            </div>
                            <div class="flex-fill timeline">
                                <div class="history">
                                    <h6>{{$activitied->title}}</h6>
                                    <p>{!! $activitied->message !!} <a href="#">View Details</a></p>
                                </div>
                                <div class="timeline-dots"></div>
                            </div>
                        </div>
                    @endforeach
                    <p style="margin: 0 auto">
                        {{$client_activities->links()}}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
