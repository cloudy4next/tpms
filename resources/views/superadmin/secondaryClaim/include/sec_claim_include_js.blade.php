@section('js')
    <script>
        $(document).ready(function () {
            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.secondary.claim.get') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                },
                success: function (data) {
                    console.log(data)
                    $('.sec_claim_transaction').empty();
                    $('.sec_claim_transaction').html(data.view);
                    $('.loading2').hide();
                }
            });


            $(document).on('click', '.select_all_sec_claim', function () {
                if ($(this).prop("checked") == true) {
                    $('.claim_id_select').each(function () {
                        $(this).prop('checked', true);
                        jQuery(this).closest('tr').find(".add_claim_ids").prop('disabled', false);
                    });
                }
            })

            $(document).on('click', '.select_all_sec_claim', function () {
                if ($(this).prop("checked") == false) {
                    $('.claim_id_select').each(function () {
                        $(this).prop('checked', false);
                        jQuery(this).closest('tr').find(".add_claim_ids").prop('disabled', true);
                    });
                }
            })


            $('#cl_tran_ok_btn').click(function () {
                $('.loading2').show();
                $('.claim_tran_show').hide();
                var ac_id = $('.claim_transacton_action').val();

                var array = [];
                $('.claim_id_select:checked').each(function () {
                    array.push($(this).val());
                });


                if (array.length <= 0 || array == null) {
                    $('.loading2').hide();
                    toastr["error"]("Please Select Claim", 'ALERT!');
                } else if (ac_id == 4) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.secondary.claim.show.details') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'array': array
                        },
                        success: function (data) {
                            console.log(data)
                            $('.secclaim_transaction').empty();
                            $('.secclaim_transaction').html(data.view);
                            $('.loading2').hide();
                        }
                    });
                } else if (ac_id == 6) {
                    $('.loading2').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.secondary.claim.generate') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'array': array
                        },
                        success: function (data) {
                            console.log(data)
                            $('.loading2').hide();
                        }
                    });


                } else {
                    $('.loading2').hide();
                }

            })


        })
    </script>
@endsection
