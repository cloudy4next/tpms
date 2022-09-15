@section('js')
    <script>
        jQuery(document).ready(function ($) {
            // $('.attachment').hide();
            // $('.addrate_btn').hide();
            // $('.rate_table').hide();
            // $('.payor_filter select').change(function(event) {
            //     $('.attachment').show();
            //     $('.addrate_btn').show();
            //     $('.rate_table').show();
            // });
        });
    </script>

    <script>

        $(window).on('hashchange', function () {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else {
                    getData(page);
                }
            }
        });

        $(document).ready(function () {


            $('.attachment').hide();
            $('.addrate_btn').hide();
            $('.rate_table').hide();

            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();


                $('li').removeClass('active');
                $(this).parent('li').addClass('active');

                var myurl = $(this).attr('href');
                // console.log(myurl);
                var newurl = myurl.substr(0, myurl.length - 1);

                var page = $(this).attr('href').split('page=')[1];
                var newurldata = (newurl + page);
                // console.log(newurldata);
                getData(myurl);
            });


            $('.addRateList').click(function () {
                let payor_id = $('.payor_id').val();
                if (payor_id == 0) {

                } else {
                    let route = "{{url('/admin/billing/rate-list-add')}}" + '/' + payor_id;
                    window.location.href = route;
                }

            })


            $('.payor_id').change(function () {
                var p_id = $(this).val();

                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.ratelist.data')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'p_id': p_id,
                    },
                    success: function (data) {
                        console.log(data);
                        $('.ratelist_tbl').empty();
                        $('.ratelist_tbl').html(data.view);
                        $('.attachment').show();
                        $('.addrate_btn').show();
                        $('.rate_table').show();
                        $('.loading2').hide();
                        $(".c_table").tablesorter();
                        getFileName(p_id);
                    }
                });

            })
        });

        function getFileName(payorid) {
            $('.loading2').show();
            $.ajax({
                type: "POST",
                url: "{{route('superadmin.ratelist.get.payor.filename')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'payorid': payorid,
                },
                success: function (data) {
                    console.log(data);
                    if (data.have_file == 1) {
                        var url = "{{url('admin/billing/rate-list-file-download')}}" + '/' + data.data;
                        var file = url + '/' + data.download_path;
                        var downLink = `<a href="${url}" target="_blank" class="have_file">${data.filename}</a>`;
                        $('.have_file').replaceWith(downLink);
                        $('.show_file_div').show();
                    } else {
                        $('.show_file_div').hide();
                    }
                    $('.loading2').hide();
                }
            });
        }


        function getData(myurl) {
            $('.loading2').show();
            var p_id = $('.payor_id').val();
            if (myurl !== "deposit_details") {
                $('.loading2').show();
                $.ajax(
                    {
                        url: myurl,
                        type: "get",
                        data: {
                            '_token': "{{csrf_token()}}",
                            'p_id': p_id,
                        },
                        datatype: "html"
                    }).done(function (data) {
                    $('.ratelist_tbl').empty();
                    $('.ratelist_tbl').html(data.view);
                    $('.attachment').show();
                    $('.addrate_btn').show();
                    $('.rate_table').show();
                    $(".c_table").tablesorter();
                    $('.loading2').hide();

                    // location.hash = myurl;

                }).fail(function (jqXHR, ajaxOptions, thrownError) {
                    alert('No response from server');
                });
            }

        }

    </script>

@endsection
