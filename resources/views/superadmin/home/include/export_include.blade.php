@section('js')
    <script>
        var timeStamp = moment().format('MMDYYYYhmmss');
        var file_name = $('#fileName').val();
        if (file_name == null) {
            file_name = 'report_';
        }

        file_name = file_name + timeStamp;

        var file_name2 = $('#fileName2').val();
        if (file_name2 == null) {
            file_name2 = 'report_';
        }

        file_name2 = file_name2 + timeStamp;

        $(document).ready(function() {
            $('#download_csv').click(function() {
                $('#export_table').tableExport({
                    type: 'csv',
                    fileName: file_name
                });
            });

            $('#download_pdf').click(function() {
                $('#export_table').tableExport({
                    type: 'pdf',
                    fileName: file_name,
                    jspdf: {
                        orientation: "L",
                        autotable: {
                            headerStyles: {
                                fillColor: [32, 122, 199],
                                textColor: 255,
                                fontStyle: 'bold',
                                halign: 'inherit',
                                valign: 'middle',
                            },
                            style: {
                                overflow: "linebreak",
                            }
                        }

                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#download_csv2').click(function() {
                $('#export_table2').tableExport({
                    type: 'csv',
                    fileName: file_name2
                });
            });

            $('#download_pdf2').click(function() {
                $('#export_table2').tableExport({
                    type: 'pdf',
                    fileName: file_name2,
                    jspdf: {
                        orientation: "L",
                        autotable: {
                            headerStyles: {
                                fillColor: [32, 122, 199],
                                textColor: 255,
                                fontStyle: 'bold',
                                halign: 'inherit',
                                valign: 'middle',
                            },
                            styles: {
                                overflow: "linebreak",
                            }
                        }

                    }
                });
            });
        });
    </script>


















    <script>
        $(document).ready(function() {
            let lastMonthBulledData = () => {
                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.last.month.dates.get') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        console.log(data);
                        $('.lastMonthBulledData').empty();
                        $('.lastMonthBulledData').html(data.view);

                        $('.loading2').hide();
                    }


                });
            };


            lastMonthBulledData();

            $(document).on('click', '.batchdetails', function() {
                $('.loading2').show();
                let batch_id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.last.month.dates.details') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'batch_id': batch_id
                    },
                    success: function(data) {
                        console.log(data);
                        $('.lastMonthBulledDetails').empty();
                        $('.lastMonthBulledDetails').html(data.view);
                        $('.detail-table').show();
                        $('.loading2').hide();
                    }


                });
            });


            $('#goBtn').click(function() {
                $('.loading2').show();
                let filtertype = $('.filtertype').val();
                let single_data = $('.single_data').val();
                let reportrange = $('.reportrange').val();

                if (filtertype == null || filtertype == '') {
                    $('.loading2').hide();
                    toastr["error"]("Please Select Date Type", 'ALERT!');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.last.month.dates.filter') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'filtertype': filtertype,
                            'single_data': single_data,
                            'reportrange': reportrange
                        },
                        success: function(data) {
                            console.log(data);
                            $('.lastMonthBulledData').empty();
                            $('.lastMonthBulledData').html(data.view);
                            $('.loading2').hide();
                        }


                    });
                }


            })


        })
    </script>

    <script>
        const hideAll = () => {
            $('.specific-date').hide();
            $('.date-range').hide();
            $('.detail-table').hide();
        }
        $('.filter-date').change(function(e) {
            let v = $(this).val();
            if (v == 1) {
                hideAll();
                $('.specific-date').show();
            } else if (v == 2) {
                hideAll();
                $('.date-range').show();
            } else {
                hideAll();
            }
        });
        $('.detail').click(function(e) {
            $('.detail-table').show();

        });
        hideAll();
    </script>








    <script>
        $(document).ready(function() {
            $('.download_div').hide();
            $('#get_authToExpire').click(function() {
                $('.loading2').show();
                inter = $('#time_interval').val();
                $.ajax({
                    url: "{{ route('superadmin.auth.to.expire.get') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "inter": inter,
                    },
                    success: function(data) {
                        console.log(data);
                        $('.authTable').empty();
                        $('.authTable').append(data.view);
                        $('.download_div').show();
                        $('.loading2').hide();
                        $('.c_table').tablesorter();
                    }
                });
            })
        })
    </script>



    <script>
        $(document).ready(function() {
            $('.download_div').hide();
            $('#get_authToExpire').click(function() {
                $('.loading2').show();
                inter = $('#time_interval').val();
                $.ajax({
                    url: "{{ route('superadmin.credntials.expire.get') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "inter": inter,
                    },
                    success: function(data) {
                        console.log(data);
                        $('.credentialsTable').empty();
                        $('.credentialsTable').append(data.view);
                        $('.download_div').show();
                        $('.loading2').hide();
                        $('.c_table').tablesorter();
                    }
                });
            })
        })
    </script>
@endsection
