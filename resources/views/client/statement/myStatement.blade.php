@extends('layouts.client')
@section('client')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <h2 class="common-title">Statement</h2>
            <div class="d-flex bg-primary text-white mb-2 px-2 py-1">
                <div class="align-self-center">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <input type="checkbox" class="mr-2">{{$clients->client_full_name}}
                        </li>
                        <li class="list-inline-item">
                            <select class="form-control form-control-sm payment_method">
                                <option value="1">Paid Statement</option>
                                <option value="2">UnPaid Statement</option>
                                <option value="3">Paid/Pending Posting Statement</option>
                            </select>
                        </li>
                    </ul>
                </div>
                <?php
                $client_data = \App\Models\Client::select('client_full_name', 'admin_id')->where('id', $clients->id)->where('admin_id', Auth::user()->admin_id)->first();
                $sum_copay = \App\Models\patient_statement::select('co_pay')->where('client_id', $clients->id)->where('admin_id', Auth::user()->admin_id)->sum('co_pay');
                $sum_coings = \App\Models\patient_statement::select('coins')->where('client_id', $clients->id)->where('admin_id', Auth::user()->admin_id)->sum('coins');
                $sum_ded = \App\Models\patient_statement::select('ded')->where('client_id', $clients->id)->where('admin_id', Auth::user()->admin_id)->sum('ded');
                $total = ($sum_copay + $sum_coings + $sum_ded);
                $all_stst_by_client = \App\Models\patient_statement::where('client_id', $clients->id)->where('admin_id', Auth::user()->admin_id)->get();
                ?>
                
                <div class="ml-auto align-self-center">
                    Total Due Amount = {{number_format($total,2)}}$
                </div>
            </div>
            <div class="table-responsive st_table">

            </div>
            <a class="btn btn-sm btn-success" href="{{route('client.mypayment')}}" target="_blank" id="pay_btn">Pay
                ({{number_format($total_sum,2)}}$)</a>
        </div>
    </div>
@endsection
@include('client.statement.include.includeJs')
