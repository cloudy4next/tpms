@section('js')
    <script>
        $('.editusr').hide();
        $('.editusr_btn').click(function (e) {
            $('.editusr').show();

        });
        $('#add_user').click(function (e) {
            $('.editusr').show();

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


            $('.action_type').hide();
            $('.action_typebtn').hide();
            
            let getUserByUserType = () => {
                $('.loading2').show();
                let user_type = $('.user_type').val();
                let user_name = $('.user_name').val();
                let user_email = $('.user_email').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.user.setup.getuser')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'user_type': user_type,
                        'user_name': user_name,
                        'user_email': user_email,
                    },
                    success: function (data) {
                        console.log(data);
                        $('.usertable').empty();
                        $('.usertable').html(data.view);
                        $('.action_type').show();
                        $('.action_typebtn').show();
                        $('.loading2').hide();

                    }
                });
            };


            $('#search').click(function () {
                getUserByUserType();
            })


        });


        function getData(myurl) {
            console.log(myurl);
            $('.loading2').show();
            $('.action_type').hide();
            $('.action_typebtn').hide();
            let user_type = $('.user_type').val();
            let user_name = $('.user_name').val();
            let user_email = $('.user_email').val();
            $.ajax(
                {
                    url: myurl,
                    type: "get",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'user_type': user_type,
                        'user_name': user_name,
                        'user_email': user_email,
                    },
                    datatype: "html"
                }).done(function (data) {
                // console.log(data)
                $('.usertable').empty();
                $('.usertable').html(data.view);
                $('.action_type').show();
                $('.action_typebtn').show();
                $('.loading2').hide();
                // location.hash = myurl;

            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }

    </script>
@endsection
