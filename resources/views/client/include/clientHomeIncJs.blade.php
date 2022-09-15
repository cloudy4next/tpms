@section('js')

    <script>

        $('.loading2').hide();
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


            $('#goBtn').click(function () {
                $('.loading2').show();
                var search_by = $('.search_by').val();
                var reportrange = $('.reportrange').val();

                $.ajax({
                    type: "POST",
                    url: "{{route('client.mysession.get')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'search_by': search_by,
                        'reportrange': reportrange,
                    },
                    success: function (data) {
                        console.log(data);
                        $('.all_secction').empty().html(data.view);
                        $('.loading2').hide();

                    }
                });


            })

        });


        function getData(myurl) {
            $('.loading2').show();
            var search_by = $('.search_by').val();
            var reportrange = $('.reportrange').val();
            $.ajax({
                url: myurl,
                type: "get",
                data: {
                    '_token': "{{csrf_token()}}",
                    'search_by': search_by,
                    'reportrange': reportrange,
                },
                datatype: "html"
            }).done(function (data) {
                console.log(data);
                $('.all_secction').empty().html(data.view);
                $('.loading2').hide();

            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
                $('.loading2').hide();
            });
        }


    </script>


    <script>
        $('.daterange-filter').hide();
        $('.client-filter').hide();
        $('.payperiod-filter').hide();
        $('.providerScheduler-table').hide();
        $('.activity-table').hide();
        $('.goBtn').click(function (event) {
            $('.providerScheduler-table').show();
        });
        $('.schedule-filter select').change(function (event) {
            let v = $(this).val();
            if (v == 5) {
                $('.daterange-filter').show();
                $('.client-filter').hide();
                $('.payperiod-filter').hide();
            } else if (v == 6) {
                $('.daterange-filter').show();
                $('.client-filter').show();
                $('.payperiod-filter').hide();
            } else if (v == 11) {
                $('.daterange-filter').hide();
                $('.client-filter').hide();
                $('.payperiod-filter').show();
            } else {
                $('.daterange-filter').hide();
                $('.client-filter').hide();
                $('.payperiod-filter').hide();
            }
        });
        $('#okBtn').click(function (e) {
            let v = $('.select-box select').val();
            if (v == 2) {
                $('.activity-table').show();
            } else {
                $('.activity-table').hide();
            }
        });
    </script>
@endsection
