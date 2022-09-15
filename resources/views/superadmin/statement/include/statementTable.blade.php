<?php
if(Auth::user()->is_up_admin==1){
    $admin_id=Auth::user()->id;
}
else{
    $admin_id=Auth::user()->up_admin_id;
}
?>


@foreach($statements as $statement)
    
    <?php

    $client_data = \App\Models\Client::select('client_full_name', 'admin_id')
        ->where('id', $statement->client_id)->where('admin_id', $admin_id)
        ->first();
    $sum_copay = \App\Models\patient_statement::select('co_pay')
        ->where('client_id', $statement->client_id)
        ->where('admin_id', $admin_id)
        ->whereIn('deposit_apply_id',$dep_app_ids)
        ->where('service_date','>=',$from_date)
        ->where('service_date','<=',$to_date)
        ->sum('co_pay');
    $sum_coings = \App\Models\patient_statement::select('coins')
        ->where('client_id', $statement->client_id)
        ->where('admin_id', $admin_id)
        ->whereIn('deposit_apply_id',$dep_app_ids)
        ->where('service_date','>=',$from_date)
        ->where('service_date','<=',$to_date)
        ->sum('coins');
    $sum_ded = \App\Models\patient_statement::select('ded')
        ->where('client_id', $statement->client_id)
        ->where('admin_id', $admin_id)
        ->whereIn('deposit_apply_id',$dep_app_ids)
        ->where('service_date','>=',$from_date)
        ->where('service_date','<=',$to_date)
        ->sum('ded');
    $total = ($sum_copay + $sum_coings + $sum_ded);
    $all_stst_by_client = \App\Models\patient_statement::select('id','service_date', 'client_id', 'admin_id','is_submit','activity_id','deposit_apply_id')
        ->where('client_id', $statement->client_id)
        ->where('admin_id', $admin_id)
        ->whereIn('deposit_apply_id',$dep_app_ids)
        ->where('service_date','>=',$from_date)
        ->where('service_date','<=',$to_date)
        ->get();
    //Illuminate\Support\Facades\Log::info('All Statements for Client '.$statement->client_full_name.' are :'.count($all_stst_by_client));
    ?>
    <!-- accordion item -->
    @if($client_data && count($all_stst_by_client)>0)
        <div id="accordion-parent">
            <div class="d-flex bg-primary text-white mb-2 px-2">
                <div class="align-self-center">
                    <input type="checkbox" class="mr-2 client_check client_check{{$statement->client_id}}" name="check_client_id[]" value="{{$statement->client_id}}" data-id="{{$statement->client_id}}">
                </div>
                <div class="align-self-center" data-toggle="collapse" data-target="#ai1{{$statement->client_id}}" style="cursor:pointer;">
                    {{$client_data->client_full_name}}
                </div>
                <div class="ml-auto align-self-center">
                    {{-- <div class="form-check-inline">
                        <label class="form-check-label text-white">
                            <input type="checkbox" class="form-check-input">CC | 
                        </label>
                    </div> --}}
                    Total Due Amount = {{number_format($total,2)}}$
                    {{-- <a href="#" title="Save" class="btn btn-sm btn-teal mx-1"><i class="ri-save-2-line text-white"></i></a>
                    <a href="{{route('superadmin.statement.delete',$statement->client_id)}}" title="Delete"
                       class="btn btn-sm btn-danger"><i class="ri-delete-bin-line text-white"></i></a> --}}
                </div>
                <div class="custom-control custom-switch ml-2 my-1">
                    <input type="checkbox" class="custom-control-input submit_switch" id="submit_switch{{$statement->client_id}}" data-id="{{$statement->client_id}}">
                    <label class="custom-control-label text-white" for="submit_switch{{$statement->client_id}}">Not Submitted</label>
                </div>
                <div class="custom-control custom-switch ml-2 my-1">
                    <button type="button" class="btn btn-sm btn-danger email_btn" data-id="{{$statement->client_id}}">Email</button>
                </div>
            </div>
            <div id="ai1{{$statement->client_id}}" class="collapse show" data-parent="#accordion-parent">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered c_table statement_table">
                        <thead>
                        <tr>
                            <th><input type="checkbox" class="select_all_record select_all_record{{$statement->client_id}}" data-id="{{$statement->client_id}}"></th>
                            <th>Service Date</th>
                            <th>Description</th>
                            <th>Copay</th>
                            <th>Coins</th>
                            <th>Deductible</th>
                            <th width="6%">Submitted</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($all_stst_by_client as $dep_dat)
                            <?php
                            $act_name = \App\Models\Client_authorization_activity::where('id', $dep_dat->activity_id)->where('admin_id', $admin_id)->first();
                            $dep_app_tarn = \App\Models\deposit_apply_transaction::where('id', $dep_dat->deposit_apply_id)->where('admin_id',$admin_id)->first();
                            ?>
                            @if($dep_app_tarn )

                                @if($dep_app_tarn->status == "PR Copay" || $dep_app_tarn->status == "PR CoIns" || $dep_app_tarn->status == "PR Ded")
                                    <tr class="data_row">
                                        <td>
                                            <input type="checkbox" class="m-0 select_in_record" name="dep_apply_check_value[]" value="{{$dep_dat->id}}" pdf-id="{{$dep_app_tarn->deposit_apply_id}}">
                                            <label></label>
                                        </td>
                                        <td>{{\Carbon\Carbon::parse($dep_dat->service_date)->format('m/d/Y')}}</td>
                                        <td>
                                            @if ($act_name)
                                                {{$act_name->activity_name}} {{$dep_app_tarn->appointment_id}}
                                            @endif

                                        </td>
                                        <td>
                                            @if ($dep_app_tarn->status == "PR Copay")
                                                {{number_format($dep_app_tarn->balance,2)}}
                                            @else
                                                0.00
                                            @endif
                                        </td>
                                        <td>
                                            @if ($dep_app_tarn->status == "PR CoIns")
                                                {{number_format($dep_app_tarn->balance,2)}}
                                            @else
                                                0.00
                                            @endif
                                        </td>
                                        <td>
                                            @if ($dep_app_tarn->status == "PR Ded")
                                                {{number_format($dep_app_tarn->balance,2)}}
                                            @else
                                                0.00
                                            @endif
                                        </td>
                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" value="1" class="custom-control-input submit_in_switch" id="submit_in_switch{{$dep_dat->id}}" autocomplete="nope" data-id="{{$dep_dat->id}}" {{$dep_dat->is_submit == 1?'checked':''}}>
                                                <label class="custom-control-label" for="submit_in_switch{{$dep_dat->id}}">{{$dep_dat->is_submit == 1?'Yes':'No'}}</label>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        {{-- <div class="d-flex bg-primary text-white mb-2 px-2" data-toggle="collapse"
             data-target="#ai1{{$statement->client_id}}">
            <div class="align-self-center">
                <input type="checkbox" class="mr-2" name="check_client_id[]"
                       value="">No Patient
            </div>
            <div class="ml-auto align-self-center">
                <div class="form-check-inline">
                    <label class="form-check-label text-white">
                        <input type="checkbox" class="form-check-input">CC
                    </label>
                </div>
                | Total Due Amount = 0.00$ <a href="#" title="Save" class="btn btn-sm btn-teal mx-1"><i
                        class="ri-save-2-line text-white"></i></a>
                <a href="#" title="Delete"
                   class="btn btn-sm btn-danger"><i
                        class="ri-delete-bin-line text-white"></i></a>
            </div>
        </div> --}}
    @endif

@endforeach



