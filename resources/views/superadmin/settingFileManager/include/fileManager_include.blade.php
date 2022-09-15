@section('js')
    <script>

        $(window).on('hashchange', function () {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else {
                    if(type==1){
                        fetch_edi(page);
                    }
                    else{
                        fetch_era(page);
                    }
                }
            }
        });


        $(document).ready(function(){

            function fetch_era(address){
                $.ajax({
                    url:address,
                    method:"POST",
                    data:{"_token":"{{csrf_token()}}"},
                    success:function(data){
                        $('.html_data').empty();
                        $('.html_data').html(data.view);
                        $('.pass , .c_pass').hide();
                    }
                });
            }

            function fetch_edi(address){
                $.ajax({
                    url:address,
                    method:"POST",
                    data:{"_token":"{{csrf_token()}}"},
                    success:function(data){
                        $('.html_data').empty();
                        $('.html_data').html(data.view);
                        $('.pass , .c_pass').hide();
                    }
                });
            }

            $(document).on('click','.go_btn',function(){
                type=$('.report_type option:selected').val();
                if(type==0){
                    toastr["error"]("Please select file type.");
                }
                else{
                    if(type==1){
                        fetch_edi("{{route('superadmin.setting.edi.list')}}");
                    }
                    else if(type==2){
                        fetch_era("{{route('superadmin.setting.era.list')}}");
                    }
                }
            })

            $(document).on('click','.check_all',function(){
                $('.in_check').each(function(){
                    if($(this).prop("checked")==true){
                        $(this).prop("checked",false);
                    }
                    else{
                        $(this).prop("checked",true);
                    }
                })
            });

            $(document).on('click','#exportWithPassword',function(){
                if($(this).prop("checked")==true){
                    $('.pass , .c_pass').show();
                }
                else{
                    $('.pass , .c_pass').hide();
                }
            })

            $(document).on('click','#continue',function(e){
                e.preventDefault();
                file_id=$(this).attr('file-id');
                if($('.exportWithPassword'+file_id).prop("checked")==true){
                    pass=$('.pass'+file_id).val();
                    c_pass=$('.c_pass'+file_id).val();
                    if(pass!=''){
                        if(pass==c_pass){
                            $('#enc_form'+file_id).submit();
                            $('.password_modal').modal("hide");
                        }
                        else{
                            toastr["error"]("Passwords not matched.");
                        }
                    }
                    else{
                        toastr["error"]("Please enter password.");
                    }
                }
                else{
                    $('#enc_form'+file_id).submit();
                    $('.password_modal').modal("hide");
                }
            });

            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();
                $('li').removeClass('active');
                $(this).parent('li').addClass('active');
                var myurl = $(this).attr('href');
                if(type==1){
                    fetch_edi(myurl);
                }
                else if(type==2){
                    fetch_era(myurl);
                }
            });

        })
    </script>

@endsection