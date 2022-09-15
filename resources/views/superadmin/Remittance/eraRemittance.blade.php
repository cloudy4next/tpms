@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <form action="{{route('superadmin.era.remittance.upload')}}" method="post" enctype="multipart/form-data" id="import_form">
                @csrf
                <div class="row">
                    <div class="col-md mb-2">
                        <h2 class="common-title">E-Remittance</h2>
                    </div>

                    <div class="col-md mb-2">
                        <input type="file" name="era_file" class="form-control-file d-none" id="fileup" autocomplete="nope">
                        <label for="fileup">
                            <svg viewBox="0 0 20 17" class="fileupsvg">
                                <path
                                    d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z">
                                </path>
                            </svg>
                            <span>Upload 835</span>
                        </label>
                    </div>
                    <div class="col-md">
                        <button type="submit" class="btn btn-sm btn-primary importera" id="importera">Import ERA</button>
                    </div>

                    <div class="col-md mb-2">
                        <input type="file" class="form-control-file d-none" id="textFile" autocomplete="nope" name="txt_file">
                        <label for="textFile">
                            <svg viewBox="0 0 20 17" class="fileupsvg">
                                <path
                                    d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z">
                                </path>
                            </svg>
                            <span>Upload ERA text</span>
                        </label>
                    </div>
                </div>
            </form>
            <div id="check_info">
                
            </div>
            <div class="process_list">
                <div class="d-flex justify-content-between">
                    <div class="align-self-center">
                        <h2 class="common-title change_title">ERA Review List</h2>
                    </div>
                    <div class="align-self-center mb-2">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <div class="dropdown">
                                    <button class="btn btn-sm p-0 dropdown-toggle" type="button"
                                        data-toggle="dropdown">
                                        <i class="ri-download-2-line"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right download-icon-show">
                                        <a class="dropdown-item" href="#" id="download_pdf">Download PDF</a>
                                        <a class="dropdown-item" href="#" id="download_csv">Download CSV</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-inline-item">
                                <button type="button" class="btn btn-sm btn-primary mr-1" id="processera">Process
                                    ERA
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="table-responsive process_list_table p_table" id="all_list">                 

                </div>
            </div>

            <!-- Unmapped -->
            <div class="unmapped mt-4">
                <div class="d-flex justify-content-between">
                    <div class="align-self-center">
                        <h2 class="common-title">ERA Unmatched Transaction</h2>
                    </div>
                    <div class="align-self-center mb-2">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <div class="dropdown">
                                    <button class="btn btn-sm p-0 dropdown-toggle" type="button"
                                        data-toggle="dropdown">
                                        <i class="ri-download-2-line"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right download-icon-show">
                                        <a class="dropdown-item" href="#" id="download_pdf2">Download PDF</a>
                                        <a class="dropdown-item" href="#" id="download_csv2">Download CSV</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="table-responsive process_list_table p_table" id="um_list">                 

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')


    <script>
        var raw_data=[];
        var control_number=[];
        var flag="ParseTable_";
        function print_summary(arr){
            $('.t_billed').html(arr.billed);
            $('.t_adj').html(arr.adjusted);
            $('.t_resp').html(arr.respons);
            $('.t_denied').html(arr.denied);
            $('.t_net').html(arr.net);
            $('.t_check').html(arr.total_check);
            $('.check_date').html(arr.check_date);
            $('.check_num').html(arr.check_number);
            $('.summary').show();
        }
        function import_era(formData){
            $('.loading2').show();
            $.ajax({
                type: 'POST',
                url: "{{route('superadmin.era.remittance.upload')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success:function(data){
                    if(data.status=="success"){    
                        console.log(data);
                        raw_data=data.result;
                        control_number=data.control_number;
                        // print_summary(data.totals);
                        $('#all_list').empty();
                        $('#all_list').html(data.view);
                        $('#check_info').empty();
                        $('#check_info').html(data.topTable);
                        $('.process_list').show();
                        $(".c_table").tablesorter();
                        $('.loading2').hide();
                    }
                    else{
                        toastr["error"]("Please upload file to proceed!");
                        $('.loading2').hide();
                    }
                }
            });
        }


        function process_er(control_number,raw_data){
            $('.loading2').show();

            token="{{csrf_token()}}";

            var formData=new FormData();
            formData.append('_token',token);
            formData.append('control_number',JSON.stringify(control_number));
            formData.append('raw_data',JSON.stringify(raw_data));
            formData.append('txt_file',$('#textFile')[0].files[0]);

            $.ajax({
                type:"POST",
                url:"{{route('superadmin.era.process')}}",
                contentType: false,
                processData: false, 
                data:formData,
                success:function(data){
                    console.log(data);
                    if(data.status=="success"){
                        $('#all_list, #um_list').empty();
                        $('#all_list').html(data.matched_view);
                        $('#um_list').html(data.unmatched_view);
                        $('.change_title').text('ERA Matched Transactions');
                        $('.process_list').show();
                        $('.unmapped').show();
                        $(".c_table").tablesorter();
                        $('.loading2').hide();
                        flag="MatchedTransations_";
                    }
                    else if(data.status=="already"){
                        $('.loading2').hide();
                        flag="ParseTable_"
                        toastr["error"]("Check already processed.");
                    }
                }
            });
        }
        



        $('.summary').hide();
        $('.process_list').hide();
        $('.unmapped').hide();

        $(document).on('submit','#import_form',function(e){
            e.preventDefault();
            var formData=new FormData(this);
            import_era(formData);
        });

        $(document).on('click','.all_check',function(){

            if($(this).prop('checked')==true){
                $('.in_check').each(function(){
                    $(this).prop("checked",true);
                })
            }
            else{
                $('.in_check').each(function(){
                    $(this).prop("checked",false);
                })   
            }

        })


        $(document).on('click','#processera',function(){
            if(control_number.length==0){
                toastr["error"]("Please check some claims to proceed!");
            }
            else{
                process_er(control_number,raw_data);
            }

        })

        var timeStamp= moment().format('MMDYYYYhmmss');

        $('#download_csv').click(function(){
            $('.matched').tableExport({
                type:'csv',
                fileName:flag+timeStamp
            });
        });

        $('#download_pdf').click(function(){
            $('.matched').tableExport({
                type:'pdf',
                fileName:flag+timeStamp,
                jspdf: {
                    orientation: "L",
                    autotable: {
                        headerStyles: {
                            fillColor: [32,122,199],
                            textColor: 255,
                            fontStyle: 'bold',
                            halign: 'inherit',
                            valign: 'middle',
                        }
                    }
                }
            });
        });

        $('#download_csv2').click(function(){
            $('.unmatched').tableExport({
                type:'csv',
                fileName:'UnmatchedTransactions_'+timeStamp
            });
        });

        $('#download_pdf2').click(function(){
            $('.unmatched').tableExport({
                type:'pdf',
                fileName:'UnmatchedTransactions_'+timeStamp,
                jspdf: {
                    orientation: "P",
                    autotable: {
                        headerStyles: {
                            fillColor: [32,122,199],
                            textColor: 255,
                            fontStyle: 'bold',
                            halign: 'inherit',
                            valign: 'middle',
                        }
                    }

                }
            });
        });
    </script>

@endsection
