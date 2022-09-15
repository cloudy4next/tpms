@section('js')
    <script>
        $(document).ready(function () {


            $('.treatment_type').change(function () {
                $('.loading2').show();
                let tret_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.subactivity.bill.type')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'tret_id': tret_id,
                    },
                    success: function (data) {
                        $('.is_billbale').empty();
                        $('.service_id').empty();
                        $('.is_billbale').append(
                            `<option value="0"></option>`
                        )
                        $.each(data, function (index, value) {
                            if (value.type == 1) {
                                $('.is_billbale').append(
                                    `<option value="1">Billable</option>`
                                )
                            } else if (value.type == 2) {
                                $('.is_billbale').append(
                                    `<option value="2">Non Billable</option>`
                                )
                            }
                            ;
                        });

                        $('.loading2').hide();
                    }
                });
            });


            $('.is_billbale').change(function () {
                $('.loading2').show();
                let tret_id = $('.treatment_type').val();
                let bill_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.subactivity.service')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'tret_id': tret_id,
                        'bill_id': bill_id,
                    },
                    success: function (data) {
                        $('.service_id').empty();
                        $('.service_id').append(
                            `<option value="0"></option>`
                        )
                        $.each(data, function (index, value) {
                            $('.service_id').append(
                                `<option value="${value.id}">${value.description}</option>`
                            )
                        });

                        $('.loading2').hide();
                    }
                });
            });


            $('.service_id').change(function () {
                $('.loading2').show();
                let tret_id = $('.treatment_type').val();
                let bill_type = $('.is_billbale').val();
                let ser_id = $('.service_id').val();

                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.subactivity.data')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'tret_id': tret_id,
                        'bill_type': bill_type,
                        'ser_id': ser_id,
                    },
                    success: function (data) {
                        console.log(data)
                        $('.sub_act_data').empty();
                        $('.sub_act_data').append(data.view);
                        $('.loading2').hide();
                    }
                });

            })


            $('#create_new_act').click(function () {
                $('.loading2').show();
                let treatment_type = $('.treatment_type').val();
                let is_billbale = $('.is_billbale').val();
                let service_id = $('.service_id').val();
                let new_desc = $('.new_desc').val();


                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.new.subactivity.save')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'treatment_type': treatment_type,
                        'is_billbale': is_billbale,
                        'service_id': service_id,
                        'new_desc': new_desc,

                    },
                    success: function (data) {

                        if(data == 'already'){
                            toastr["error"]("Description already exists.","ALERT!");
                        }
                        else{
                            $('.new_desc').val('');
                            if ($('.create_hide_cal').prop('checked') == true) {
                                $('.create_hide_cal').prop('checked', false);
                            }

                            $('.create_new_sub_act').hide();
                            $('.edit_activity').hide();

                            getLoadedData();
                        }
                        $('.loading2').hide();
                    }
                });

            });


            $(document).on('click', '.edit_admin_act', function () {
                $('.create_new_sub_act').hide();
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.single.activity')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'id': id,
                    },
                    success: function (data) {
                        $('.act_edit_id').empty().val(data.id)
                        $('.desc').empty().val(data.sub_activity)

                        getLoadedData();
                        $('.loading2').hide();
                    }
                });
            });


            $('#act_update').click(function (e) {
                e.preventDefault();
                var edi_id = $('.act_edit_id').val();
                var desc = $('.desc').val();


                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.single.activity.update')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'edi_id': edi_id,
                        'desc': desc,

                    },
                    success: function (data) {

                        $('.act_edit_id').empty().val(data.id)
                        $('.desc').empty().val(data.sub_activity)

                        $('.create_new_sub_act').hide();
                        $('.edit_activity').hide();
                        getLoadedData();

                        $('.loading2').hide();
                    }
                });

            });


            $(document).on('click', '.delete_admin_act', function () {
                let del_id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.single.activity.delete')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'id': del_id,
                    },
                    success: function (data) {

                        if(data == "already"){
                            toastr["error"]("Service has active billing.","ALERT!");

                        }
                        else if(data == "done"){
                            $('.create_new_sub_act').hide();
                            $('.edit_activity').hide();
                            getLoadedData();
                        }
                        else{
                            toastr["error"]("Unexpected error occurred.","ALERT!");
                        }


                        $('.loading2').hide();
                    }
                });

            })



            $(document).on('change','.active_switch',function(){
                $('.loading2').show();
                id = $(this).data('id');
                if($(this).prop("checked") == true){
                    status = 1;
                }
                else{
                    status = 2;
                }

                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.subactivity.change.status')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'id': id,
                        'status': status,
                    },
                    success: function (data) {
                        if(data == "done"){
                            $('.loading2').hide();
                        }
                        else{
                            toastr["error"]("Unexpected error occurred.","ALERT!");
                            $('.loading2').hide();
                        }
                    }
                });
            })


            function getLoadedData() {
                $('.loading2').show();
                let tret_id = $('.treatment_type').val();
                let bill_type = $('.is_billbale').val();
                let ser_id = $('.service_id').val();

                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.subactivity.data')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'tret_id': tret_id,
                        'bill_type': bill_type,
                        'ser_id': ser_id,
                    },
                    success: function (data) {

                        $('.sub_act_data').empty();
                        $('.sub_act_data').append(data.view);
                        $('.loading2').hide();
                    }
                });

            };


        })
    </script>
    <script>
        jQuery(document).ready(function ($) {
            $('.activity_billable').hide();
            $('.activity_nonbillable').hide();
            $('.activity_table').hide();
            $('.create_new_sub_act').hide();
            $('.edit_activity').hide();
            $('.type_filter select').change(function (event) {
                var v = $(this).val();
                $('.activity_billable').show();
            });
            $('.activity_billable select').change(function (event) {
                var v = $(this).val();
                if (v == 0) {
                    $('.activity_table').hide();
                } else
                    $('.activity_table').show();
            });
            $('.activity_nonbillable select').change(function (event) {
                var v = $(this).val();
                if (v == 0) {
                    $('.activity_table').hide();
                } else
                    $('.activity_table').show();
            });


            $(document).on('click', '.edit_btn', function () {
                $('.edit_activity').show();
                $('.create_new_sub_act').hide();
                $('.cancel_edit').click(function (event) {
                    $('.edit_activity').hide();
                });
            })


            $(document).on('click', '.add_activity', function () {
                $('.create_new_sub_act').show();
                $('.edit_activity').hide();
            })

        });
    </script>
@endsection
