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
                    {{$client_id->client_street}}, {{$client_id->client_city}}, {{$client_id->client_state}}
                    , {{$client_id->client_zip}}


                </small>
            </h5>
            <div class="d-lg-flex">
                <div class="client_menu mr-2">
                    <ul class="nav flex-column setting_menu">
                        <li class="nav-item border-0"><img src="{{asset('assets/dashboard/')}}/images/user/01.jpg"
                                                           class="img-fluid d-block mx-auto" alt=""></li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('superadmin.client.info',$client_id->id)}}">Patient
                                Info</a></li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('superadmin.client.authorization',$client_id->id)}}">Ins/Authorization</a>
                        </li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('superadmin.client.documents',$client_id->id)}}">Documents</a>
                        </li>
                        <li class="nav-item"><a class="nav-link active"
                                                href="{{route('superadmin.client.portal',$client_id->id)}}">Patient
                                Portal</a></li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('superadmin.client.ledger',$client_id->id)}}">Patient
                                Ledger</a></li>
                        {{--                        <li class="nav-item"><a class="nav-link " href="{{route('superadmin.client.activity',$client_id->id)}}">Patient Activity</a></li>--}}
                    </ul>
                </div>
                <div class="all_content flex-fill">

                    <div class="row">

                        <div class="col-md-6 mb-2">
                            <form action="{{route('superadmin.client.portal.save')}}" method="post" autocomplete="off">
                                @csrf
                                <h6 class="font-weight-bold" style="font-size: 20px;">Patient Portal Features</h6>
                                <label class="d-block " style="color: grey">Select which features are available for this
                                    Patient Portal.</label>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="secure_message"
                                               value="1" {{$client_portal->secure_message == 1 ? 'checked' : ''}}>Use
                                        secure messaging
                                        <input type="hidden" name="client_id" value="{{$client_id->id}}">
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="access_billing"
                                               value="1" {{$client_portal->access_billing == 1 ? 'checked' : ''}}>Access
                                        billing documents
                                    </label>
                                    <br>
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="pay_stripe"
                                               value="1" {{$client_portal->pay_stripe == 1 ? 'checked' : ''}}>Pay a
                                        balance with credit card using Stripe
                                    </label>
                                    <div class="form-check">

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary mt-2">Save Features</button>
                            </form>
                        </div>


                        <div class="col-md-6 mb-2">
                            <form action="{{route('superadmin.client.portal.send.invitaion')}}" method="post">
                                @csrf
                                <h6 class="font-weight-bold" style="font-size: 20px;">Patient Portal Access</h6>
                                <label class="d-block mb-2 " style="color: grey">Patient will create their own accounts
                                    to access your Patient Portal.</label>
                                <label>Email: </label>
                                <div class="d-inline-block">
                                    <select class="form-control form-control-sm" name="claint_email">
                                        <option value="{{$client_id->email}}">
                                            {{$client_id->email}} (current)
                                        </option>
                                    </select>
                                </div>
                                @if($client_id->login_email == null && $client_id->password == null)
                                    <div class="alert alert-danger alert-dismissible mt-2 mb-2" role="alert">
                                        Patient portal access need to be initiated
                                        <button type="button" class="close text-danger" data-dismiss="alert"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @elseif($client_id->login_email != null && $client_id->password == null)
                                    <div class="alert alert-warning alert-dismissible mt-2 mb-2" role="alert">
                                        Invitation sent — Patient has not signed in yet.
                                        <button type="button" class="close text-danger" data-dismiss="alert"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @else
                                    <div class="alert alert-success alert-dismissible mt-2 mb-2" role="alert">
                                        Patient has signed Up.
                                        <button type="button" class="close text-danger" data-dismiss="alert"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                {{--                                @if (Session::has('send_email_portal'))--}}
                                {{--                                    <div class="alert alert-danger alert-dismissible mt-2 mb-2" role="alert">--}}
                                {{--                                        Invitation sent — Patient has not signed in yet.--}}
                                {{--                                        <button type="button" class="close text-danger" data-dismiss="alert"--}}
                                {{--                                                aria-label="Close">--}}
                                {{--                                            <span aria-hidden="true">&times;</span>--}}
                                {{--                                        </button>--}}
                                {{--                                    </div>--}}
                                {{--                                @endif--}}

                                {{--                                @if (Session::has('error_email_portal'))--}}
                                {{--                                    <div class="alert alert-danger alert-dismissible mt-2 mb-2" role="alert">--}}
                                {{--                                        Patient Email Not Found.--}}
                                {{--                                        <button type="button" class="close text-danger" data-dismiss="alert"--}}
                                {{--                                                aria-label="Close">--}}
                                {{--                                            <span aria-hidden="true">&times;</span>--}}
                                {{--                                        </button>--}}
                                {{--                                    </div>--}}
                                {{--                                @endif--}}
                                <br>
                                <button type="submit" class="btn btn-sm btn-secondary">Send Invitation</button>
                            </form>
                        </div>
                        <div class="col-md-12 mb-2">
                            <hr class="m-0">
                        </div>
                        <div class="col-md-12">
                            {{--                                <button type="submit" class="btn btn-sm mr-2 btn-primary">Save Access</button>--}}
                            {{--                                <button type="submit" class="btn btn-sm btn-danger">Delete Access</button>--}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
