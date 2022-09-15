@section('js')
    <script>
        $(document).ready(function () {
            let getAllRegon = () => {
                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.vendor.get.region.center')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                    },
                    success: function (data) {
                        console.log(data);
                        $('.region_id').empty();
                        $('.region_id').append(
                            `<option value="">select regional center</option>`
                        );
                        $.each(data, function (index, value) {
                            $('.region_id').append(
                                `<option value="${value.payor_id}">${value.payor_name}</option>`
                            );
                        });

                        $('.loading2').hide();
                    }
                });
            };

            let getAllTx = () => {
                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.vendor.get.tx')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                    },
                    success: function (data) {
                        console.log(data);
                        $('.tx_id').empty();
                        $('.tx_id').append(
                            `<option value="">select tx type</option>`
                        );
                        $.each(data, function (index, value) {
                            $('.tx_id').append(
                                `<option value="${value.id}">${value.treatment_name}</option>`
                            );
                        });

                        $('.loading2').hide();
                    }
                });
            };

            getAllTx();
            getAllRegon();
        })
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


            $('.tx_id').change(function () {
                $('.loading2').show();
                let tx_id = $('.tx_id').val();
                let region_id = $('.region_id').val();

                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.vendor.number.filter')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'tx_id': tx_id,
                        'region_id': region_id,
                    },
                    success: function (data) {
                        console.log(data);
                        $('.vendor_table').empty();
                        $('.vendor_table').html(data.view);

                        $('.loading2').hide();
                    }
                });
            });


            $('.region_id').change(function () {
                $('.loading2').show();
                let tx_id = $('.tx_id').val();
                let region_id = $('.region_id').val();

                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.vendor.number.filter')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'tx_id': tx_id,
                        'region_id': region_id,
                    },
                    success: function (data) {
                        console.log(data);
                        $('.vendor_table').empty();
                        $('.vendor_table').html(data.view);

                        $('.loading2').hide();
                    }
                });
            })

        });


        function getData(myurl) {
            $('.loading2').show();
            let tx_id = $('.tx_id').val();
            let region_id = $('.region_id').val();
            $.ajax(
                {
                    url: myurl,
                    type: "get",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'tx_id': tx_id,
                        'region_id': region_id,
                    },
                    datatype: "html"
                }).done(function (data) {
                // console.log(data)
                $('.vendor_table').empty();
                $('.vendor_table').html(data.view);
                $('.loading2').hide();
                // location.hash = myurl;

            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
                $('.loading2').hide();
            });
        }

    </script>
@endsection
