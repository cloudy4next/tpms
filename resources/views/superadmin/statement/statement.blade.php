@extends('layouts.superadmin')
@section('superadmin')
<?php
    if(Auth::user()->is_up_admin==1){
    $admin_id=Auth::user()->id;
}
else{
    $admin_id=Auth::user()->up_admin_id;
}

?>


    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <!-- Filter -->
            <h2 class="common-title"> Statement</h2>
            <form action="{{route('superadmin.statement.view.pdf')}}" method="post" target="_blank" id="pdf_form">
                @csrf
                <div class="d-flex mb-2">
                    <div class="mr-2 select_client">
                        <label>Related to</label>
                        <select class="form-control form-control-sm related_to">
                            <option value="0"></option>
                            <option value="1">All Client</option>
                            <option value="2">Selective Client</option>
                            <option value="3">Selective Private Payor</option>
                        </select>
                    </div>
                    <div class="mr-2">
                        <label>Select Date</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input class="form-control form-control-sm reportrange data_range" readonly>
                        </div>
                        <input type="hidden" class="client_ids" name="client_ids" value="">
                        <input type="hidden" class="client_rec" name="client_rec" value="">
                    </div>
                    <div class="align-self-end">
                        <button type="button" class="btn btn-sm btn-primary mt-4" id="run">Run</button>
                    </div>
                    <div class="align-self-end">
                        <button type="button" class="btn btn-sm btn-danger mt-4 ml-2" value="1" id="select_all_btn">Select All</button>
                    </div>
                    <div class="align-self-end ml-auto">
                        <button type="button" class="btn btn-sm btn-primary view_btn" id="">View</button>
                    </div>
                </div>
                <!-- Table List -->
                <div class="accordion stmt_table" id="accordion-parent">
               
                </div>


            </form>
        </div>
    </div>


    <div class="modal fade" id="selectClient" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Select Client</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered c_table">
                            <thead>
                            <tr>
                                <th><input type="checkbox" class="select_all_client"></th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>DOB</th>
                                <th>Guarantor</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $client)
                                <?php
                                $gran = \App\Models\Client_guarantar_info::where('client_id', $client->id)
                                    ->where('admin_id', $admin_id)
                                    ->first();
                                ?>
                                <tr>
                                    <td><input type="checkbox" value="{{$client->id}}" class="select_in_client"></td>
                                    <td>{{$client->client_first_name}}</td>
                                    <td>{{$client->client_last_name}}</td>
                                    <td>{{\Carbon\Carbon::parse($client->client_dob)->format('m/d/Y')}}</td>
                                    <td>
                                        @if ($gran)
                                            {{$gran->guarantor_first_name}} {{$gran->guarantor_last_name}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary select_client_btn">Select</button>
                    <button type="button" class="btn btn-danger close_modal_btn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- selective payor -->
    <div class="modal fade" id="selectPayor" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Select Payor</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered c_table">
                            <thead>
                            <tr>
                                <th><input type="checkbox" class="select_all_payor"></th>
                                <th>Payor</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payors as $payor)
                                <tr>
                                    <td><input type="checkbox" value="{{$payor->payor_id}}" class="select_in_payor"></td>
                                    <td>{{$payor->payor_name}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary select_payor_btn">Select</button>
                    <button type="button" class="btn btn-danger close_modal_btn" data-dismiss="modal">Close</button>
                </div> 
            </div>
        </div>
    </div>

@endsection
@include('superadmin.statement.include.include_js')
