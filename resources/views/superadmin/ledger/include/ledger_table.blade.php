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
    <?php
    $total_am = 0;
    $total_pay = 0;
    $total_adj = 0;
    $total_bal = 0;
    ?>
    @foreach($legder_data as $led_data)
        <?php
        $client = \App\Models\Client::where('id', $led_data->client_id)->first();
        $em_name = \App\Models\Employee::where('id', $led_data->cms_24j)->first();
        $act = \App\Models\Client_authorization_activity::where('id', $led_data->activity_id)->first();
        if (Auth::user()->is_up_admin == 1) {
            $payor = \App\Models\All_payor_detail::select('admin_id', 'payor_id', 'payor_name')
                ->where('payor_id', $led_data->payor_id)
                ->where('admin_id', Auth::user()->id)
                ->first();
        } else {
            $payor = \App\Models\All_payor_detail::select('admin_id', 'payor_id', 'payor_name')
                ->where('payor_id', $led_data->payor_id)
                ->where('admin_id', Auth::user()->up_admin_id)
                ->first();
        }

        //        $claim = \App\Models\manage_claim_transaction::select('admin_id', 'claim_id', 'baching_id')->where('baching_id', $led_data->batching_id)->where('admin_id', $admin_id)->first();
        $name_loca = \App\Models\setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $admin_id)->first();

        if ($name_loca->is_combo == 1) {

            $claim = \App\Models\manage_claim_transaction::select('admin_id', 'claim_id', 'baching_id')
                ->where('baching_id', $led_data->batching_id)
                ->where('cpt', $led_data->cpt)
                ->where('admin_id', $admin_id)
                ->first();

            $deposit_aplly_1 = \App\Models\deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id', 'cpt')
                ->where('appointment_id', $led_data->appointment_id)
                ->where('dos', $led_data->schedule_date)
                ->where('cpt', $led_data->cpt)
                ->where('admin_id', $admin_id)
                ->first();

            $billed_am = \App\Models\deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id', 'cpt')
                ->where('appointment_id', $led_data->appointment_id)
                ->where('dos', $led_data->schedule_date)
                ->where('cpt', $led_data->cpt)
                ->where('admin_id', $admin_id)
                ->sum('billed_am');

            $deposit_aplly_pay = \App\Models\deposit_apply::select('appointment_id', 'dos', 'admin_id', 'cpt')
                ->where('appointment_id', $led_data->appointment_id)
                ->where('dos', $led_data->schedule_date)
                ->where('cpt', $led_data->cpt)
                ->where('admin_id', $admin_id)
                ->sum('payment');

            $deposit_aplly_adj = \App\Models\deposit_apply::select('appointment_id', 'dos', 'amount', 'cpt')
                ->where('appointment_id', $led_data->appointment_id)
                ->where('dos', $led_data->schedule_date)
                ->where('cpt', $led_data->cpt)
                ->where('admin_id', $admin_id)
                ->sum('adjustment');
        } else {

            $claim = \App\Models\manage_claim_transaction::select('admin_id', 'claim_id', 'baching_id')->where('baching_id', $led_data->batching_id)->where('admin_id', $admin_id)->first();

            $deposit_aplly_1 = \App\Models\deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                ->where('appointment_id', $led_data->appointment_id)
                ->where('dos', $led_data->schedule_date)
                ->where('admin_id', $admin_id)
                ->first();

            $billed_am = \App\Models\deposit_apply::distinct()->select('appointment_id', 'dos', 'client_id', 'admin_id')
                ->where('appointment_id', $led_data->appointment_id)
                ->where('dos', $led_data->schedule_date)
                ->where('client_id', $led_data->client_id)
                ->where('admin_id', $admin_id)
                ->sum('amount');

            $deposit_aplly_pay = \App\Models\deposit_apply::select('appointment_id', 'dos', 'admin_id')
                ->where('appointment_id', $led_data->appointment_id)
                ->where('dos', $led_data->schedule_date)
                ->where('admin_id', $admin_id)
                ->sum('payment');

            $deposit_aplly_adj = \App\Models\deposit_apply::select('appointment_id', 'dos', 'amount')
                ->where('appointment_id', $led_data->appointment_id)
                ->where('dos', $led_data->schedule_date)
                ->where('admin_id', $admin_id)
                ->sum('adjustment');
        }





        $sub_total = $deposit_aplly_pay + $deposit_aplly_adj;
        $balance = $billed_am - $sub_total;

        if ($deposit_aplly_1) {
            $total_am += $billed_am;
            $total_pay += $deposit_aplly_pay;
            $total_adj += $deposit_aplly_adj;
            $total_bal += $balance;
        } else {
            $total_am += $led_data->billed_am;
            $total_pay += 0.00;
            $total_adj += 0.00;
            $total_bal += $led_data->billed_am;
        }
        ?>
        <tr>
            <td data-tableexport-display="none">
                <input type="checkbox" class="leg_tbl_check" value="{{$led_data->batching_id}}" data-id="{{$led_data->id}}">
            </td>
            <td data-tableexport-display="none">
                @if ($client)
                    <a href="{{route('superadmin.client.info',$client->id)}}"
                       target="_blank">{{$client->client_full_name}}</a>
                @endif
            </td>
            <td style="display: none;" data-tableexport-display="always">
                @if ($client)
                    {{$client->client_full_name}}
                @endif
            </td>
            <td>
                @if ($em_name)
                    {{$em_name->first_name}} {{$em_name->middle_name}} {{$em_name->last_name}}
                @endif
            </td>
            <td>{{\Carbon\Carbon::parse($led_data->schedule_date)->format('m/d/Y')}}</td>
            <td>{{$led_data->cpt}}</td>
            <td>{{$led_data->units}}</td>
            <td>
                @if ($led_data->created_at != null || $led_data->created_at != '')
                    {{\Carbon\Carbon::parse($led_data->created_at)->format('m/d/Y')}}
                @endif
            </td>
            <td>
                @if ($deposit_aplly_1)
                    {{number_format($billed_am,2)}}
                @else
                    {{number_format($led_data->billed_am)}}
                @endif


            </td>

            <td>
                {{number_format($deposit_aplly_pay,2)}}

            </td>
            <td>
                {{number_format($deposit_aplly_adj,2)}}
            </td>
            <td>
                @if ($deposit_aplly_1)
                    {{number_format($balance,2)}}
                @else
                    {{number_format($led_data->billed_am)}}
                @endif


            </td>
            <td>
                @if ($payor)
                    {{$payor->payor_name}}
                @endif
            </td>
            <td data-tableexport-display="none">
                @if ($claim)
                    <a href="{{ route('superadmin.claim.show.hcfa',$claim->claim_id) }}"
                       target="_blank">{{$claim->claim_id}}</a>
                @endif

            </td>
            <td style="display: none;" data-tableexport-display="always">
                @if ($claim)
                    {{$claim->claim_id}}
                @endif
            </td>
            <td data-tableexport-display="none">
                <?php
                $leg_notes_count = \App\Models\ledger_note::select('ledger_id')->where('ledger_id', $led_data->id)->count();
                ?>
                @if ($leg_notes_count > 0)
                    <i class="ri-file-add-fill text-success"></i>
                @else
                    <i class="ri-file-add-fill text-muted"></i>
                @endif

            </td>
            <td data-tableexport-display="none">

                <a href="#editNote" class="addNoteLedger" data-id="{{$led_data->id}}" title="Add Notes"
                   data-toggle="modal"><i
                        class="ri-add-circle-line"></i></a>
                <a href="#chat{{$led_data->id}}" data-id="{{$led_data->id}}" class="chat_data" data-toggle="modal"><i
                        class="ri-message-2-line ml-2"></i></a>
                

                <div class="modal fade" id="chat{{$led_data->id}}">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Ar Followup</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body show_comment">
                                <?php
                                $comments = \App\Models\ledger_note::where('ledger_id', $led_data->id)->get();
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
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach

    <input type="hidden" class="amt_h" value="{{$total_am}}">
    <input type="hidden" class="pay_h" value="{{$total_pay}}">
    <input type="hidden" class="adj_h" value="{{$total_adj}}">
    <input type="hidden" class="bal_h" value="{{$total_bal}}">







