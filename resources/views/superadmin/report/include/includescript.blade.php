@section('js')
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <script src="{{ asset('assets/dashboard/custom/report.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.calendar_table').hide();
            $('.show_animation').show();
            $('.download_div').hide();
            $('.loading2').hide();
            $('.page_container').hide();
            $('.export_btn').click(function(event) {
                $('.calendar_table').show();
            });


            var ENDPOINT = "{{ url('/') }}";
            var page = 1;
            var current_page = 0;
            let bool = false;
            let lastPage;
            var currentscrollHeight = 0;


            $(window).scroll(function() {

<<<<<<< HEAD
            const scrollHeight = $(document).height();
            const scrollPos = Math.floor($(window).height() + $(window).scrollTop());
            const isBottom = scrollHeight - 100 < scrollPos;
            if (isBottom && currentscrollHeight < scrollHeight) {
                page++;
                //alert('calling...');
                var myurl = ENDPOINT + '/admin/report-show?page=' + page;
                // console.log(myurl);
                total_p = $('.total_pages').data("id");
                // console.log('total_pages:',total_p);
                console.log('current_page:',page);
                if(page<=total_p){
                    getData(myurl);
                }
                currentscrollHeight = scrollHeight;
            }
=======
                const scrollHeight = $(document).height();
                const scrollPos = Math.floor($(window).height() + $(window).scrollTop());
                const isBottom = scrollHeight - 100 < scrollPos;
                if (isBottom && currentscrollHeight < scrollHeight) {
                    page++;
                    //alert('calling...');
                    var myurl = ENDPOINT + '/admin/report-show?page=' + page;
                    // console.log(myurl);
                    getData(myurl);
                    currentscrollHeight = scrollHeight;
                }
>>>>>>> origin/jahangir
            });

            $(document).on('click', '.continue_btn', function() {
                checked = 0;
                $('#report_form input[type="checkbox"]:visible').each(function() {
                    if ($(this).prop('checked') == true) {
                        checked = 1;
                        return false;
                    }
                });

                if (checked == 1) {
                    // $('#report_form').submit();
                } else {
                    toastr["error"]('Please select some columns to proceed.', 'ALERT!');
                }
            });


            $('#getdetailReport').click(function(e) {
                e.preventDefault();
                getAppReportData();

            });

<<<<<<< HEAD
        let getAppReportData = () => {
            $('.show_animation').show();
            $('.show_data').empty();
            $('.show_data').hide();
            page = 1;
            currentscrollHeight = 0;
            report = $('.reportFilter').val();
            date_type = $('.filter-date').val();
            console.log(report);
            finalResult = false;
            single_date = $('.single_date').val();
            daterange = $('.reportrange').val();

            if (report == 0) {
                toastr["error"]("Please select report.", 'ALERT!');
            } else {
                if (date_type == 0) {
                    toastr["error"]("Please select date type.", 'ALERT!');
                } else {
                    if (date_type == 1) {
                        if (single_date == '') {
                            toastr["error"]("Please select specific date.", 'ALERT!');
                        } else {
                            finalResult = true;
                        }
                    } else if (date_type == 2) {
                        if (daterange == '') {
                            toastr["error"]("Please select date range.", 'ALERT!');
                        } else {
                            finalResult = true;
                        }
                    }
                }

            }
            if(finalResult == true)
            {
                $.ajax({
                            type: "POST",
                            url: "{{ route('superadmin.report.show') }}",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'report': report,
                                'single_date': single_date,
                                'daterange': daterange,

                            },
                            success: function(data) {
                                console.log(data);

                                $('.total_pages').each(function(){
                                    $(this).html(data.notices.last_page);
                                    $(this).data("id",data.notices.last_page);
                                })

                                $('.current_page').each(function(){
                                    $(this).html(data.notices.current_page);
                                })

                                $('.page_container').show();

                                $('.show_data').append(data.view)
                                $('.show_data').show();
                                $('.download_div').show();
                                $('.show_animation').hide();
                                $('.c_table').trigger('update')

                            }
                        });
            }
        }


        function getData(myurl) {
            console.log("test",myurl);
            $('.show_animation').show();
=======
            let getAppReportData = () => {
                $('.show_animation').show();
                $('.show_data').empty();
                $('.show_data').hide();
                page = 1;
                currentscrollHeight = 0;
>>>>>>> origin/jahangir
                report = $('.reportFilter').val();
                date_type = $('.filter-date').val();
                console.log(report);
                finalResult = false;
                single_date = $('.single_date').val();
                daterange = $('.reportrange').val();
<<<<<<< HEAD
            $.ajax({
                url: myurl,
                type: "POST",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'report': report,
                    'single_date': single_date,
                    'daterange': daterange,
                },
                datatype: "html"
            }).done(function(data) {
                console.log(data);
                $('.current_page').each(function(){
                    $(this).html(data.notices.current_page);
                })
                $('.show_animation').hide();
                $('.show_data').append(data.view)
                // $(".c_table").tablesorter();
                $('.c_table').trigger('update')
                $('.show_animation').hide();
=======

                if (report == 0) {
                    toastr["error"]("Please select report.", 'ALERT!');
                } else {
                    if (date_type == 0) {
                        toastr["error"]("Please select date type.", 'ALERT!');
                    } else {
                        if (date_type == 1) {
                            if (single_date == '') {
                                toastr["error"]("Please select specific date.", 'ALERT!');
                            } else {
                                finalResult = true;
                            }
                        } else if (date_type == 2) {
                            if (daterange == '') {
                                toastr["error"]("Please select date range.", 'ALERT!');
                            } else {
                                finalResult = true;
                            }
                        }
                    }

                }
                if (finalResult == true) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.report.show') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'report': report,
                            'single_date': single_date,
                            'daterange': daterange,

                        },
                        success: function(data) {
                            console.log(data);
                            $('.show_data').append(data.view)
                            $('.show_data').show();
                            $('.download_div').show();
                            $('.show_animation').hide();
                            $('.c_table').trigger('update')

                        }
                    });
                }
            }
>>>>>>> origin/jahangir


            function getData(myurl) {
                console.log("test", myurl);
                $('.show_animation').show();
                report = $('.reportFilter').val();
                date_type = $('.filter-date').val();
                console.log(report);
                finalResult = false;
                single_date = $('.single_date').val();
                daterange = $('.reportrange').val();
                $.ajax({
                    url: myurl,
                    type: "POST",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'report': report,
                        'single_date': single_date,
                        'daterange': daterange,
                    },
                    datatype: "html"
                }).done(function(data) {
                    console.log(data)
                    $('.show_animation').hide();
                    $('.show_data').append(data.view)
                    // $(".c_table").tablesorter();
                    $('.c_table').trigger('update')
                    $('.show_animation').hide();


                }).fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('No response from server');
                    $('.loading2').hide();
                });
            }
        });
    </script>


    <script>
        var timeStamp = moment().format('MMDYYYYhmmss');
        $('#download_csv').click(function() {
            $('#export_table').tableExport({
                type: 'csv',
                fileName: 'ManageSession_' + timeStamp
            });
        });

        $('#download_pdf').click(function() {
            $('#export_table').tableExport({
                type: 'pdf',
                fileName: 'ManageSession_' + timeStamp,
                jspdf: {
                    orientation: "L",
                    autotable: {
                        styles: {
                            overflow: 'linebreak'
                        },
                        headerStyles: {
                            fillColor: [32, 122, 199],
                            textColor: 255,
                            fontStyle: 'bold',
                            halign: 'inherit',
                            valign: 'middle',
                        }
                    }

                }
            });
        });
    </script>
@endsection
