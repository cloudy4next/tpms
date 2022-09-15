@section('js')
    <script>
        $(document).ready(function () {

            //get all facility
            $.ajax({
                type: "POST",
                url: "{{route('mainadmin.admin.access.get.faiclity')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                },
                success: function (data) {
                    console.log(data);
                    // location.reload();
                    $('.all_faiclity').empty();
                    $('.all_faiclity').append(
                        `<option value="0">select facility</option>`
                    )
                    $.each(data, function (index, value) {
                        $('.all_faiclity').append(
                            `<option value="${value.facility_name}">${value.facility_name}</option>`
                        )
                    });

                }
            });


            //faiclity by admin

            $('.all_faiclity').change(function () {
                var fac_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{route('mainadmin.admin.access.get.adminbyfac')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'fac_id': fac_id
                    },
                    success: function (data) {
                        console.log(data);
                        // location.reload();
                        $('.all_admin').empty();
                        $('.all_admin').append(
                            `<option value="0">select admin</option>`
                        )
                        $.each(data.admins, function (index, value) {
                            $('.all_admin').append(
                                `<option value="${value.id}">${value.name}</option>`
                            )
                        });
                        $.each(data.subadmins, function (index, value) {
                            $('.all_admin').append(
                                `<option value="${value.id}">${value.name}</option>`
                            )
                        });

                    }
                });
            });


            //short by admin
            $('.sortbyuser').change(function () {
                var sort_user = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{route('mainadmin.admin.access.get.sortbyadmin')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'sort_user': sort_user
                    },
                    success: function (data) {
                        console.log(data);
                        // location.reload();
                        $('.all_admin').empty();
                        $('.all_admin').append(
                            `<option value="0">select admin</option>`
                        )
                        $.each(data, function (index, value) {
                            $('.all_admin').append(
                                `<option value="${value.id}">${value.name}</option>`
                            )
                        });

                    }
                });
            });


            //check page access

            $('#ok_btn').click(function () {
                var admin_id = $('.all_admin').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('mainadmin.admin.page.access.check')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'admin_id': admin_id
                    },
                    success: function (data) {
                        console.log(data);
                        // location.reload();

                        $('.all_page').empty();
                        $.each(data, function (index, value) {
                            $('.all_page').append(
                                `<option value="${value.id}">${value.page_name}</option>`
                            )
                        });


                    }
                });


                $.ajax({
                    type: "POST",
                    url: "{{route('mainadmin.admin.page.access.get')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'admin_id': admin_id
                    },
                    success: function (data) {
                        console.log(data);
                        // location.reload();

                        $('.allocate_page').empty();
                        $.each(data, function (index, value) {
                            $('.allocate_page').append(
                                `<option value="${value.id}">${value.page_name}</option>`
                            )
                        });


                    }
                });


            });

            // add pages
            $('#add_page').click(function () {
                let all_page = $('.all_page').val();
                var admin_id = $('.all_admin').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('mainadmin.admin.page.access.add')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'admin_id': admin_id,
                        'all_page': all_page
                    },
                    success: function (data) {
                        console.log(data);
                        $('#ok_btn').click();


                    }
                });
            });


            //remove page

            $('#remove_page').click(function () {
                let allocate_page = $('.allocate_page').val();
                var admin_id = $('.all_admin').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('mainadmin.admin.page.access.remove')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'admin_id': admin_id,
                        'allocate_page': allocate_page
                    },
                    success: function (data) {
                        console.log(data);
                        $('#ok_btn').click();


                    }
                });
            })


        })
    </script>

@endsection
