@extends('layouts.superadmin')
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <h5 class="common-title">Recurring Session</h5>
            <div class="d-flex">
                <div class="mb-2 mr-2">
                    <label for="">Select Any</label>
                    <select class="form-control form-control-sm sortby">
                        <option value="1">All</option>
                        <option value="2">Patient</option>
                        <option value="3">Provider</option>
                    </select>
                </div>
                <div class="mb-2 mr-2 pt">
                    <label for="">Patient</label>
                    <select class="form-control form-control-sm all_patient multiselect" name="all_patient"
                            id="all_patient"
                            multiple required>
                    </select>
                </div>
                <div class="mb-2 mr-2 pv">
                    <label for="">Provider</label>
                    <select
                        class="form-control form-control-sm all_provider multiselect" name="all_provider"
                        id="all_provider"
                        multiple required>
                    </select>
                </div>
                <div class="mb-2 mr-2 align-self-end">
                    <button type="button" class="btn btn-sm btn-primary go-btn" id="go_btn">Go</button>
                </div>
            </div>
            <div class="table-responsive rectbl">

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.pt').hide();
        $('.pv').hide();
        $('.sortby').change(function (e) {
            let v = $(this).val();
            if (v == 2) {
                $('.pt').show();
                $('.pv').hide();
            } else if (v == 3) {
                $('.pt').hide();
                $('.pv').show();
            } else {
                $('.pt').hide();
                $('.pv').hide();
            }
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

            $('#all_patient').multiselect();
            $('#all_provider').multiselect();
            $('.sortby').change(function () {
                $('.loading2').show();
                let sort_by = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.recurring.session.get.patpro')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'sort_by': sort_by
                    },
                    success: function (data) {
                        console.log(data)
                        if (sort_by == 2) {
                            $('.all_patient').empty();
                            $.each(data, function (index, value) {
                                $('.all_patient').append(
                                    `<option value="${value.id}">${value.client_full_name}</option>`
                                );
                            })

                            $('#all_patient').multiselect({includeSelectAllOption: true});
                            $("#all_patient").multiselect('rebuild');
                        } else if (sort_by == 3) {
                            $('.all_provider').empty();
                            $.each(data, function (index, value) {
                                $('.all_provider').append(
                                    `<option value="${value.id}">${value.full_name}</option>`
                                );
                            });

                            $('#all_provider').multiselect({includeSelectAllOption: true});
                            $("#all_provider").multiselect('rebuild');
                        }


                        $('.loading2').hide();
                    }
                });
            })

            $('#go_btn').click(function () {
                let sort_by = $('.sortby').val();
                let all_patient = $('.all_patient').val();
                let all_provider = $('.all_provider').val();
                $('.loading2').show();

                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.recurring.list')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'sort_by': sort_by,
                        'all_patient': all_patient,
                        'all_provider': all_provider
                    },
                    success: function (data) {
                        console.log(data)
                        $('.rectbl').empty();
                        $('.rectbl').html(data.view);
                        $(".c_table").tablesorter();

                        $('.loading2').hide();
                    }
                });

            })


        });


        function getData(myurl) {
            $('.loading2').show();
            let sort_by = $('.sortby').val();
            let all_patient = $('.all_patient').val();
            let all_provider = $('.all_provider').val();
            $.ajax(
                {
                    url: myurl,
                    type: "get",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'sort_by': sort_by,
                        'all_patient': all_patient,
                        'all_provider': all_provider
                    },
                    datatype: "html"
                }).done(function (data) {
                $('.rectbl').empty();
                $('.rectbl').html(data.view);
                $(".c_table").tablesorter();

                $('.loading2').hide();

            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }

    </script>

@endsection
