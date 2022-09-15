@section('js')
    <script>
        jQuery(document).ready(function () {
            $('.client_filter').hide();
            $('.payor_filter').hide();
            $('.providerj_filter').hide();
            $('.batch_table').hide();
            $('.to_date').hide();
            $('.gmp').hide();
            // Filter 1
            $('.filter1 select').change(function (event) {
                var value = $(this).val();
                $('.go_btn').click(function (event) {
                    $('.batch_table').show();
                    $('.gmp').show();
                });
                if (value == 2) {
                    $('.client_filter').show();
                    $('.payor_filter').hide();
                    $('.providerj_filter').hide();
                    $('.to_date').show();
                } else if (value == 3) {
                    $('.payor_filter').show();
                    $('.client_filter').hide();
                    $('.providerj_filter').hide();
                    $('.to_date').show();
                } else {
                    $('.client_filter').hide();
                    $('.payor_filter').hide();
                    $('.providerj_filter').show();
                    $('.to_date').hide();
                }
            });
            // $('.filter2 select').change(function (event) {
            //     var value = $(this).val();
            //     $('.go_btn').click(function (event) {
            //         $('.batch_table').show();
            //         $('.gmp').show();
            //     });
            //     if (value == 2) {
            //         $('.client_filter2').show();
            //         $('.payor_filter2').hide();
            //         $('.providerj_filter2').hide();
            //     } else if (value == 3) {
            //         $('.payor_filter2').show();
            //         $('.client_filter2').hide();
            //         $('.providerj_filter2').hide();
            //     } else {
            //         $('.client_filter2').hide();
            //         $('.payor_filter2').hide();
            //         $('.providerj_filter2').show();
            //     }
            // });
        });
    </script>



@endsection
