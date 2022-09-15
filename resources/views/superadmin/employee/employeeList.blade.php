@extends('layouts.superadmin')
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
@endsection
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="overflow-hidden mb-2">
                <div class="float-left">
                    <h5 class="common-title">All Staffs</h5>
                </div>
                <div class="float-right">
                    <a class="btn btn-sm text-white btn-primary dropdown-toggle" href="#" data-toggle="dropdown"><i
                            class="las la-plus"></i>
                        Add Staff
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                        <a class="dropdown-item"
                           href="{{ route('superadmin.create.employee', ['em_type' => 'provider']) }}">Provider
                            (Therapist)</a>
                        <a class="dropdown-item"
                           href="{{ route('superadmin.create.employee', ['em_type' => 'staff']) }}">Office Staff</a>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <div class="table-responsive em_list">

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
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


            $('.loading2').show();
            $.ajax({
                type: "POST",
                url: "{{route('superadmin.employee.list.get')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                },
                success: function (data) {
                    console.log(data);
                    $('.em_list').empty();
                    $('.em_list').html(data.view);
                    $(".c_table").tablesorter();
                    $('.loading2').hide();
                }
            });


            $(document).on('keyup', '.search_name', function () {
                var name = $(this).val();

            });

            $(document).on('change', '.active_status', function () {
                filter_data();

            });

            $(document).on('keyup', '.common_selector', function () {
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
                var search_phone = get_filter('search_phone');
                var search_email = get_filter('search_email');
                var search_language = get_filter('search_language');
                var search_status = $('.active_status').val();

                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.employee.list.get')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'name': name,
                        'search_phone': search_phone,
                        'search_email': search_email,
                        'search_language': search_language,
                        'search_status' : search_status,
                    },
                    success: function (data) {
                        console.log(data);
                        $('.em_list').empty();
                        $('.em_list').html(data.view);
                        $(".c_table").tablesorter();
                        $('.search_name').val(name);
                        $('.search_phone').val(search_phone);
                        $('.search_email').val(search_email);
                        $('.search_language').val(search_language);
                        $('.active_status').val(search_status);
                        $('.loading2').hide();
                    }
                });
            };


            $(document).on('change', '.employeeswt', function () {
                $('.loading2').show();

                if ($(this).is(":checked")) {
                    $(this).parent().find('label').text('Active');
                    var is_active = 1;
                } else {
                    $(this).parent().find('label').text('In-active');
                    var is_active = 2;
                }

                let employee_id = $(this).val();

                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.employee.list.update.active')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'employee_id': employee_id,
                        'is_active': is_active
                    },
                    success: function (data) {
                        $('.loading2').hide();
                    }
                });


            })


        });


        function getData(myurl) {
            console.log('url is ' + myurl);
            $('.loading2').show();

            function get_filter(class_name) {
                var name = $('.' + class_name).val();
                return name;
            }

            var name = get_filter('search_name');
            var search_phone = get_filter('search_phone');
            var search_email = get_filter('search_email');
            var search_language = get_filter('search_language');


            $.ajax(
                {
                    url: myurl,
                    type: "get",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'name': name,
                        'search_phone': search_phone,
                        'search_email': search_email,
                        'search_language': search_language,
                    },
                    datatype: "html"
                }).done(function (data) {
                $('.em_list').empty();
                $('.em_list').html(data.view);
                $(".c_table").tablesorter();
                $('.search_name').val(name);
                $('.search_phone').val(search_phone);
                $('.search_email').val(search_email);
                $('.search_language').val(search_language);
                $('.loading2').hide();
            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });

        }

    </script>

@endsection
