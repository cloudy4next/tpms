@extends('layouts.superadmin')
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <?php
        $client_info = \App\Models\Client_info::where('client_id', $client_id->id)->first();
        ?>
        <div class="iq-card-body">
            <h5 class="mb-2">
                <a href="{{route('superadmin.client.authorization',$client_id->id)}}" title="Back To Client"><i
                        class="ri-arrow-left-circle-line text-primary"></i> </a>
                <a href="{{route('superadmin.client.authorization',$client_id->id)}}"
                   class="cmn_a">{{$client_id->client_first_name}} {{$client_id->client_middle}} {{$client_id->client_last_name}}</a>
                |
                <small>
                    <span
                        class=" font-weight-bold text-orange">DOB:</span> {{\Carbon\Carbon::parse($client_id->client_dob)->format('m/d/Y')}}
                    |
                    <span class=" font-weight-bold text-orange">Phone:</span> {{$client_id->phone_number}} |

                    <span class=" font-weight-bold text-orange">Address:</span>
                    {{$client_id->client_street}} {{$client_id->client_city}} {{$client_id->client_state}} {{$client_id->client_zip}}
                </small>
            </h5>
            <form action="{{route('superadmin.client.authorization.save')}}" method="post" enctype="multipart/form-data"
                  autocomplete="off" id="create_auth_form">
                @csrf
            <div class="overflow-hidden mb-2">
                <div class="float-left">
                    <h5 class="m-0">Add Auth</h5>
                </div>
                <div class="float-right">
                    <div class="custom-control custom-switch billable-switch">
                        <input type="checkbox" class="custom-control-input auth_require_switch" id="bn" name="is_required" value="1">
                        <label class="custom-control-label mr-5" for="bn">Auth Not Required</label>
                        <a href="{{route('superadmin.client.authorization',$client_id->id)}}" class="btn btn-sm btn-primary"
                           title="Back To Authorization"><i class="ri-arrow-left-circle-line"></i>Back</a>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>Description <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm description" name="description" required>
                        <input type="hidden" class="form-control form-control-sm client_id" name="client_id"
                               value="{{$client_id->id}}">
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>Insurance <span class="text-danger">*</span></label>
                        <div class="ui-widget">
                            <select class="form-control form-control-sm" placeholder="Search" name="payor_id" required>
                                @foreach($all_payors as $payor)
                                    <?php
                                    $show_payor = \App\Models\All_payor::where('id', $payor->payor_id)->first();
                                    ?>
                                    @if ($show_payor)
                                        <option value="{{$payor->payor_id}}">{{$payor->payor_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>Tx Type <span class="text-danger">*</span></label>
                        <div class="ui-widget">
                            <select class="form-control form-control-sm" placeholder="Search" name="treatment_type"
                                    required>
                                @foreach($treatment_types as $tret_type)
                                    <option
                                        value="{{$tret_type->treatment_name}}">{{$tret_type->treatment_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>SUPV. Provider <span class="text-danger">*</span></label>
                        <div class="ui-widget">
                            <select class="form-control form-control-sm" placeholder="Search" name="supervisor_id"
                                    required>
                                @foreach($supervisor as $superv)
                                    <?php
                                    $employe_name = \App\Models\Employee::where('id', $superv->employee_id)->first();
                                    ?>
                                    <option
                                        value="{{$employe_name->id}}">{{$employe_name->first_name}} {{$employe_name->middle_name}} {{$employe_name->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>Select Date <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input class="form-control form-control-sm reportrange date_range" name="select_date" readonly
                                   required>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>Authorization Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm authorization_number" name="authorization_number">
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>UCI / Insurance ID <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm ins_number" name="uci_id" required>
                    </div>

                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>COB <span class="text-danger">*</span></label>
                        <select class="form-control form-control-sm" name="is_primary" required>
                            <option value="1">Primary</option>
                            <option value="2">Secondary</option>
                            <option value="3">Tertiary</option>
                        </select>
                    </div>

                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>Upload Authorization</label>
                        <div class="d-flex">
                            <div class="mr-2 align-self-center">
                                <label for="file-up">
                                    {{--                                    <a role="button" class="btn btn-sm btn-primary text-white">Choose File</a>--}}
                                    <input id="file-up" type="file" name="upload_authorization">
                                </label>
                            </div>
                            {{--                            <div class="align-self-center"><a href="#" title="haahhaaaaaaaaaaa"><p class="up_file_name">Upload File</p></a></div>--}}
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <div class="d-inline-block mr-2">
                            <label>Diagnosis1 <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm diagnosis" style="max-width: 100px;"
                                   name="diagnosis_one" required>
                        </div>
                        <div class="d-inline-block">
                            <label>Diagnosis2</label>
                            <input type="text" class="form-control form-control-sm" style="max-width: 100px;"
                                   name="diagnosis_two">
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <div class="d-inline-block">
                            <label>Diagnosis3</label>
                            <input type="text" class="form-control form-control-sm" style="max-width: 100px;"
                                   name="diagnosis_three">
                        </div>
                        <div class="d-inline-block">
                            <label>Diagnosis4</label>
                            <input type="text" class="form-control form-control-sm" style="max-width: 100px;"
                                   name="diagnosis_four">
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <div class="d-inline-block">
                            <label>Deductible</label>
                            <input type="text" class="form-control form-control-sm" style="max-width: 150px;"
                                   name="deductible">
                        </div>
                        <div class="d-inline-block">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="in_network" value="1">In
                                    Network
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>CoPay</label>
                        <input type="text" class="form-control form-control-sm" style="max-width: 150px;" name="copay">
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>CMS 4 (Insured Name)</label>
                        <?php
                        $client_gran_info = \App\Models\Client_guarantar_info::where('client_id', $client_info->client_id)->first();
                        ?>
                        @if ($client_gran_info)
                            <input type="text" class="form-control form-control-sm" name="cms_four"
                                   value="{{$client_gran_info->guarantor_first_name}} {{$client_gran_info->guarantor_last_name}}">
                        @else
                            <input type="text" class="form-control form-control-sm" name="cms_four" value="">
                        @endif

                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>CMS 11 (Group No)</label>
                        <input type="text" class="form-control form-control-sm" name="csm_eleven">
                    </div>
                    <div class="col-md-3 align-self-center mb-2">


                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="ac" name="is_valid"
                                   value="1">
                            <label class="custom-control-label" for="ac">Active</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="ph" name="is_placeholder"
                                   value="1">
                            <label class="custom-control-label" for="ph">Placeholder</label>
                        </div>


                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Notes</label>
                        <textarea class="form-control form-control-sm" name="notes"></textarea>
                    </div>
                    <div class="col-lg-12 align-self-start mt-2">
                        <button type="submit" class="btn btn-primary" id="saveauth">Save Auth</button>
                        <a href="{{route('superadmin.client.authorization',$client_id->id)}}">
                            <button type="button" class="btn btn-dark">Cancel</button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>




    <div class="modal fade" id="hasSecAuth" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal_title">Secondary Auth Exist</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="mod_message">Secondary Auth is already active in other auth, please inactive the other
                        auth to proceed your action</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{--                    <button type="button" class="btn btn-primary">Delete</button>--}}
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')
    <script>
        {{--$(document).ready(function () {--}}
        {{--    $('.is_parimary').change(function () {--}}
        {{--        $('.loading2').show();--}}
        {{--        var pr_id = $(this).val();--}}
        {{--        var client_id = $('.client_id').val();--}}
        {{--        $.ajax({--}}
        {{--            type : "POST",--}}
        {{--            url: "{{route('superadmin.check.auth.has.secondary')}}",--}}
        {{--            data : {--}}
        {{--                '_token' : "{{csrf_token()}}",--}}
        {{--                'pr_id':pr_id,--}}
        {{--                'client_id':client_id,--}}
        {{--            },--}}
        {{--            success:function(data){--}}
        {{--                console.log(data)--}}
        {{--                if (data == 'has sec'){--}}
        {{--                    $('.loading2').hide();--}}

        {{--                    var repl_msg = `<p class="mod_message">Secondary Auth is already active, please change it to inactive to proceed your action</p>`;--}}
        {{--                    $('.mod_message').replaceWith(repl_msg);--}}

        {{--                    var mod_msg = `<h4 class="modal_title">Secondary Auth Exist</h4>`;--}}
        {{--                    $('.modal_title').replaceWith(mod_msg);--}}


        {{--                    $('#hasSecAuth').modal('show');--}}
        {{--                    $('#saveauth').prop('disabled',true)--}}
        {{--                }else if(data == "has pri"){--}}
        {{--                    $('.loading2').hide();--}}
        {{--                    var repl_msg = `<p class="mod_message">Primary Auth is already active, please change it to inactive to proceed your action</p>`;--}}
        {{--                    $('.mod_message').replaceWith(repl_msg);--}}

        {{--                    var mod_msg = `<h4 class="modal_title">Primary Auth Exist</h4>`;--}}
        {{--                    $('.modal_title').replaceWith(mod_msg);--}}

        {{--                    $('#hasSecAuth').modal('show');--}}
        {{--                    $('#saveauth').prop('disabled',true)--}}
        {{--                }else if(data == "has ter"){--}}
        {{--                    $('.loading2').hide();--}}
        {{--                    var repl_msg = `<p class="mod_message">Tertiary Auth is already active, please change it to inactive to proceed your action</p>`;--}}
        {{--                    $('.mod_message').replaceWith(repl_msg);--}}

        {{--                    var mod_msg = `<h4 class="modal_title">Tertiary Auth Exist</h4>`;--}}
        {{--                    $('.modal_title').replaceWith(mod_msg);--}}

        {{--                    $('#hasSecAuth').modal('show');--}}
        {{--                    $('#saveauth').prop('disabled',true)--}}
        {{--                }else {--}}
        {{--                    $('#saveauth').prop('disabled',false)--}}
        {{--                    $('.loading2').hide();--}}
        {{--                }--}}

        {{--            }--}}
        {{--        });--}}

        {{--    })--}}
        {{--})--}}
    </script>
    <script>

        function getFile(filePath) {
            return filePath.substr(filePath.lastIndexOf('\\') + 1).split('.')[0];
        }

        function showname(event) {
            var files = event.target.files[0]
            // for getting only extension
            var fileExtension = files.type.split("/").pop();
            var fileName = files.name
            $('.up_file_name').empty().append(fileName);


        }

        $(document).ready(function () {
            var primary = $('.is_primary').val();
            var placeholder = $('.is_placeholder').val();
            var inactive = $('.is_valid').val();

            $('.auth_require_switch').change(function(){
                if($(this).prop("checked") == true){
                    $('.authorization_number').prop("disabled",true);
                    $('.authorization_number').val('N/A');
                }
                else{
                    $('.authorization_number').prop("disabled",false);
                    $('.authorization_number').val('');

                }
            })

            $('.upload_file').change(function () {

            })

            $('#saveauth').click(function(e){
                e.preventDefault();
                date_val = $('.date_range').val();
                description = $('.description').val();
                disagnosis = $('.diagnosis').val();
                auth_num = $('.authorization_number').val();
                ins_num = $('.ins_number').val();
                if(description == null || description == ''){
                    toastr["error"]("Give description to proceed.","ALERT!");
                }
                else if(date_val == null || date_val == ''){
                    toastr["error"]("Select date to proceed.","ALERT!");
                }
                else if(auth_num == null || auth_num == ''){
                    toastr["error"]("Give Auth Number to proceed.","ALERT!");
                }
                else if(ins_num == null || ins_num == ''){
                    toastr["error"]("Give UCI/Insurance ID to proceed.","ALERT!");
                }
                else if(disagnosis == null || disagnosis == ''){
                    toastr["error"]("Give Diagnosis 1 to proceed.","ALERT!");
                }
                else{
                    $('#create_auth_form').submit();
                }
            });

            $('.is_primary').click(function () {
                if ($('.is_primary').is(':checked') && $('.is_placeholder').is(':checked')) {
                    $('.is_valid').prop('checked', false);
                    $('.is_valid').prop('disabled', true);
                } else if ($('.is_primary').is(':checked') && $('.is_placeholder').not(':checked')) {
                    $('.is_valid').prop('disabled', false);
                } else {
                    if ($('.is_primary').is(':checked')) {
                        $('.is_valid').prop('checked', true);
                    }

                    $('.is_valid').prop('disabled', false);
                }
            })


            $('.is_placeholder').click(function () {
                if ($('.is_primary').is(':checked') && $('.is_placeholder').is(':checked')) {
                    $('.is_valid').prop('checked', false);
                    $('.is_valid').prop('disabled', true);
                } else if ($('.is_valid').is(':checked') && $('.is_placeholder').is(':checked')) {
                    $('.is_primary').prop('checked', false);
                    $('.is_primary').prop('disabled', true);
                } else {
                    if ($('.is_primary').is(':checked')) {
                        $('.is_valid').prop('checked', false);
                    }

                    $('.is_valid').prop('disabled', false);
                }
            })


            $('.is_valid').click(function () {
                if ($('.is_valid').is(':checked') && $('.is_placeholder').is(':checked')) {
                    $('.is_primary').prop('checked', false);
                    $('.is_primary').prop('disabled', true);
                } else if ($('.is_primary').is(':checked') && $('.is_placeholder').not(':checked')) {
                    $('.is_valid').prop('disabled', false);
                } else {
                    if ($('.is_valid').is(':checked')) {
                        $('.is_primary').prop('checked', false);
                    }
                    $('.is_primary').prop('disabled', false);
                }
            })


        })
    </script>
@endsection
