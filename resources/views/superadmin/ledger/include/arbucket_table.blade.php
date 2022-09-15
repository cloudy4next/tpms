@php
if(\Auth::user()->is_up_admin==1){
    $admin_id=\Auth::user()->id;
}
else{
    $admin_id=\Auth::user()->up_admin_id;
}
$tz =\App\Models\setting_name_location::select('timezone')->where('admin_id',$admin_id)->first();
    $tz =$tz->timezone;
@endphp

@foreach($query_exe as $data)
    <?php
    $client = \App\Models\Client::where('id', $data->client_id)->first();
    $em_name = \App\Models\Employee::where('id', $data->cms_24j)->first();
    $act = \App\Models\Client_authorization_activity::where('id', $data->activity_id)->first();
    ?>
    <tr>
        <td data-tableexport-display="none">
            <input type="checkbox" class="leg_tbl_check" value="{{$data->batching_id}}" data-id="{{$data->id}}">
        </td>
        <td>
            @if ($client)
                {{$client->client_full_name}}
            @endif
        </td>
        <td>
            @if ($em_name)
                {{$em_name->first_name}} {{$em_name->middle_name}} {{$em_name->last_name}}
            @endif
        </td>
        <td>{{\Carbon\Carbon::parse($data->schedule_date)->format('m/d/Y')}}</td>
        <td>{{$data->cpt}}</td>
        <td>{{$data->units}}</td>
        <td>12/28/2020</td>
        <td>{{number_format($data->billed_am,2)}}</td>
        <td>
            <?php

            $dep_apps_pay = \App\Models\deposit_apply::where('batching_claim_id', $data->batching_id)->sum('payment');
            $dep_apps_baln = \App\Models\deposit_apply::where('batching_claim_id', $data->batching_id)->sum('balance');
            $dep_apps_adj = \App\Models\deposit_apply::where('batching_claim_id', $data->batching_id)->sum('adjustment');
            $to = $dep_apps_pay + $dep_apps_baln;

            ?>
            {{number_format($dep_apps_pay,2)}}
        </td>
        <td>{{number_format($dep_apps_adj,2)}}</td>
        <td>{{number_format($dep_apps_baln,2)}}</td>
        {{--            <td>{{number_format($dep_apps_baln,2)}}</td>--}}
        <td>
            @if ($act)
                {{$act->activity_name}}
            @endif
        </td>
        <td data-tableexport-display="none">
            <?php
            $leg_notes_count = \App\Models\ledger_note::select('ledger_id')->where('ledger_id', $data->id)->count();
            ?>
            @if ($leg_notes_count > 0)
                <i class="ri-file-add-fill text-success"></i>
            @else
                <i class="ri-file-add-fill text-muted"></i>
            @endif
        </td>
        <td data-tableexport-display="none">
            <a href="#editNote" class="addNoteLedger" title="Add Notes" data-toggle="modal" data-id="{{$data->id}}"><i
                    class="ri-add-circle-line"></i></a>
            <a href="#chat{{$data->id}}" data-id="{{$data->id}}" data-toggle="modal"><i
                    class="ri-message-2-line ml-2"></i></a>

            <div class="modal fade" id="chat{{$data->id}}">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Ar Followup</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body show_comment">
                            <?php
                            $comments = \App\Models\ledger_note::where('ledger_id', $data->id)->get();
                            ?>
                            @foreach($comments as $com)
                            <?php
                            $follwo_date = \Carbon\Carbon::parse($com->followup_date)->format('m/d/Y');
                            $create_time = \Carbon\Carbon::parse($com->created_at)->timezone($tz)->format('h:i A');
                            $client_name = \App\Models\Client::where('admin_id', $admin_id)->where('id', $com->client_id)->first();
                            ?>
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <img src="{{asset('assets/dashboard/')}}/images/user/01.jpg"
                                         class="img-fluid" alt="user">
                                </div>
                                <div class="col-md-10 mb-3">
                                    <div class="talkbubble">
                                        <h6 class="overflow-hidden">{{$client_name->client_full_name}} <span
                                                class="badge badge-secondary">{{$com->category_name}}</span>
                                            <small
                                                class="text-muted float-right">({{$follwo_date.' '.$create_time}})</small></h6>
                                        <hr>
                                        <p>{!! $com->notes !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
@endforeach