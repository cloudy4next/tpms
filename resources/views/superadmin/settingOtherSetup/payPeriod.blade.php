@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-lg-flex">
                <!-- menu -->
                <div class="setting_menu">
                    @include('superadmin.include.settingMenu')
                </div>
                <!-- content -->
                <div class="all_content flex-fill">
                    <div class="overflow-hidden mb-3">
                        <div class="float-left">
                            <h5 class="common-title m-0">Pay Period</h5>
                        </div>
                        <div class="float-right">
                            <a href="#payperiodcreate" class="btn btn-sm btn-primary" data-toggle="modal">Create
                                Pay Period</a>
                        </div>
                    </div>
                    <!-- modal -->
                    <div class="modal fade" id="payperiodcreate" data-backdrop="static">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Create/Edit Pay Period</h4>
                                    <button type="button" class="close"
                                            data-dismiss="modal">&times;
                                    </button>
                                </div>
                                <form action="{{route('superadmin.pay.period.save')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Select Pay Period length</label>
                                                <select class="form-control form-control-sm peor_len"
                                                        name="period_length"
                                                        required>
                                                    <option value="1">Weekly</option>
                                                    <option value="4">Bi-Weekly</option>
                                                    <option value="2">From 1st & 15th Every
                                                        Month
                                                    </option>
                                                    <option value="5">From 5th & 20th Every
                                                        Month
                                                    </option>
                                                    <option value="6">From 15th & 30th Every
                                                        Month
                                                    </option>
                                                    <option value="3">Monthly</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3 pay_per_wek_div">
                                                <label>Week Day</label>
                                                <select class="form-control form-control-sm pay_per_week_day"
                                                        name="week_day_name" required>
                                                    <option value="Sunday">Sunday</option>
                                                    <option value="Monday">Monday</option>
                                                    <option value="Tuesday">Tuesday</option>
                                                    <option value="Wednesday">Wednesday</option>
                                                    <option value="Thursday">Thursday</option>
                                                    <option value="Friday">Friday</option>
                                                    <option value="Saturday">Saturday</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Select year</label>
                                                <select class="form-control form-control-sm" name="year" required>
                                                    <option value="2019">2019</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>End Date</label>
                                                <input type="date" class="form-control form-control-sm" name="end_date"
                                                       required>
                                            </div>
                                            <div class="col-md-6 align-self-end mb-3">
                                                <label>Check Date</label>
                                                {{--                                                <input type="date" class="form-control form-control-sm"--}}
                                                {{--                                                       name="check_date">--}}
                                                <select class="form-control form-control-sm pay_per_week_day"
                                                        name="check_date" required>
                                                    <option value="Sunday">Sunday</option>
                                                    <option value="Monday">Monday</option>
                                                    <option value="Tuesday">Tuesday</option>
                                                    <option value="Wednesday">Wednesday</option>
                                                    <option value="Thursday">Thursday</option>
                                                    <option value="Friday">Friday</option>
                                                    <option value="Saturday">Saturday</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>After how many days staff can't submit time
                                                    sheet?</label>
                                                <input type="number" class="form-control form-control-sm"
                                                       name="time_sheet" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Close
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--/ modal -->
                    <!-- table -->
                    <div class="table-responsive period_table_div" onscroll="GetScrollerEndPoint()">
                        <table class="table table-sm table-bordered c_table">
                            <thead>
                            <tr>
                                <th class="checkbox"><input type="checkbox" class="check_all"></th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Last Date to Submit Timesheets</th>
                                <th>Check Date</th>
                                <th>Week Day</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="pay_period_container">
                            
                            </tbody>
                            <tbody class="show_animation">
                                @for($i=0;$i<40;$i++)
                                    <tr data-tableexport-display="none">
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td class="p_th_remove">
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td class="s_th_remove">
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                         <form action="{{route('superadmin.pay.period.delete.bulk')}}" method="POST" id="bulk_form">
                    <div class="d-flex mb-2">
                            @csrf
                            <input type="hidden" name="ids" id="ids">    
                            <div class="align-self-end mr-2">
                                <select class="form-control form-control-sm select_filter">
                                    <option value="0" selected></option>
                                    <option value="1">Bulk Delete</option>
                                </select>
                            </div>
                            <div class="align-self-end mr-2 update_div">
                                <button type="submit" class="btn btn-sm btn-primary" id="go_btn">Go</button>
                            </div>
                    </div>
                        </form>
                            <br>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            // let peor_len = $('.peor_len').val();
            // if (peor_len == 1) {
            //     $('.pay_per_wek_div').show();
            // } else if (peor_len == 4) {
            //     $('.pay_per_wek_div').show();
            // } else {
            //     $('.pay_per_wek_div').hide();
            // }


            // $('.peor_len').change(function () {
            //     let peor_len_val = $('.peor_len').val();
            //     if (peor_len_val == 1) {
            //         $('.pay_per_wek_div').show();
            //     } else if (peor_len_val == 4) {
            //         $('.pay_per_wek_div').show();
            //     } else {
            //         $('.pay_per_wek_div').hide();
            //     }
            // });


            var ENDPOINT = "{{ url('/') }}";
            var page = 1;
            var current_page = 0;
            let bool = false;
            let lastPage;
            var currentscrollHeight = 0;


            $(window).scroll(function () {

                const scrollHeight = $(document).height();
                const scrollPos = Math.floor($(window).height() + $(window).scrollTop());
                const isBottom = scrollHeight - 100 < scrollPos;
                if (isBottom && currentscrollHeight < scrollHeight) {
                    page++;
                    var myurl = ENDPOINT + '/admin/settting/pay-period-fetch?page=' + page
                    fetch_pay_periods_filter(myurl);
                    currentscrollHeight = scrollHeight;
                }
            });

            function fetch_pay_periods_filter(myurl) {
            $('.show_animation').show();
                $.ajax(
                    {
                        url: myurl,
                        type: "POST",
                        data: {
                            '_token': "{{csrf_token()}}",
                        },
                        datatype: "html"
                    }).done(function (data) {
                    // console.log(data)
                    $('.pay_period_container').append(data.view);
                    $('.show_animation').hide();
                    // $('.show_data').append(data.view);
                    $('.c_table').trigger('update');
                    $('.show_animation').hide();

                }).fail(function (jqXHR, ajaxOptions, thrownError) {
                    alert('No response from server');
                    $('.loading2').hide();
                });
            }



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


            $('#go_btn').click(function(e){
                e.preventDefault();
                if($('.select_filter').val()==1){
                    arr=[];
                    $('.in_check').each(function(){
                        if($(this).prop("checked")==true){
                            arr[arr.length]=$(this).attr("id");
                        }
                    })

                    if(arr.length>0){
                        $('#ids').val(arr);
                        $('#bulk_form').submit();
                    }
                    else{
                        toastr["error"]("Please select records to proceed!");
                    }
                }
            });



            function fetch_pay_periods(){
                $('.pay_period_container').html('');
                $('.loading2').show();
                $.ajax({
                    url:"{{route('superadmin.pay.period.fetch')}}",
                    method:"POST",
                    data:{
                        "_token":"{{csrf_token()}}",
                    },
                    success: function(data){
                        // console.log(data);
                        if(data.status=="success"){
                            // console.log(data.view);
                            $('.show_animation').hide();
                            $('.pay_period_container').append(data.view);
                            $('.loading2').hide();
                        }

                    }
                });
            }

            fetch_pay_periods();


        })
    </script>
@endsection
