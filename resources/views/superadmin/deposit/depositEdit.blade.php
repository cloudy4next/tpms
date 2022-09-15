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
            <form action="{{route('superadmin.deposit.update')}}" enctype="multipart/form-data" autocomplete="off"
                  method="post" class="mt-2">
                @csrf
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <label>Select Payee type</label>
                        <select class="form-control form-control-sm selectpyor" name="payor_type" required>
                            <option value="1" {{$dep->payor_type == 1 ? 'selected' : ''}}>Client</option>
                            <option value="2" {{$dep->payor_type == 2 ? 'selected' : ''}} >Payor</option>
                        </select>
                        <input type="hidden" name="deposit_edit_id" value="{{$dep->id}}">
                    </div>
                    <div class="col-md-3 mb-2 allpayor">
                        <label>Payee</label>
                        <select class="form-control form-control-sm choose_payor" name="payor_id" required>
                            <option value="">select payee</option>
                            @foreach($all_payor as $alpayor)
                                <option
                                    value="{{$alpayor->payor_id}}" {{$dep->payor_id == $alpayor->payor_id ? 'selected' : ''}}>{{$alpayor->payor_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-2 allclient">
                        <label>Patients</label>
                        <select class="form-control form-control-sm choose_patient" name="client_id" required>
                            <option value="">select patient</option>
                            @foreach($all_client as $client)
                                <option
                                    value="{{$client->id}}" {{$dep->client_id == $client->id ? 'selected' : ''}}>{{$client->client_first_name}} {{$client->client_middle}} {{$client->client_last_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-2">
                        <label>Deposit Date</label>
                        <input type="date" class="form-control form-control-sm" name="deposit_date"
                               value="{{$dep->deposit_date}}" required>
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
                        <input type="text" class="form-control form-control-sm" name="instrument"
                               value="{{$dep->instrument}}" required>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Check Date</label>
                        <input type="date" class="form-control form-control-sm" name="instrument_date"
                               value="{{$dep->instrument_date}}" required>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Amount</label>
                        <input type="text" class="form-control form-control-sm" name="amount" value="{{number_format((double)$dep->amount,2)}}"
                               required>
                    </div>
                    <div class="col-md-3 mb-2">
                        <?php
                            $sm = \App\Models\deposit_apply::where('deopsit_id', $dep->id)->sum('payment');
                            $un = (double)$dep->amount - (double)$sm;
                        ?>
                        <label>Unallocated Amount</label>
                        <input type="text" class="form-control form-control-sm" name="unapplied_amount"
                               value="{{number_format($un,2)}}" disabled>
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
                            $get_name = substr($dep->file, 25);
                            $ext = pathinfo($dep->file, PATHINFO_EXTENSION);
                            $name = $get_name . $ext;
                            ?>
                            <a href="{{asset($dep->file)}}" download>{{$get_name}}</a>
                        @else
                            <a href="">No file</a>
                        @endif
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


            if (selectval == 1) {
                $('.allpayor').hide();
                $('.allclient').show();
                $('.choose_patient').attr("required", true);
                $('.choose_payor').attr("required", false);
            } else if (selectval == 2) {
                $('.allpayor').show();
                $('.allclient').hide();
                $('.choose_patient').attr("required", false);
                $('.choose_payor').attr("required", true);
            }


            $('.selectpyor').change(function () {
                var id = $(this).val();
                if (id == 1) {
                    $('.allpayor').hide();
                    $('.allclient').show();
                    $('.choose_patient').attr("required", true);
                    $('.choose_payor').attr("required", false);
                } else if (id == 2) {
                    $('.allpayor').show();
                    $('.allclient').hide();
                    $('.choose_patient').attr("required", false);
                    $('.choose_payor').attr("required", true);
                }
            })
        })
    </script>
@endsection
