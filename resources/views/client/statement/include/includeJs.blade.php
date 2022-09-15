@section('js')
    <script>
        // $('#pay_btn').hide();
        // $('.payment_method').change(function (e) {
        //     let v = $(this).val();
        //     if (v == 2)
        //         $('#pay_btn').show();
        // });
    </script>
    <script>
        $(document).ready(function () {
            let payment_method = $('.payment_method').val();
            $('.loading2').show();
            $('#pay_btn').hide();
            if (payment_method == 1) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('client.statement.get.paid.data') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        $('.st_table').empty();
                        $('.st_table').html(data.view);
                        $('.loading2').hide();
                        console.log(data);

                    }
                });
            }

            $('.payment_method').change(function () {
                $('.loading2').show();
                let met = $(this).val();
                if (met == 1) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('client.statement.get.paid.data') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            $('.st_table').empty();
                            $('.st_table').html(data.view);
                            $('#pay_btn').hide();
                            $('.loading2').hide();
                            console.log(data);

                        }
                    });
                } else if (met == 2) {
                    $('.loading2').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('client.statement.get.unpaid.data') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            $('.st_table').empty();
                            $('.st_table').html(data.view);
                            $('#pay_btn').show();
                            $('.loading2').hide();
                            console.log(data);

                        }
                    });
                } else if (met == 3) {
                    $('.loading2').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('client.statement.get.data') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            $('.st_table').empty();
                            $('.st_table').html(data.view);
                            $('#pay_btn').hide();
                            $('.loading2').hide();
                            console.log(data);

                        }
                    });
                }
            });


            $(document).on('click', '.select_all', function () {

                if ($(this).prop("checked") == true) {
                    $('.st_checked').each(function () {
                        $(this).prop('checked', true);
                    });
                } else if ($(this).prop("checked") == false) {
                    $('.st_checked').each(function () {
                        $(this).prop('checked', false);
                    });
                }


            })


        })
    </script>
@endsection
