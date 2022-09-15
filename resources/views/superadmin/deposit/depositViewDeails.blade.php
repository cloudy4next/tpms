@extends('layouts.superadmin')
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="overflow-hidden">
                <div class="float-left">
                    <h5 class="common-title">Add/Edit Deposit</h5>
                </div>
                <div class="float-right">
                    <a href="{{route('superadmin.billing.deposit')}}" class="btn btn-sm btn-primary"
                       title="Back To Deposit"><i class="ri-arrow-left-circle-line"></i>Back</a>
                </div>
            </div>
            <form action="#" method="post" class="mt-2">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <label>Select Payee type</label>
                        <select class="form-control form-control-sm selectpyor" name="payor_type" required>
                            <option value="1" {{$dep->payor_type == 1 ? 'selected' : ''}}>Client</option>
                            <option value="2" {{$dep->payor_type == 2 ? 'selected' : ''}} selected="selected">Payor</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Payee</label>
                        <select class="form-control form-control-sm " name="payor_id" required>
                            <option value=""></option>
                            @foreach($all_payor as $alpayor)
                                <option value="{{$alpayor->id}}" {{$dep->payor_id == $alpayor->id ? 'selected' : ''}}>{{$alpayor->payor_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-2 allclient">
                        <label>Patients</label>
                        <select class="form-control form-control-sm " name="client_id" required>
                            <option value=""></option>
                            @foreach($all_client as $client)
                                <option value="{{$client->id}}" {{$dep->client_id == $client->id ? 'selected' : ''}}>{{$client->client_first_name}} {{$client->client_middle}} {{$client->client_last_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Deposit Date</label>
                        <input type="date" class="form-control form-control-sm" name="deposit_date" value="{{$dep->deposit_date}}" required>
                        <input type="hidden" class="form-control form-control-sm dep_id" value="{{$dep->id}}">
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Payment Method</label>
                        <select class="form-control form-control-sm" name="payment_method" required>
                            <option value=""></option>
                            <option value="1" {{$dep->payment_method == 1 ? 'selected' : ''}}>Check</option>
                            <option value="2" {{$dep->payment_method == 2 ? 'selected' : ''}}>EFT</option>
                            <option value="3" {{$dep->payment_method == 3 ? 'selected' : ''}}>Card</option>
                            <option value="4" {{$dep->payment_method == 4 ? 'selected' : ''}}>Cash</option>
                            <option value="5" {{$dep->payment_method == 5 ? 'selected' : ''}}>Credit</option>
                            <option value="6" {{$dep->payment_method == 6 ? 'selected' : ''}}>Write off</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Check #</label>
                        <input type="text" class="form-control form-control-sm" name="instrument" value="{{$dep->instrument}}" required>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Check Date</label>
                        <input type="date" class="form-control form-control-sm" name="instrument_date" value="{{$dep->instrument_date}}" required>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Amount</label>
                        <input type="text" class="form-control form-control-sm" name="amount" value="{{number_format((double)$dep->amount,2)}}" required>
                    </div>
                    <div class="col-md-3 mb-2">
                        <?php
                            $sm = \App\Models\deposit_apply::where('deopsit_id', $dep->id)->sum('payment');
                            $un = (double)$dep->amount - (double)$sm;
                        ?>
                        <label>Unallocated Amount</label>
                        <input type="text" class="form-control form-control-sm" name="unapplied_amount" value="{{number_format($un,2)}}" disabled>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Notes</label>
                        <textarea class="form-control form-control-sm" name="notes">{!! $dep->notes !!}</textarea> 
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>File</label>
                        <br>
                        <input type="file" name="file">
                        @if (!empty($dep->file) && file_exists($dep->file))
                            <?php
                            $get_name = substr($dep->file,25);
                            $ext = pathinfo($dep->file, PATHINFO_EXTENSION);
                            $name = $get_name.$ext;
                            ?>
                            <a href="{{asset($dep->file)}}" download>{{$get_name}}</a>
                        @else
                            <a href="">No file</a>
                        @endif
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Select Any</label>
                        <select class="form-control form-control-sm change_type select-box">
                            <option value="0"></option>
                            <option value="1">View Details</option>
                            <option value="2">Apply Payment</option>
                        </select>
                    </div>
                    <div class="col-md-3 mt-4 mb-2 show_go_btn">
                        <a href="{{route('superadmin.deposit.apply',$dep->id)}}" target="_blank">
                            <button type="button" class="btn btn-primary btn-sm">Go</button>
                        </a>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        <button type="reset" class="btn btn-sm btn-danger">Cancel</button>
                    </div>
                </div>
            </form>
            <!-- view transaction -->
            <div class="table-responsive mt-2 transaction_table view_table_details">

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('.show_go_btn').hide()
            $('.change_type').change(function () {
                $('.loading2').show();
                var id = $(this).val();
                var dep_id = $('.dep_id').val();
                if (id == 0){
                   $('.view_table_details').hide();
                    $('.loading2').hide();
                }else if (id == 1){
                    $('.loading2').show();
                    $('.show_go_btn').hide()
                    $.ajax({
                        type : "POST",
                        url: "{{route('superadmin.deposit.details.arledger')}}",
                        data : {
                            '_token' : "{{csrf_token()}}",
                            'dep_id':dep_id
                        },
                        success:function(data){
                            console.log(data);
                            $('.view_table_details').empty();
                            $('.view_table_details').html(data.view);
                            $('.view_table_details').show();
                            $('.view_table_details').show();
                            $('.loading2').hide();
                        }
                    });
                }else if (id == 2){
                    $('.loading2').show();
                    $('.view_table_details').hide();
                    $('.show_go_btn').show()
                    $('.loading2').hide();
                }else {
                    $('.loading2').hide();
                    $('.view_table_details').hide();
                    $('.loading2').hide();
                }
            })
        })
    </script>
    <script>
        $(document).ready(function () {

            $('.allpayor').hide();
            $('.allclient').hide();

            var selectval = $('.selectpyor ').find(':selected').val();
            console.log(selectval);

            if (selectval == 1){
                $('.allpayor').hide();
                $('.allclient').show();
            }else if (selectval == 2){
                $('.allpayor').show();
                $('.allclient').hide();
            }


            $('.selectpyor').change(function () {
                var id = $(this).val();
                if (id == 1){
                    $('.allpayor').hide();
                    $('.allclient').show();
                }else if (id == 2){
                    $('.allpayor').show();
                    $('.allclient').hide();
                }
            })
        })
    </script>
    <script>
        $(document).ready(function () {
            $('.amount').keyup(function () {
                var data_am = $(this).val();
                $('.unamount').val(data_am);
            })
        })
    </script>
    <script>
        $('.transaction_table').hide();
        $('.select-box').change(function (event) {
            let v = $(this).val();
            if (v == 1) {
                $('.transaction_table').show();
            } else {
                $('.transaction_table').hide();
            }
        });
    </script>
@endsection
