@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-flex mb-2">
                <div class="mr-2 postby">
                    <label>Post By</label>
                    <select class="form-control form-control-sm post_by_deposit">
                        <option value="1">Claim No</option>
                        <option value="2">Patient</option>
                    </select>
                </div>
                <div class="mr-2 claim_filter">
                    <label>Claim No</label>
                    <input class="form-control form-control-sm claim_number" type="text" maxlength="6"
                           placeholder="Claim No" style="max-width: 80px;">
                </div>
                <div class="mr-2 client_filter">
                    <label>Select Patient</label>
                    @if ($deposit->payor_type == 1)
                        <?php
                        if (Auth::user()->is_up_admin == 1) {
                            $client = \App\Models\Client::where('id', $deposit->client_id)
                                ->where('admin_id', Auth::user()->id)
                                ->first();
                        } else {
                            $client = \App\Models\Client::where('id', $deposit->client_id)
                                ->where('admin_id', Auth::user()->up_admin_id)
                                ->first();
                        }

                        ?>
                        <select class="form-control form-control-sm client_id">
                            <option
                                value="{{$client->id}}">{{$client->client_first_name}} {{$client->client_middle}} {{$client->client_last_name}}</option>
                        </select>
                    @else
                        <?php
                        if (Auth::user()->is_up_admin == 1) {
                            $baching_claim = \App\Models\Batching_claim::distinct()->select('admin_id', 'client_id', 'payor_id')
                                ->where('payor_id', $deposit->payor_id)
                                ->where('admin_id', Auth::user()->id)
                                ->get();
                        } else {
                            $baching_claim = \App\Models\Batching_claim::distinct()->select('admin_id', 'client_id', 'payor_id')
                                ->where('payor_id', $deposit->payor_id)
                                ->where('admin_id', Auth::user()->up_admin_id)
                                ->get();
                        }
                        ?>
                        <select class="form-control form-control-sm client_id">
                            <option value="">select any</option>
                            @foreach($baching_claim as $b_claim)
                                <?php
                                $client = \App\Models\Client::where('id', $b_claim->client_id)->first();
                                ?>
                                <option
                                    value="{{$client->id}}">{{$client->client_first_name}} {{$client->client_middle}} {{$client->client_last_name}}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <div class="mr-2 datrange">
                    <label>Select Date Range</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input class="form-control form-control-sm reportrange">
                        <input class="form-control form-control-sm deopsit_id" type="hidden" name="apply_id"
                               value="{{$deposit->id}}">
                        <input class="form-control form-control-sm is_client" type="hidden" name="is_client"
                               value="{{$deposit->payor_type}}">
                        <input class="form-control form-control-sm dep_client_id" type="hidden" name="dep_client_id"
                               value="{{$deposit->client_id}}">
                        <input class="form-control form-control-sm payor_type" type="hidden" name="payor_type"
                               value="{{$deposit->payor_type}}">
                    </div>
                </div>
                <div class="align-self-end mr-2">
                    <div class="custom-control custom-switch custom_switch_client">
                        @if ($deposit->payor_type == 1)
                            <input type="checkbox" class="custom-control-input check_all_client" id="ac"
                                   autocomplete="nope" disabled readonly>
                            <label class="custom-control-label" for="ac">All Clients</label>
                        @else
                            <input type="checkbox" class="custom-control-input check_all_client" id="ac"
                                   autocomplete="nope">
                            <label class="custom-control-label" for="ac">All Clients</label>
                        @endif
                    </div>
                    <div class="custom-control custom-switch custom_switch_include_closed">
                        <input type="checkbox" class="custom-control-input include_closed" id="ic" checked=""
                               autocomplete="nope">
                        <label class="custom-control-label" for="ic">Include Closed</label>
                    </div>
                </div>


                <div class="align-self-end">
                    <button type="button" class="btn btn-sm btn-primary mr-2 show_btn" id="show">Show</button>
                    <button type="button" class="btn btn-sm btn-danger cancel_btn" onClick="window.location.reload();">
                        Reset
                    </button>
                </div>
                <div class="ml-auto align-self-end">
                    <a href="{{route('superadmin.billing.deposit')}}" class="btn btn-sm btn-primary"
                       title="Back To Deposit"><i class="ri-arrow-left-circle-line"></i>Back</a>
                </div>
            </div>
            <div>
                <table class="table-sm text-primary">
                    <th>Total Amount</th>
                    <?php
                    $total_am = $deposit->amount;
                    $payment = \App\Models\deposit_apply::where('deopsit_id', $deposit->id)->sum('payment');

                    $re = $total_am - $payment;
                    ?>
                    <td class="text-dark t_am">{{number_format($total_am,2)}}</td>
                    <th>Amount Applied</th>
                    <td class="text-dark "><p class="d_p_am"
                                              style="margin-bottom: 0px;">{{number_format($payment,2)}}</p></td>
                    <th>Amount Remaining</th>
                    <td class="text-dark d_rem_am">
                        <p class="d_r_am" style="margin-bottom: 0px;">{{number_format($re,2)}}</p>
                    </td>
                    <input type="hidden" class="form-check-input total_dep_amount" value="{{$total_am}}">
                    <input type="hidden" class="form-check-input total_app_am" value="{{$payment}}">
                    <input type="hidden" class="form-check-input total_rem_am" value="{{$re}}">
                    <input type="hidden" class="form-check-input call_am" value="{{$payment}}">
                    <input type="hidden" class="form-check-input dep_id_show" value="{{$deposit->id}}">
                    <input type="hidden" class="form-check-input dep_client_id_show" value="{{$deposit->client_id}}">
                </table>
            </div>
            <div class="deposit_table">
                <div class="table-responsive">
                    <table class="table-bordered table table-sm c_table d_table">
                        <thead>
                        <tr>
                            <th title="Select"><input type="checkbox" class="dep_apply_check_all"></th>
                            <th title="Id">Id</th>
                            <th title="DOS">DOS</th>
                            <th title="Units">Units</th>
                            <th title="Code">Cpt</th>
                            <th title="M1">M1</th>
                            <th title="Amount">Amount</th>
                            <th title="Payment" style="width: 80px;">Payment</th>
                            <th title="Adjustment" style="width: 80px;">Adjustment</th>
                            <th title="Balance">Balance</th>
                            <th title="Reason">Reason</th>
                            <th title="Status">Status</th>
                            <th title="See Payer">Sec Payer</th>
                            <th title="M2">M2</th>
                            <th title="M3">M3</th>
                            <th title="M4">M4</th>
                            <th title="M5">M5</th>
                            <th title="24j Provider">24j Provider</th>
                        </tr>
                        </thead>
                        <tbody class="apply_data">
                        </tbody>
                        <tbody class="show_animation">
                        @for($i=0;$i<40;$i++)
                            <tr data-tableexport-display="none">
                                <td>
                                    <div class="comment br animate"></div>
                                </td>
                                <td>
                                    <div class="comment br animate"></div>
                                </td>
                                <td>
                                    <div class="comment br animate"></div>
                                </td>
                                <td>
                                    <div class="comment br animate"></div>
                                </td>
                                <td>
                                    <div class="comment br animate"></div>
                                </td>
                                <td>
                                    <div class="comment br animate"></div>
                                </td>
                                <td>
                                    <div class="comment br animate"></div>
                                </td>
                                <td>
                                    <div class="comment br animate"></div>
                                </td>
                                <td>
                                    <div class="comment br animate"></div>
                                </td>
                                <td>
                                    <div class="comment br animate"></div>
                                </td>
                                <td>
                                    <div class="comment br animate"></div>
                                </td>
                                <td>
                                    <div class="comment br animate"></div>
                                </td>
                                <td>
                                    <div class="comment br animate"></div>
                                </td>
                                <td>
                                    <div class="comment br animate"></div>
                                </td>
                                <td>
                                    <div class="comment br animate"></div>
                                </td>
                                <td>
                                    <div class="comment br animate"></div>
                                </td>
                                <td>
                                    <div class="comment br animate"></div>
                                </td>
                                <td>
                                    <div class="comment br animate"></div>
                                </td>
                            </tr>
                        @endfor
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" class="text-right">Total</td>

                                <td class="tran_t_amt">0.00</td>
                                <td class="tran_t_pay">0.00</td>
                                <td class="tran_t_adj">0.00</td>
                                <td class="tran_t_bal">0.00</td>

                                <input type="hidden" class="tran_h_amt" value="0">
                                <input type="hidden" class="tran_h_pay" value="0">
                                <input type="hidden" class="tran_h_adj" value="0">
                                <input type="hidden" class="tran_h_bal" value="0">
                                
                                <td colspan = "8"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- select filter -->
                <div class="d-flex">
                    <div class="mr-2">
                        <select class="form-control form-control-sm select_btn action_id">
                            <option value="0"></option>
                            <option value="1">View Transaction</option>
                            <option value="2">Same as Billed</option>
                            <option value="3">Same as Balance</option>
                        </select>
                    </div>
                    <div class="align-self-end">
                        <button type="button" class="btn btn-sm btn-primary mr-2 okbtn" id="ok_btn">Ok</button>
                        <a href="#" class="btn btn-sm btn-primary" id="save">Save</a>
                    </div>
                </div>
                <!-- transaction table -->
                <div class="table-responsive mt-2 transaction_table" style="display: none;">

                </div>
            </div>
        </div>
    </div>

    <div class="loading2">
        <div class="table-loading"></div>
    </div>
@endsection
@include('superadmin.deposit.include.apply_js')

