@extends('layouts.provider')
@section('provider')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <h2 class="common-title">All Patients</h2>
            <div class="table-responsive client_lists">

            </div>
        </div>
    </div>


@endsection
@section('js')
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


            // $('.active-switch input').change(function (e) {
            //     if ($(this).prop("checked") == true) {
            //         $('.active-switch label').text('Active')
            //     } else if ($(this).prop("checked") == false) {
            //         $('.active-switch label').text('In-active')
            //     }
            // });


            $(document).on('change', '.clientactswt', function () {

                $('.loading2').show();

                if ($(this).is(":checked")) {
                    $(this).parent().find('label').text('Active');
                    var is_active = 1;
                } else {
                    $(this).parent().find('label').text('In-active');
                    var is_active = 2;
                }
                let client_id = $(this).val();
                console.log(client_id)
                $.ajax({
                    type: "POST",
                    url: "{{route('provider.clients.list.update.active')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'client_id': client_id,
                        'is_active': is_active
                    },
                    success: function (data) {
                        $('.loading2').hide();
                    }
                });


            })


            $('.loading2').show();
            $.ajax({
                type: "POST",
                url: "{{route('provider.clients.list.get')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                },
                success: function (data) {
                    console.log(data);
                    $('.client_lists').empty();
                    $('.client_lists').html(data.view);
                    $(".c_table").tablesorter();
                    $('.loading2').hide();
                }
            });

            $(document).on('keyup', '.search_name', function () {
                var name = $(this).val();

            });


            $(document).on('keyup', '.common_selector', function () {
                setTimeout(() => {
                    filter_data();
                }, 1000)

            });
            $(document).on('change', '.common_selector2', function () {
                setTimeout(() => {
                    filter_data();
                }, 1000)
            });


            function get_filter(class_name) {
                var name = $('.' + class_name).val();
                return name;
            }


            function filter_data() {
                $('.loading2').show();
                var name = get_filter('search_name');
                var contact = get_filter('search_contact');
                var dob = get_filter('search_dob');
                var gender = get_filter('search_gender');
                $.ajax({
                    type: "POST",
                    url: "{{route('provider.clients.list.get')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'name': name,
                        'contact': contact,
                        'dob': dob,
                        'gender': gender,
                    },
                    success: function (data) {
                        console.log(data);
                        $('.client_lists').empty();
                        $('.client_lists').html(data.view);
                        $('.search_name').val(name);
                        $('.search_contact').val(contact);
                        $('.search_dob').val(dob);
                        $('.search_gender').val(gender);
                        $(".c_table").tablesorter();
                        $('.loading2').hide();
                    }
                });
            }


        });

        function getData(myurl) {
            console.log('url is ' + myurl);
            if (myurl !== "deposit_details") {
                $('.loading2').show();

                function get_filter(class_name) {
                    var name = $('.' + class_name).val();
                    return name;
                }

                var name = get_filter('search_name');
                var contact = get_filter('search_contact');
                var dob = get_filter('search_dob');
                var gender = get_filter('search_gender');


                $.ajax(
                    {
                        url: myurl,
                        type: "get",
                        data: {
                            '_token': "{{csrf_token()}}",
                            'name': name,
                            'contact': contact,
                            'dob': dob,
                            'gender': gender,
                        },
                        datatype: "html"
                    }).done(function (data) {
                    if (data.data_type == 1) {
                        $('.client_lists').empty();
                        $('.client_lists').html(data.view);
                        $('.search_name').val(name);
                        $('.search_contact').val(contact);
                        $('.search_dob').val(dob);
                        $('.search_gender').val(gender);
                        $(".c_table").tablesorter();
                        $('.loading2').hide();
                    }

                    // location.hash = myurl;

                }).fail(function (jqXHR, ajaxOptions, thrownError) {
                    alert('No response from server');
                });
            }

        }

    </script>
@endsection


