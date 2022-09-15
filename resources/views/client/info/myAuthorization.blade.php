@extends('layouts.client')
@section('client')

    <div class="iq-card">
        <div class="iq-card-body">
            <?php
            $client_info = \App\Models\Client_info::where('client_id', $client_id->id)->first();
            ?>
            <h5 class="mb-2">
                <a href="{{route('client.myinfo')}}" title="Back To Client"><i
                        class="ri-arrow-left-circle-line text-primary"></i> </a>
                <a href="{{route('client.myinfo')}}"
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
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('client.myinfo')}}">Patient
                                Info</a></li>
                        <li class="nav-item"><a class="nav-link active"
                                                href="{{route('client.myauthorization')}}">Ins/Authorization</a>
                        </li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('client.mydocuments')}}">Documents</a>
                        </li>
                    </ul>
                </div>
                <div class="all_content flex-fill">
                    <div class="overflow-hidden mb-2">
                        <div class="float-left">
                            <h5 class="m-0">Authorizations List</h5>
                        </div>
                        <div class="float-right">
                            {{--                            <a href="{{route('superadmin.client.authorization,create',$client_id->id)}}"--}}
                            {{--                               class="btn btn-sm btn-primary">+ Add Authorization</a>--}}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered c_table auth_table">
                            <thead>
                            <tr>
                                <th>Description</th>
                                <th>Onset Date</th>
                                <th>End Date</th>
                                <th>Insurance</th>
                                <th>Ins. ID</th>
                                <th>Auth No</th>
                                <th>COB</th>
                                {{-- <th>Actions</th> --}}
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody class="accordion" id="accordionExample">
                            @foreach($all_authorizations as $authorization)
                                <?php
                                $payor_name = \App\Models\All_payor::where('id', $authorization->payor_id)->first();
                                ?>
                                <tr>
                                    <td data-toggle="collapse" data-target="#singleauth1{{$authorization->id}}"><i
                                            class="ri-play-fill text-primary mr-2"></i>{{$authorization->description}}
                                    </td>
                                    <td>{{\Carbon\Carbon::parse($authorization->onset_date)->format('m/d/Y')}}</td>
                                    <td>{{\Carbon\Carbon::parse($authorization->end_date)->format('m/d/Y')}}</td>
                                    <td>
                                        @if ($payor_name)
                                            {{$payor_name->payor_name}}
                                        @endif
                                    </td>

                                    <td>{{$authorization->uci_id}}</td>
                                    <td>{{$authorization->authorization_number}}</td>
                                    <td>
                                        @if ($authorization->is_primary == 1)
                                            Primary
                                        @elseif ($authorization->is_primary == 2 )
                                            Secondary
                                        @elseif ($authorization->is_primary == 3 )
                                            Tertiary
                                        @else

                                        @endif
                                    </td>
                                    {{-- <td style="max-width: 120px;">
                                        @if ($authorization->is_primary == 1)

                                            <button type="button" class="btn p-0 text-primary" disabled>
                                                <a href="#" disabled
                                                   data-toggle="modal"
                                                   class="pr-2" title="Copy Form Rate Table"><i
                                                        class="ri-file-copy-line mr-1"></i></a>
                                            </button>|
                                        @endif
                                        @if ($authorization->is_primary == 1)
                                            <button type="button" class="btn p-0 text-primary" disabled>
                                                <a href="#" class="px-2"
                                                   data-toggle="modal" title="Add Activity"><i class="ri-add-line"></i></a>
                                            </button>|
                                        @endif
                                        <button type="button" class="btn p-0" disabled>
                                            
                                            <a href="{{route('client.myauthorization.edit',$authorization->id)}}"
                                           class="px-2" title="Edit"><i
                                                class="ri-edit-box-line text-success mx-1"
                                                aria-hidden="true"></i></a>|

                                        </button>
                                        <button type="button" class="btn p-0 text-primary" disabled>
                                            <a href="#"
                                               class="pl-2" title="Delete" readonly=""><i
                                                    class="ri-delete-bin-line text-danger"
                                                    aria-hidden="true"></i></a>
                                        </button>


                                    </td> --}}
                                    <td>
                                        @if ($authorization->is_placeholder == 1 )
                                            <i class="ri-checkbox-blank-circle-fill text-danger"
                                               title="Placeholder"></i> -P
                                        @elseif ($authorization->is_valid == 1 )
                                            <i class="ri-checkbox-blank-circle-fill text-success" title="Active"></i>
                                        @elseif ($authorization->is_valid != 1 )
                                            <i class="ri-checkbox-blank-circle-fill text-danger" title="In-Active"></i>
                                        @elseif ($authorization->is_valid == 1 && $authorization->is_placeholder == 1)
                                            <i class="ri-checkbox-blank-circle-fill text-success" title="Active"></i> -P
                                        @else
                                            <i class="ri-checkbox-blank-circle-fill text-success" title="Active"></i>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="9">
                                        <div id="singleauth1{{$authorization->id}}" class="collapse"
                                             data-parent="#accordionExample">
                                            <table class="table table-sm table-bordered bg-light c_table m-0">
                                                <thead style="background: #089239;">
                                                <tr>
                                                    <th>Service</th>
                                                    <th>Cpt code</th>
                                                    <th>Max By</th>
                                                    <th>Frequency</th>
                                                    <th>Auth</th>
                                                    <th>Scheduled</th>
                                                    <th>Rendered</th>
                                                    <th>Remaining</th>

                                                    {{-- <th>Action</th> --}}
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $activities_data = \App\Models\Client_authorization_activity::where('authorization_id', $authorization->id)->('admin_id',Auth::user()->admin_id)->get();
                                                ?>
                                                @foreach($activities_data as $act)
                                                    <?php

                                                        $sch_min = \App\Models\Appoinment::where('admin_id', Auth::user()->admin_id)
                                                            ->where('client_id', $client_id->id)
                                                            ->where('authorization_activity_id', $act->id)
                                                            ->sum('time_duration');
                                                        $ren_min = \App\Models\Appoinment::where('admin_id',Auth::user()->admin_id)
                                                            ->where('client_id', $client_id->id)
                                                            ->where('authorization_activity_id', $act->id)
                                                            ->where('status', 'Rendered')
                                                            ->sum('time_duration');
                                                        $cpt_name = \App\Models\setting_cpt_code::where('cpt_id', $act->cpt_code)
                                                                    ->where('admin_id', Auth::user()->admin_id)
                                                                    ->first();

                                                        $sch = 0;
                                                        $ren = 0;
                                                        $rem = 0;

                                                        if ($act->hours_max_one == 1){
                                                            $sch = $sch_min / 60;
                                                            $ren = $ren_min / 60;
                                                            $t_s = $sch;
                                                            $rem = $act->hours_max_is_one - $t_s;
                                                        }
                                                        else if($act->hours_max_one == 2){
                                                            $sch = $sch_min / 60;
                                                            $ren = $ren_min / 60;
                                                            $t_s = $sch;
                                                            $rem = $act->hours_max_is_one - $t_s;
                                                        }
                                                        else if($act->hours_max_one == 3){
                                                            $t_s = $sch_min;
                                                            $units = 0;

                                                            if($act->billed_type == 'Per Unit'){
                                                                if($act->billed_time == '15 min'){
                                                                    $sch = round($sch_min/15,2);
                                                                    $ren = round($ren_min/15,2);
                                                                    $units = round($t_s/15,2);
                                                                }
                                                                else if($act->billed_time == '30 min'){
                                                                    $sch = round($sch_min/30,2);
                                                                    $ren = round($ren_min/30,2);
                                                                    $units = round($t_s/30,2);
                                                                }
                                                                else if($act->billed_time == '45 min'){
                                                                    $sch = round($sch_min/45,2);
                                                                    $ren = round($ren_min/45,2);
                                                                    $units = round($t_s/45,2);
                                                                }
                                                                else if($act->billed_time == '1 hour'){
                                                                    $sch = round($sch_min/60,2);
                                                                    $ren = round($ren_min/60,2);
                                                                    $units = round($t_s/60,2);
                                                                }
                                                                else if($act->billed_time == '2 hour'){
                                                                    $sch = round($sch_min/120,2);
                                                                    $ren = round($ren_min/120,2);
                                                                    $units = round($t_s/120,2);
                                                                }
                                                                else if($act->billed_time == '1 min'){
                                                                    $sch = round($sch_min/1,2);
                                                                    $ren = round($ren_min/1,2);
                                                                    $units = round($t_s/1,2);
                                                                }
                                                            }

                                                            $rem = $act->hours_max_is_one - $units;
                                                        }
                                                        else{
                                                            $sch = 0;
                                                            $ren = 0;
                                                            $rem = 0;
                                                        }

                                                    ?>
                                                    <tr>
                                                        <td>{{ $act->activity_one }} {{ $act->activity_two }}</td>
                                                        <td>
                                                            @if ($cpt_name)
                                                                {{$cpt_name->cpt_code}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($act->hours_max_one == 1)
                                                                Hours
                                                            @elseif($act->hours_max_one == 2)
                                                                Amount
                                                            @elseif($act->hours_max_one == 3)
                                                                Unit
                                                            @else
                                                                Not Set
                                                            @endif
                                                        </td>
                                                        <td>{{ $act->hours_max_per_one }}</td>
                                                        <td>{{ $act->hours_max_is_one }}</td>
                                                        <td>
                                                            {{round($sch,2)}}
                                                            @if ($act->hours_max_one == 1)
                                                                Hrs
                                                            @elseif($act->hours_max_one == 2)
                                                                Am
                                                            @elseif($act->hours_max_one == 3)
                                                                Units
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{round($ren,2)}}
                                                            @if ($act->hours_max_one == 1)
                                                                Hrs
                                                            @elseif($act->hours_max_one == 2)
                                                                Am
                                                            @elseif($act->hours_max_one == 3)
                                                                Units
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{round($rem,2)}}
                                                            @if ($act->hours_max_one == 1)
                                                                Hrs
                                                            @elseif($act->hours_max_one == 2)
                                                                Am
                                                            @elseif($act->hours_max_one == 3)
                                                                Units
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {


            $('.check_all_rate').click(function () {
                if ($(this).prop("checked") == true) {
                    $('.rate_check').each(function () {
                        $(this).prop('checked', true);
                    });
                } else if ($(this).prop("checked") == false) {
                    $('.rate_check').each(function () {
                        $(this).prop('checked', false);
                    });
                }
            })


            {{--$('.copy_contact_rate').click(function () {--}}
            {{--    var auth_id = $(this).data('id');--}}

            {{--    var array = [];--}}
            {{--    --}}
            {{--    $('.rate_check:checked').each(function () {--}}
            {{--        array.push($(this).val());--}}
            {{--    });--}}

            {{--    console.log(array);--}}

            {{--    if (array == null || array.length <= 0) {--}}

            {{--    } else {--}}
            {{--        $.ajax({--}}
            {{--            type: "POST",--}}
            {{--            url: "{{route('superadmin.copy.contact.rate')}}",--}}
            {{--            data: {--}}
            {{--                '_token': "{{csrf_token()}}",--}}
            {{--                'auth_id': auth_id,--}}
            {{--                'array': array,--}}
            {{--            },--}}
            {{--            success: function (data) {--}}
            {{--                console.log(data);--}}
            {{--                // if (data == 'done') {--}}
            {{--                //     location.reload();--}}
            {{--                //     toastr["success"]("Contract Rate Copied Successfully", 'SUCCESS!');--}}
            {{--                // }--}}
            {{--            }--}}
            {{--        });--}}
            {{--    }--}}


            {{--})--}}


            $('.max_one').change(function () {
                var id = $(this).val();
                if (id == 1) {
                    $('.max_one_select').empty();
                    $('.max_one_select').append(
                        `
                             <option value="0"></option>
                                 <option value="Day">Day</option>
                                 <option value="Week">Week</option>
                                 <option value="Month">Month</option>
                             <option value="Total Auth">Total Auth</option>
                        `
                    );
                } else {
                    $('.max_one_select').empty();
                    $('.max_one_select').append(
                        `
                             <option value="0"></option>

                                 <option value="Week">Week</option>
                                 <option value="Month">Month</option>
                             <option value="Total Auth">Total Auth</option>
                        `
                    );
                }

            })


            $('.max_two').change(function () {
                var id = $(this).val();
                if (id == 1) {
                    $('.max_two_select').empty();
                    $('.max_two_select').append(
                        `
                             <option value="0"></option>
                                 <option value="Day">Day</option>
                                 <option value="Week">Week</option>
                                 <option value="Month">Month</option>
                             <option value="Total Auth">Total Auth</option>
                        `
                    );
                } else {
                    $('.max_two_select').empty();
                    $('.max_two_select').append(
                        `
                             <option value="0"></option>

                                 <option value="Week">Week</option>
                                 <option value="Month">Month</option>
                             <option value="Total Auth">Total Auth</option>
                        `
                    );
                }

            })

            $('.max_three').change(function () {
                var id = $(this).val();
                if (id == 1) {
                    $('.max_three_select').empty();
                    $('.max_three_select').append(
                        `
                             <option value="0"></option>
                                 <option value="Day">Day</option>
                                 <option value="Week">Week</option>
                                 <option value="Month">Month</option>
                             <option value="Total Auth">Total Auth</option>
                        `
                    );
                } else {
                    $('.max_three_select').empty();
                    $('.max_three_select').append(
                        `
                             <option value="0"></option>

                                 <option value="Week">Week</option>
                                 <option value="Month">Month</option>
                             <option value="Total Auth">Total Auth</option>
                        `
                    );
                }

            })
        })
    </script>
    <script>
        $(document).ready(function () {
            $('.billed_time').hide();
            $('.billed_time1').hide();
            var billed_type = $('.billed_type').val();
            if (billed_type == "Per Unit") {
                $('.billed_time').show();
            } else if (billed_type == "Per Session") {
                $('.billed_time').show();
            } else {
                $('.billed_time').hide();
            }


            var billed_type1 = $('.billed_type1').val();
            if (billed_type1 == "Per Unit") {
                $('.billed_time1').show();
            } else if (billed_type1 == "Per Session") {
                $('.billed_time1').show();
            } else {
                $('.billed_time1').hide();
            }


            $('.billed_type').change(function () {
                var value_data = $(this).val();
                if (value_data == "Per Unit") {
                    $('.billed_time').show();
                } else if (value_data == "Per Session") {
                    $('.billed_time').show();
                } else {
                    $('.billed_time').hide();
                }
            })


            $('.billed_type1').change(function () {
                var value_data1 = $(this).val();
                if (value_data1 == "Per Unit") {
                    $('.billed_time1').show();
                } else if (value_data1 == "Per Session") {
                    $('.billed_time1').show();
                } else {
                    $('.billed_time1').hide();
                }
            })


        })
    </script>
@endsection
