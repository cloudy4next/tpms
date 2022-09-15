@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="overflow-hidden">
                <div class="float-left">
                    <h5>Add/Edit Deposit</h5>
                </div>
                <div class="float-right">
                    <a href="{{route('superadmin.billing.deposit')}}" class="btn btn-sm btn-primary"
                       title="Back To Deposit"><i class="ri-arrow-left-circle-line"></i>Back</a>
                </div>
            </div>
            <form action="{{route('superadmin.add.deposit.save')}}" enctype="multipart/form-data" method="post"
                  class="mt-2" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <label>Select Payee type</label>
                        <select class="form-control form-control-sm selectpyor" name="payor_type" required>
                            <option value="1">Client</option>
                            <option value="2" selected="selected">Payor</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2 allpayor">
                        <label>Payee</label>
                        <select class="form-control form-control-sm " name="payor_id">
                            <option value=""></option>
                            @foreach($all_payor as $alpayor)
                                <option
                                    value="{{$alpayor->payor_id}}">{{$alpayor->payor_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-2 allclient">
                        <label>Patients</label>
                        <select class="form-control form-control-sm" name="client_id">
                            @foreach($all_client as $client)
                                <option
                                    value="{{$client->id}}">{{$client->client_first_name}} {{$client->client_middle}} {{$client->client_last_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-2">
                        <label>Deposit Date</label>
                        <input type="date" class="form-control form-control-sm" name="deposit_date" required>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Payment Method</label>
                        <select class="form-control form-control-sm" name="payment_method" required>
                            <option value=""></option>
                            <option value="1">Check</option>
                            <option selected="selected" value="2">EFT</option>
                            <option value="3">Card</option>
                            <option value="4">Cash</option>
                            <option value="5">Credit</option>
                            <option value="6">Write off</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Check #</label>
                        <input type="text" class="form-control form-control-sm" name="instrument" required>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Check Date</label>
                        <input type="date" class="form-control form-control-sm" name="instrument_date" required>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Amount</label>
                        <input type="text" class="form-control form-control-sm amount" name="amount" required>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>File</label>
                        <br>
                        <input type="file" name="file">
                        {{--                        <div class="progress">--}}
                        {{--                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">25%</div>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Unallocated Amount</label>
                        <input type="text" class="form-control form-control-sm unamount" name="unapplied_amount"
                               readonly>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Notes</label>
                        <textarea class="form-control form-control-sm" name="notes"></textarea>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        <button type="reset" class="btn btn-sm btn-danger">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {

            $('.allpayor').hide();
            $('.allclient').hide();

            var selectval = $('.selectpyor ').find(':selected').val();
            console.log(selectval);

            if (selectval == 1) {
                $('.allpayor').hide();
                $('.allclient').show();
            } else if (selectval == 2) {
                $('.allpayor').show();
                $('.allclient').hide();
            }


            $('.selectpyor').change(function () {
                var id = $(this).val();
                if (id == 1) {
                    $('.allpayor').hide();
                    $('.allclient').show();
                } else if (id == 2) {
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
@endsection
