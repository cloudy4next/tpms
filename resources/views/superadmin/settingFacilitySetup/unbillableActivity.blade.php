@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-lg-flex">
                <!-- menu -->
                <div class="setting_menu">
                    @include('superadmin.include.settingMenu')
                </div>
                <!-- content -->
                <div class="all_content flex-fill">
                    <h5>Non-Billable Service(s)</h5>
                    <div class="table-responsive p_table all_unbill_table">

                    </div>
                    <div class="d-flex">
                        <select class="form-control form-control-sm un_action">
                            <option value="0">Select Any</option>
                            <option>Retract</option>
                        </select>
                        <button class="btn btn-primary btn-sm ml-2" id="un_bill_save">Save</button>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.all_checked', function () {

                if ($(this).prop("checked") == true) {
                    $('.claim_checked').each(function () {
                        $(this).prop('checked', true);
                    });
                } else if ($(this).prop("checked") == false) {
                    $('.claim_checked').each(function () {
                        $(this).prop('checked', false);
                    });
                }
            });


            let getAllUnBillAct = () => {
                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.setting.unbillable.activity.get') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        console.log(data)
                        $('.all_unbill_table').empty();
                        $('.all_unbill_table').html(data.view)

                        $('.loading2').hide();
                    }
                });
            };

            getAllUnBillAct();


            $('#un_bill_save').click(function () {
                $('.loading2').show();
                let action_id = $('.un_action').val();
                if (action_id == 0) {
                    $('.loading2').hide();
                    toastr["error"]("Please Select Action", 'ALERT!');
                } else {
                    let claim_id = [];
                    $('.claim_checked:checked').each(function () {
                        claim_id.push($(this).val());
                    });

                    if (claim_id == null || claim_id.length == 0) {
                        $('.loading2').hide();
                        toastr["error"]("Please Select Claim", 'ALERT!');
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('superadmin.setting.unbillable.activity.update') }}",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'claim_id': claim_id
                            },
                            success: function (data) {
                                console.log(data)
                                if (data == 'done') {
                                    getAllUnBillAct();
                                    $('.loading2').hide();
                                    toastr["success"]("Retract Success", 'SUCCESS!');
                                } else {
                                    $('.loading2').hide();
                                    toastr["error"]("Claim Not Found", 'ALERT!');
                                }

                            }
                        });
                    }


                }
            })


        })
    </script>
@endsection
