@section('js')
    <script>

        var client_arr=[];
        var payor_arr=[];
        $(document).ready(function () {
            $('.loading2').hide();
            $('.view_btn').hide();
            $('#select_all_btn').hide();
            $('.select_client select').change(function (event) {
                client_arr=[];
                payor_arr=[];
                var v = $(this).val();
                if (v == 2) {
                    $('#selectClient').modal("show");

                } else if (v == 3) {
                    $('#selectPayor').modal("show");
                }
            });

            $(document).on('click','.select_all_client',function(){
                if($(this).prop("checked")==true){
                    $('.select_in_client').each(function(){
                        $(this).prop("checked",true);
                    })
                }
                else{
                    $('.select_in_client').each(function(){
                        $(this).prop("checked",false);
                    })
                }
            })

            $(document).on('click','.select_all_payor',function(){
                if($(this).prop("checked")==true){
                    $('.select_in_payor').each(function(){
                        $(this).prop("checked",true);
                    })
                }
                else{
                    $('.select_in_payor').each(function(){
                        $(this).prop("checked",false);
                    })
                }
            })

            $(document).on('click','.select_client_btn',function(){
                client_arr=[];
                $('.select_in_client').each(function(){
                    if($(this).prop("checked")==true){
                        client_arr.push($(this).val());
                    }
                })

                if(client_arr.length>0){
                   $('#selectClient').modal('hide');
                }
                else{
                    toastr['error']('Select Clients.');
                }
            })

            $(document).on('click','.select_payor_btn',function(){
                payor_arr=[];
                $('.select_in_payor').each(function(){
                    if($(this).prop("checked")==true){
                        payor_arr.push($(this).val());
                    }
                })

                if(payor_arr.length>0){
                   $('#selectPayor').modal('hide');
                }
                else{
                    toastr['error']('Select Payor.');
                }
            })

            $(document).on('click','.close_modal_btn , .close',function(){
                $('.related_to option[value=0]').prop("selected",true);
            })

            function fetchData(check,date,client_arr,payor_arr){
                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.statement.data')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'check':check,
                        'date':date,
                        'client_arr':client_arr,
                        'payor_arr':payor_arr,
                    },
                    success: function (data) {
                        console.log(data);
                        $('.view_btn').show();
                        $('.stmt_table').show();
                        $('.stmt_table').empty().append(data.view);
                        $('#select_all_btn').show();
                        $('.loading2').hide();
                    }
                });
            }


            $('#run').click(function () {

                related_to = $('.related_to').val();
                date_range = $('.data_range').val();

                if(related_to==0){
                    toastr['error']('Select Related to.');
                }
                else if(date_range.length==0){
                    toastr['error']('Select date range.');
                }
                else{
                    fetchData(related_to,date_range,client_arr,payor_arr);
                }

            })

            $('#select_all_btn').click(function(){
                if($(this).val() == 1){
                    $(this).val(2);
                    $(this).text("Unselect All");
                    $('.client_check').each(function(){
                        $(this).not(':disabled').prop("checked",true);
                    })
                    $('.select_all_record').each(function(){
                        $(this).not(':disabled').prop("checked",true);
                    })
                    $('.select_in_record').each(function(){
                        $(this).not(':disabled').prop("checked",true);
                    })
                }
                else{
                    $(this).val(1);
                    $(this).text("Select All");
                    $('.client_check').each(function(){
                        $(this).prop("checked",false);
                    })
                    $('.select_all_record').each(function(){
                        $(this).prop("checked",false);
                    })
                    $('.select_in_record').each(function(){
                        $(this).prop("checked",false);
                    })
                }
            })

            $(document).on('click','.client_check',function(){
                c_id = $(this).data("id");
                sel=$('.select_all_record'+c_id);
                if($(this).prop("checked") == true){
                    sel.prop("checked",true);
                }
                else{
                    sel.prop("checked",false);
                }


                if(sel.prop("checked")==true){
                    sel.parents('table').find('.select_in_record').each(function(){
                        $(this).not(':disabled').prop("checked",true);
                    })
                }
                else{
                    sel.parents('table').find('.select_in_record').each(function(){
                        $(this).not(':disabled').prop("checked",false);
                    }) 
                }
            });

            $(document).on('click','.select_all_record',function(){
                val = $(this).data("id");
                if($(this).prop("checked")==true){
                    $('.client_check'+val).prop("checked",true);
                    $(this).parents('table').find('.select_in_record').each(function(){
                        $(this).not(':disabled').prop("checked",true);
                    })
                }
                else{
                    $('.client_check'+val).prop("checked",false);
                    $(this).parents('table').find('.select_in_record').each(function(){
                        $(this).not(':disabled').prop("checked",false);
                    }) 
                }
            })

            $(document).on('click','.select_in_record',function(){
                val = $(this).parents('table').find('.select_all_record').data("id");
                if($(this).prop("checked")==true){
                    $('.client_check'+val).prop("checked",true);
                }
                else{
                    check = false;
                    $(this).parents('table').find('.select_in_record').each(function(){
                        if($(this).prop("checked") == true){
                            check = true;
                        }
                    }) 
                    if(check == false){
                        $('.client_check'+val).prop("checked",false);
                    }
                }
            })


            $(document).on('change','.submit_switch',function(){
                c_id = $(this).data("id");
                sel=$('.select_all_record'+c_id);
                submit_ids=[];
                if($(this).prop("checked") == true){
                    $(this).siblings("label").text("Submitted");
                    sel.parents('table').find('.submit_in_switch').each(function(){
                        $(this).parent('.custom-switch').find('label').text('Yes');
                        $(this).prop("checked",true);
                        // $(this).closest('tr').find('.select_in_record').prop("disabled",true);
                        submit_ids.push($(this).data('id'));
                    })
                    submit_all_status(submit_ids,1);
                }
                else{
                    $(this).siblings("label").text("Not Submitted");
                    sel.parents('table').find('.submit_in_switch').each(function(){
                        $(this).prop("checked",false);
                        $(this).parent('.custom-switch').find('label').text('No');
                        submit_ids.push($(this).data('id'));
                        // $(this).closest('tr').find('.select_in_record').prop("disabled",false);
                    }) 
                    submit_all_status(submit_ids,2);
                }
            });

            $(document).on('change','.submit_in_switch',function(){
                if($(this).prop("checked") == true){
                    $(this).siblings('label').text("Yes");
                    // $(this).closest('tr').find('.select_in_record').prop("disabled",true);
                    submit_single_status($(this).data("id"),1);
                }
                else{
                    $(this).siblings('label').text("No");
                    // $(this).closest('tr').find('.select_in_record').prop("disabled",false);
                    submit_single_status($(this).data("id"),2);
                }
            })


            $('.view_btn').click(function () {
                var client_ids = [];
                var client_rec={};

                rec_check=true;

                $('.client_check').each(function(){
                    if($(this).prop("checked")==true){
                        rec_check=true;
                        val=0;
                        arr=[];
                        val=$(this).val();
                        client_ids.push(val);
                        $('#ai1'+val).find('.select_in_record').each(function(){
                            if($(this).prop("checked")==true){
                                arr.push($(this).attr("pdf-id"));
                            }
                        })

                        if(arr.length==0){
                            toastr["error"]("Please select records.");
                            rec_check=false;
                            return false;
                        }

                        kin="client"+val;
                        client_rec[kin]=arr;
                    }
                })
        
                if(rec_check==true){
                    if(client_ids.length>0){
                        $('.client_ids').val(JSON.stringify(client_ids));
                        $('.client_rec').val(JSON.stringify(client_rec));
                        $('#pdf_form').submit();
                    }
                    else{
                        toastr["error"]("Please check patient.");
                    }
                }
            });

            function submit_single_status(id,check){
                $('.loading2').show();
                $.ajax({
                    type:"POST",
                    url:"{{route('superadmin.submit.single.status')}}",
                    data:{
                        "_token": "{{csrf_token()}}",
                        id:id,
                        check:check,
                    },
                    success:function(data){
                        if(data=='success'){
                            $('.loading2').hide();
                        }
                    }
                });
            }

            function submit_all_status(ids,check){
                $('.loading2').show();
                $.ajax({
                    type:"POST",
                    url:"{{route('superadmin.submit.all.status')}}",
                    data:{
                        "_token": "{{csrf_token()}}",
                        ids:ids,
                        check:check,
                    },
                    success:function(data){
                        if(data=='success'){
                            $('.loading2').hide();
                        }
                    }
                });
            }


            $(document).on('click','.email_btn',function(){
                var arr=[];
                var client_ids = [];
                var client_rec={};
                c_id = $(this).data("id");
                client_ids.push(c_id);
                $('#ai1'+c_id).find('.select_in_record').each(function(){
                    if($(this).prop("checked")==true){
                        arr.push($(this).attr("pdf-id"));
                    }
                })

                if(arr.length==0){
                    toastr["error"]("Please select records.");
                    return false;
                }

                kin="client"+c_id;
                client_rec[kin]=arr;

                save_statement_pdf(client_ids,client_rec,c_id);



                // url = "{{route('superadmin.billing.statement.email.editor')}}";
                // window.open(url, "MsgWindow", "width=700,height=900");
                // window.open(url, "MsgWindow");
            })


            function save_statement_pdf(client_ids,client_rec,c_id){
                $.ajax({
                    url:"{{route('superadmin.statement.save.pdf')}}",
                    type:"POST",
                    data:{
                        "_token": "{{csrf_token()}}",
                        "client_ids" : client_ids,
                        "client_rec" : client_rec,
                    },
                    success:function(data){
                        console.log(data);
                        status = data.status;

                        if(status == "client_error"){
                            toastr["error"]('Client Not Selected','ALERT!');
                        }
                        else if(status == "logo_error"){
                            toastr["error"]('Please Upload Logo in Settings','ALERT!');
                        }
                        else if(status == "success"){
                            fileName = data.file_name;
                            url = "{{route('superadmin.billing.statement.email.editor')}}";
                            url = url+'/'+c_id+'/'+fileName;
                            console.log(url);
                            window.open(url, "MsgWindow", "width=700,height=900");
                            // window.open(url, "MsgWindow");
                        }
                    }
                });
            }



        });

    </script>
@endsection
