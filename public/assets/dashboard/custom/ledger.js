jQuery(document).ready(function($) {
    $('.ledger_table').hide();
    $('.transaction_table').hide();
    $('.add_notes').hide();
    $('.view_btn').click(function(event) {
        // $('.ledger_table').show();
    });
    $(".ledger_table .table input[type=checkbox]").click(function() {
        if ($(this).prop("checked")) {
            $('.select_btn').change(function(event) {
                var name = $(this).val();
                console.log(name);
                if (name == 1) {
                    document.getElementById("ok_btn").onclick = function() {
                        $('.transaction_table').show();
                        $('.add_notes').hide();
                    };
                } else if (name == 2) {
                    document.getElementById("ok_btn").onclick = function() {
                        $('.add_notes').show();
                        $('.transaction_table').hide();
                        $('.cancel_btn').click(function(event) {
                            $('.add_notes').hide();
                        });
                    };
                }
            });
        }
    });
});
