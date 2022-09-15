@extends('layouts.MainAdmin')
@section('mainadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="overflow-hidden mb-3">
                <div class="float-left">
                    <h5>Remove Provider</h5>
                </div>
            </div>
            <!-- Form -->

            <!-- Existing Payor -->
            <hr>
            <div class="form-inline">
                <label>Admin</label>
                <select class="form-control mx-2 all_admin">
                    <option>Lorem, ipsum, dolor.</option>
                </select>
                <button type="button" class="btn btn-primary" id="show_provider">
                    Show/Hide Provider
                </button>
            </div>
            <!-- Payor Table -->
            <div class="table-responsive mt-2 all_prov_table" id="payor_table">

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


            $.ajax({
                type: "POST",
                url: "{{route('mainadmin.provider.remove.get.all.admin')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                },
                success: function (data) {
                    console.log(data);
                    $('.all_admin').empty();
                    $('.all_admin').append(
                        `<option value="0">select admin</option>`
                    );
                    $.each(data, function (index, value) {
                        $('.all_admin').append(
                            `<option value="${value.id}">${value.name}</option>`
                        );
                    });
                }
            });


            $('.all_admin').change(function () {
                $('.all_prov_table').hide();
            })


            $('#show_provider').click(function () {
                let admin_id = $('.all_admin').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('mainadmin.provider.by.admin')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'admin_id': admin_id
                    },
                    success: function (data) {
                        $('.all_prov_table').empty().html(data.view);
                        $('.all_prov_table').show();
                    }
                });
            });


            $(document).on('click', '.delprov', function () {
                let provid = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "{{route('mainadmin.provider.delete.by.admin')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'provid': provid
                    },
                    success: function (data) {
                        $('#show_provider').click();
                    }
                });
            });


        });


        function getData(myurl) {

            let admin_id = $('.all_admin').val();
            $.ajax(
                {
                    url: myurl,
                    type: "get",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'admin_id': admin_id
                    },
                    datatype: "html"
                }).done(function (data) {
                // console.log(data)
                $('.all_prov_table').empty().html(data.view);
                // location.hash = myurl;

            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }

    </script>
@endsection
