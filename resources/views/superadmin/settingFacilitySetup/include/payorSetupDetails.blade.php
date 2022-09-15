@section('js')

    <script>

        var ins_id;
        function trigger_sibling(rep,check){
            rep=rep.replace("run","prevent");
            sel=$('input[id="'+rep+'"]');
            sel.prop("disabled",check);
            if(check==false){
            }
            else{
                sel.val("2");
                sel.prop("checked",false);
                sel.parent().find('label').text('No');
            }
        }

        function disabling_check(){
            $('.run_col').each(function(){
                if($(this).is(":checked")){
                    trigger_sibling($(this).attr("id"),false);
                }
                else{
                    trigger_sibling($(this).attr("id"),true);
                }
            })
        }


        $(document).on('change','.run_col',function () {
            if ($(this).is(":checked")) {
                disabling_check();
                $(this).val("1");
                $(this).parent().find('label').text('Yes');
            } else {
                disabling_check();
                $(this).val("2");
                $(this).parent().find('label').text('No');
            }
        });

        $(document).on('change','.prevent_col',function () {
            if ($(this).is(":checked")) {
                $(this).val("1");
                $(this).parent().find('label').text('Yes');
            } else {
                $(this).val("2");
                $(this).parent().find('label').text('No');
            }
        });

        var ids=[];
        var run=[];
        var prevent=[];



        $(document).on('click','#save_scrubbing_btn',function(){
            $('.run_col').each(function(){
                ids.push($(this).attr("scrubbing-id"));
                run.push($(this).val());
                rep=$(this).attr("id");
                rep=rep.replace("run","prevent");
                sel=$('input[id="'+rep+'"]');
                prevent.push(sel.val());
            })



            $.ajax({
                url:"{{route('superadmin.save.scrubbing.info')}}",
                method:"POST",
                data:{
                    "_token":"{{csrf_token()}}",
                    ins_id:ins_id,
                    ids:ids,
                    run:run,
                    prevent:prevent
                },
                success:function(data){
                    console.log(data);
                    if(data=="success"){
                        toastr["success"]("Scrubbing details saved.");
                    }
                    else{
                        toastr["error"]("Some error occurred.");
                    }
                }
            });
        })


    </script>

    <script>
        jQuery(document).ready(function ($) {
            $('.payor_table').show();
            // $('.save_payor').hide();
            $('.edit_payor').hide();
            $('.load_payor').click(function (event) {
                $('.payor_table').show();
                $('.save_payor').show();
            });
            $('.edit_btn').click(function (event) {
                event.preventDefault();
                $('.edit_payor').show();
                $('.cancel_btn').click(function (event) {
                    $('.edit_payor').hide();
                });
            });
            $(".selectall").change(function () {
                var status = this.checked;
                $('.checkbox').each(function () {
                    this.checked = status;
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {

            let max = 0;


            function fetch_scrubbing_info(id){
                $.ajax({
                    url:"{{route('superadmin.fetch.scrubbing.info')}}",
                    method:"POST",
                    data:{
                        "_token":"{{csrf_token()}}",
                        "id":id,
                    },
                    success:function(data){
                        console.log(data);
                        $('.scrubbing_div').empty();
                        $('.scrubbing_div').html(data.view);
                        disabling_check();
                    }
                });
            }

            $('.edit_btn').click(function () {
                $('.loading2').show();
                var edi_id = $(this).data('id');
                ins_id=edi_id;

                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.payor.setup.details')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'edi_id': edi_id,
                    },
                    success: function (data) {
                        console.log(data);
                        $('.payor_up_id').val(data.payor_details.id)
                        $('.copay_number').val(data.payor_details.co_pay)
                        if (data.payor_details.day_club == 1) {
                            $('.day_cub').prop('checked', true);
                        } else {
                            $('.day_cub').prop('checked', false);
                        }
                        if (data.payor_details.is_electronic == 1) {
                            $('.is_elec_edit').prop('checked', true);
                        } else {
                            $('.is_elec_edit').prop('checked', false);
                        }
                        $('.cms1500_31').val(data.payor_details.cms_1500_31)
                        $('.cms1500_32a').val(data.payor_details.cms_1500_32a)
                        $('.cms1500_32b').val(data.payor_details.cms_1500_32b)
                        $('.cms1500_33a').val(data.payor_details.cms_1500_33a)
                        $('.cms1500_33b').val(data.payor_details.cms_1500_33b)
                        $('.npi').val(data.payor_details.npi)
                        $('.tax_id').val(data.payor_details.tax_id)
                        $('.ssn').val(data.payor_details.ssn)
                        if (data.payor_details.is_active == 1) {
                            $('.is_active_edit').prop('checked', true);
                        } else {
                            $('.is_active_edit').prop('checked', false);
                        }
                        if (data.payor_details.box_17 == 1) {
                            $('.box_17').prop('checked', true);
                        } else {
                            $('.box_17').prop('checked', false);
                        }
                        if (data.payor_details.day_pay_cpt == 1) {
                            $('.day_pay_cpt').prop('checked', true);
                        } else {
                            $('.day_pay_cpt').prop('checked', false);
                        }
                        $('.cpt_code_day').val(data.payor_details.cpt_code_day);
                        $('.cms1500_32address').val(data.payor_details.cms1500_32address);
                        $('.cms1500_32city').val(data.payor_details.cms1500_32city);
                        $('.cms1500_32state').val(data.payor_details.cms1500_32state);
                        $('.cms1500_32zip').val(data.payor_details.cms1500_32zip);

                        $('.cms1500_33address').val(data.payor_details.cms1500_33address);
                        $('.cms1500_33city').val(data.payor_details.cms1500_33city);
                        $('.cms1500_33state').val(data.payor_details.cms1500_33state);
                        $('.cms1500_33zip').val(data.payor_details.cms1500_33zip);


                        let array_data = [];
                        console.log(data.tx_types)
                        array_data.length = 0;
                        $('.all_tx_types').empty();
                        $('.all_tx_types').append(
                            `
                             <tr>
                                            <th><label>Tx Type</label></th>
                                            <th class="text-center"><label>Box 24J</label></th>
                                            <th class="text-center"><label>ID Qualifier</label></th>
                                        </tr>
                            `
                        );
                        $.each(data.tx_types, function (index, value) {
                            max++;
                            let id_q_val = value.id_qualifire;
                            array_data.push(id_q_val);
                            $('.all_tx_types').append(
                                `<tr>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="treatment_id" value="${value.treatment_id}"  class="form-check-input treatment_id">${value.treatment_name}
                                                        <input type="hidden" name="edit_details_id" value="${value.id}"  class="form-check-input edit_details_id">
                                                        <input type="hidden" name="payor_id" value="${value.payor_id}"  class="form-check-input edit_details_id">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="box_24j" value="${value.box_24j}" class="form-control form-control-sm box_24j"
                                                           placeholder="Box 24J" required>
                                                </td>
                                                <td>
                                                    <select class="form-control form-control-sm id_qualifire" id="v_msgnew${max}" name="id_qualifire_data" required>
                                                        <option value="">ID Qualifier</option>
                                                        <option value="0B" >0B</option>
                                                        <option value="1B">1B</option>
                                                        <option value="1C">1C</option>
                                                        <option value="1D" >1D</option>
                                                        <option value="1G">1G</option>
                                                        <option value="1H">1H</option>
                                                        <option value="EI">EI</option>
                                                        <option value="G2">G2</option>
                                                        <option value="LU">LU</option>
                                                        <option value="N5">N5</option>
                                                        <option value="SY">SY</option>
                                                        <option value="X5">X5</option>
                                                        <option value="ZZ">ZZ</option>
                                                    </select>
                                                </td>
                                            </tr>`
                            );

                        });

                        $('.id_qualifire').each(function (max, value) {
                            $(this).val(array_data[max]);
                        });

                        fetch_scrubbing_info(edi_id);

                        $('.loading2').hide();


                    }
                });
            });


            $('.save_payor').click(function (e) {
                e.preventDefault();
                let edit_id = [];
                let is_electonic_data = [];
                let cms_1500_31 = [];
                let cms_1500_32a = [];
                let cms_1500_32b = [];
                let cms_1500_33a = [];
                let cms_1500_33b = [];
                let is_active_data = [];
                $('.checkPayorSetup:checked').each(function () {

                    edit_id.push(jQuery(this).closest('tr').find("input[name='edit_payor']")
                        .val());


                    if (jQuery(this).closest('tr').find("input[name='is_electonic']").is(':checked')) {
                        is_electonic_data.push(1);
                    } else {
                        is_electonic_data.push(0);
                    }


                    cms_1500_31.push(jQuery(this).closest('tr').find("input[name='cms_1500_31']")
                        .val());

                    cms_1500_32a.push(jQuery(this).closest('tr').find("input[name='cms_1500_32a']")
                        .val());

                    cms_1500_32b.push(jQuery(this).closest('tr').find("input[name='cms_1500_32b']")
                        .val());

                    cms_1500_33a.push(jQuery(this).closest('tr').find("input[name='cms_1500_33a']")
                        .val());

                    cms_1500_33b.push(jQuery(this).closest('tr').find("input[name='cms_1500_33b']")
                        .val());


                    if (jQuery(this).closest('tr').find("input[name='is_active']").is(':checked')) {
                        is_active_data.push(1);
                    } else {
                        is_active_data.push(0);
                    }

                });


                console.log(is_electonic_data)


                if (edit_id == null || edit_id == '') {
                    toastr["error"]("Please Select Insurance", 'ALERT!');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{route('superadmin.payor.setup.update.table')}}",
                        data: {
                            '_token': "{{csrf_token()}}",
                            'edit_id': edit_id,
                            'is_electonic_data': is_electonic_data,
                            'cms_1500_31': cms_1500_31,
                            'cms_1500_32a': cms_1500_32a,
                            'cms_1500_32b': cms_1500_32b,
                            'cms_1500_33a': cms_1500_33a,
                            'cms_1500_33b': cms_1500_33b,
                            'is_active_data': is_active_data,
                        },
                        success: function (data) {
                            console.log(data);
                            toastr["success"]("Payor Details Successfully Updated", 'SUCCESS!');
                            $('.loading2').hide();

                        }
                    });
                }


            })


            $('#save').click(function (e) {
                e.preventDefault();
                $('.loading2').show();
                var payor_up_id = $('.payor_up_id').val();
                var copay_number = $('.copay_number').val();
                var day_cub = $('.day_cub').val();
                if ($('.is_elec_edit').prop('checked') == true) {
                    var is_elec = 1;
                } else {
                    var is_elec = 0;
                }


                // var is_elec = $('.is_elec').val();
                var cms1500_31 = $('.cms1500_31').val();
                var cms1500_32a = $('.cms1500_32a').val();
                var cms1500_32b = $('.cms1500_32b').val();
                var cms1500_33a = $('.cms1500_33a').val();
                var cms1500_33b = $('.cms1500_33b').val();
                var npi = $('.npi').val();
                var tax_id = $('.tax_id').val();
                var ssn = $('.ssn').val();
                if ($('.is_active_edit').prop('checked') == true) {
                    var is_active = 1;
                } else {
                    var is_active = 0;
                }

                if ($('.box_17').prop('checked') == true) {
                    var box_17 = 1;
                } else {
                    var box_17 = 0;
                }


                if ($('.day_pay_cpt').prop('checked') == true) {
                    var day_pay_cpt = 1
                } else {
                    var day_pay_cpt = 0
                }

                var cms1500_32address = $('.cms1500_32address').val();
                var cms1500_32city = $('.cms1500_32city').val();
                var cms1500_32state = $('.cms1500_32state').val();
                var cms1500_32zip = $('.cms1500_32zip').val();

                var cms1500_33address = $('.cms1500_33address').val();
                var cms1500_33city = $('.cms1500_33city').val();
                var cms1500_33state = $('.cms1500_33state').val();
                var cms1500_33zip = $('.cms1500_33zip').val();

                let treatment_id = [];
                let edit_details_id = [];
                let box_24j = [];
                let id_qualifire = [];


                $('.treatment_id:checked').each(function () {
                    treatment_id.push(jQuery(this).closest('tr').find("input[name='treatment_id']").val());
                    edit_details_id.push(jQuery(this).closest('tr').find("input[name='edit_details_id']").val());
                    box_24j.push(jQuery(this).closest('tr').find("input[name='box_24j']").val());
                    id_qualifire.push(jQuery(this).closest('tr').find("select[name='id_qualifire_data']").val());
                });

                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.payor.setup.details.update')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'payor_up_id': payor_up_id,
                        'copay_number': copay_number,
                        'day_cub': day_cub,
                        'is_elec': is_elec,
                        'cms1500_31': cms1500_31,
                        'cms1500_32a': cms1500_32a,
                        'cms1500_32b': cms1500_32b,
                        'cms1500_33a': cms1500_33a,
                        'cms1500_33b': cms1500_33b,
                        'npi': npi,
                        'tax_id': tax_id,
                        'ssn': ssn,
                        'is_active': is_active,
                        'box_17': box_17,
                        'day_pay_cpt': day_pay_cpt,
                        // 'cms150032_address': cms150032_address,
                        // 'cms150033_address': cms150033_address,
                        'cms1500_32address': cms1500_32address,
                        'cms1500_32city': cms1500_32city,
                        'cms1500_32state': cms1500_32state,
                        'cms1500_32zip': cms1500_32zip,

                        'cms1500_33address': cms1500_33address,
                        'cms1500_33city': cms1500_33city,
                        'cms1500_33state': cms1500_33state,
                        'cms1500_33zip': cms1500_33zip,


                        'treatment_id': treatment_id,
                        'edit_details_id': edit_details_id,
                        'box_24j': box_24j,
                        'id_qualifire': id_qualifire,
                    },
                    success: function (data) {
                        console.log(data);
                        toastr["success"]("Payor Details Successfully Updated", 'SUCCESS!');
                        $('.loading2').hide();

                    }
                });

            });


            $('.tableactive').change(function () {
                if ($(this).is(":checked")) {
                    $(this).parent().find('label').text('Active');
                } else {
                    $(this).parent().find('label').text('In-active');
                }
            })


        })
    </script>
@endsection
