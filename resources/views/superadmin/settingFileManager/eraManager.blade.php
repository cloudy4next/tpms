@extends('layouts.superadmin')
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-lg-flex">
                <!-- menu -->
                <div class="setting_menu">
                    @include('superadmin.include.settingMenu')
                </div>
                <!-- content -->
                <div class="all_content flex-fill">
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $('#pass , #c_pass').hide();
            $('.check_all').click(function(){
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
                    $('#pass , #c_pass').show();
                }
                else{
                    $('#pass , #c_pass').hide();
                }
            })

            $(document).on('click','#continue',function(e){
                e.preventDefault();
                file_id=$(this).attr('file-id');
                if($('#exportWithPassword').prop("checked")==true){
                    if($('#pass').val()==$('#c_pass').val()){
                        $('#enc_form'+file_id).submit();
                    }
                    else{
                        toastr["error"]("Passwords not matched.");
                    }
                }
                else{
                    $('#enc_form'+file_id).submit();
                }
            });


        })
    </script>

@endsection