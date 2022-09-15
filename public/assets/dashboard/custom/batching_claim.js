jQuery(document).ready(function ($) {
    $('.client_filter').hide();
    $('.payor_filter').hide();
    $('.filter2').hide();
    $('.client_filter2').hide();
    $('.payor_filter2').hide();
    $('.providerj_filter').hide();
    $('.batch_table').hide();
    $('.gmp').hide();
    $('.to_date').hide();

    // Filter 1
    $('.filter1 select').change(function (event) {
        var value = $(this).val();
        $('.go_btn').click(function (event) {
            $('.batch_table').show();
            $('.gmp').show();
        });
        if (value == 1) {
            $('.client_filter').show();
            $('.filter2').show();
            $('.filter2 select').val(0);
            $('.payor_filter').hide();
            $('.client_filter2').hide();
            $('.payor_filter2').hide();
            $('.providerj_filter').hide();
            $('.to_date').show();
        } else if (value == 2) {
            $('.payor_filter').show();
            $('.filter2').show();
            $('.filter2 select').val(0);
            $('.client_filter').hide();
            $('.client_filter2').hide();
            $('.payor_filter2').hide();
            $('.providerj_filter').hide();
            $('.to_date').show();
        } else if (value == 3) {
            $('.payor_filter').hide();
            $('.filter2').hide();
            $('.filter2 select').val(0);
            $('.client_filter').hide();
            $('.client_filter2').hide();
            $('.payor_filter2').hide();
            $('.providerj_filter').show();
            $('.to_date').show();
        } else {
            $('.client_filter').hide();
            $('.payor_filter').hide();
            $('.filter2').hide();
            $('.client_filter2').hide();
            $('.payor_filter2').hide();
            $('.to_date').show();
            $('.to_date').hide();
        }
    });
    // Filter 2
    $('.filter2 select').change(function (event) {
        var value = $(this).val();
        if (value == 1) {
            $('.client_filter2').show();
            $('.payor_filter2').hide();
        } else if (value == 2) {
            $('.payor_filter2').show();
            $('.client_filter2').hide();
        } else {
            $('.client_filter2').hide();
            $('.payor_filter2').hide();
        }
    });
});
