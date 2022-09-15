@extends('layouts.superadmin')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">
@endsection
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-lg-flex">
                <!-- menu -->
                <div class="setting_menu">
                    @include('superadmin.include.settingMenu')
                </div>
                <div class="all_content flex-fill">
                                <ul class="list-inline mb-3">
                                    <li class="list-inline-item">
                                        <a class="btn btn-light" data-toggle="collapse" href="#bt">Behavioral therapy <i
                                                class="ri-arrow-down-s-line arrow_down"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="btn btn-light" data-toggle="collapse" href="#mh">Mental Health <i
                                                class="ri-arrow-down-s-line arrow_down"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="btn btn-light" data-toggle="collapse" href="#st">Speech Therapy <i
                                                class="ri-arrow-down-s-line arrow_down"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="btn btn-light" data-toggle="collapse" href="#ot">Occupational Therapy
                                            <i class="ri-arrow-down-s-line arrow_down"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="btn btn-light" data-toggle="collapse" href="#pt">Physical Therapy <i
                                                class="ri-arrow-down-s-line arrow_down"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="btn btn-light" data-toggle="collapse" href="#mt">Music Therapy <i
                                                class="ri-arrow-down-s-line arrow_down"></i></a>
                                    </li>
                                </ul>
                                <!-- Behavioral -->
                                <div class="collapse mt-2" id="bt">
                                    <h2 class="common-title">Behavioral therapy</h2>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h2 class="common-title text-primary text-center">Unassigned</h2>
                                            <select class="form-control all_beh_forms" multiple>
                                            </select>
                                            <button type="button"
                                                class="btn btn-sm btn-primary mt-2 view-btn view_beh_forms">View</button>
                                        </div>
                                        <div class="col-md-4 mt-5">
                                            <button type="button"
                                                class="btn btn-sm btn-primary d-block mx-auto mb-2 add_beh_forms">Add >> </button>
                                            <button type="button"
                                                class="btn btn-sm btn-danger d-block mx-auto mb-2 remove_beh_forms"> << Remove</button>
                                        </div>
                                        <div class="col-md-4">
                                            <h2 class="common-title text-primary text-center">Assigned</h2>
                                            <select class="form-control assigned_beh_forms" multiple></select>
                                            <button type="button"
                                                class="btn btn-sm btn-primary mt-2 view-btn view_beh2_forms">View</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Mental -->
                                <div class="collapse mt-2" id="mh">
                                    <h2 class="common-title">Mental Health</h2>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h2 class="common-title text-primary text-center">Unassigned</h2>
                                            <select class="form-control all_mental_forms" multiple>
                                            </select>
                                            <button type="button" class="btn btn-sm btn-primary mt-2 view_mental_forms">View</button>
                                        </div>
                                        <div class="col-md-4 mt-5">
                                            <button type="button"
                                                class="btn btn-sm btn-primary d-block mx-auto mb-2 add_mental_forms">Add >> </button>
                                            <button type="button"
                                                class="btn btn-sm btn-danger d-block mx-auto mb-2 remove_mental_forms"> << Remove</button>
                                        </div>
                                        <div class="col-md-4">
                                            <h2 class="common-title text-primary text-center">Assigned</h2>
                                            <select class="form-control assigned_mental_forms" multiple></select>
                                            <button type="button" class="btn btn-sm btn-primary mt-2 view_mental2_forms">View</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Speech -->
                                <div class="collapse mt-2" id="st">
                                    <h2 class="common-title">Speech therapy</h2>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h2 class="common-title text-primary text-center">Unassigned</h2>
                                            <select class="form-control all_speech_forms" multiple>
                                                
                                            </select>
                                            <button type="button" class="btn btn-sm btn-primary mt-2 view_speech_forms">View</button>
                                        </div>
                                        <div class="col-md-4 mt-5">
                                            <button type="button"
                                                class="btn btn-sm btn-primary d-block mx-auto mb-2 add_speech_forms">Add >> </button>
                                            <button type="button"
                                                class="btn btn-sm btn-danger d-block mx-auto mb-2 remove_speech_forms"> << Remove</button>
                                        </div>
                                        <div class="col-md-4">
                                            <h2 class="common-title text-primary text-center">Assigned</h2>
                                            <select class="form-control assigned_speech_forms" multiple></select>
                                            <button type="button" class="btn btn-sm btn-primary mt-2 view_speech2_forms">View</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
            </div>
        </div>
    </div>



    {{-- <div class="modal fade" id="createTemp">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Create New Template</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('superadmin.setting.notes.forms.save')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-7 mb-2">
                                <input type="text" class="form-control form-control-sm" name="template_name"
                                       placeholder="New Template"
                                       required>
                            </div>
                            <div class="col-md-5 mb-2">
                                <select class="form-control form-control-sm" name="template_type" required>
                                    <option value="Appointment">
                                        For Progress Notes
                                    </option>
                                    <option value="Client">For Intake Forms</option>
                                    <option value="Assessment">For Assessments</option>
                                </select>
                            </div>
                            <div class="col-md-7 mb-2">
                                <input type="text" class="form-control form-control-sm" name="display_name"
                                       placeholder="Display Name"
                                       required>
                                <p class="mt-2 mb-0">This is the title that will print onto your documents. If this is
                                    left
                                    blank, the
                                    template name will be used.</p>
                            </div>
                            <div class="col-md-7">
                                <div id="addNew" class="collapse mb-2">
                                    <div class="input-group mb-2">
                                        <select class="form-control form-control-sm" name="question_type">
                                            <optgroup label="Questions">
                                                <option value="FREE_TEXT">Long Answer (Multiple-line text)</option>
                                                <option value="SHORT_ANSWER">Short Answer (Single-line text)</option>
                                                <option value="SINGLE_SELECT">Single Choice (Radio Buttons)</option>
                                                <option value="MULTI_SELECT">Multiple Choice (Checkboxes)</option>
                                                <option value="TEXT_FIELDS">Short Answers (Question Groups)</option>
                                                <option value="DROPDOWN">Dropdown</option>
                                                <option value="DATE">Date Field (Calendar)</option>
                                            </optgroup>
                                            <optgroup label="Text &amp; Dividers (Not Questions)">
                                                <option value="PARAGRAPH_TEXT">Paragraph Text (No Client Input)</option>
                                                <option value="SECTION_HEADER">Section Header</option>
                                                <option value="SECTION_BREAK">Section Break</option>
                                            </optgroup>
                                        </select>
                                        <button class="btn btn-sm btn-danger" type="button"><i class="fa fa-trash"
                                                                                               aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <textarea class="form-control form-control-sm"
                                              placeholder="Question Text" name="question"></textarea>
                                    <div class="mt-2">
                                        <button type="button" class="btn btn-sm rounded-pill btn-secondary"
                                                data-toggle="collapse" data-target="#answer">+ Answer
                                        </button>
                                    </div>
                                    <div id="answer" class="collapse mt-2">
                                        <div class="d-flex">
                                            <div class="align-self-end mr-2">
                                                <input type="text" class="form-control form-control-sm"
                                                       placeholder="Answer Text" name="answer">
                                            </div>
                                            <div class="align-self-end mr-2">
                                                <select class="form-control form-control-sm" name="answer_type">
                                                    <option value="0">No free text field</option>
                                                    <option value="1">Allow one line of response</option>
                                                    <option value="2">Allow multi-line response</option>
                                                </select>
                                            </div>
                                            <div class="align-self-end">
                                                <button class="btn btn-sm btn-danger" type="button"><i
                                                        class="fa fa-trash" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check mt-2">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Require answer
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-0">
                            <a class="btn btn-primary" data-toggle="collapse" href="#addNew">Add New</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}


    <form action="{{route('superadmin.setting.template.library.from')}}" method="POST" id="form_open" target="_blank">
        @csrf
        <input type="hidden" name="id">
    </form>
@endsection


@section('js')

<script src="{{ asset('assets/') }}/toastr/build/toastr.min.js"></script>
<script src="{{ asset('assets/') }}/toastr/toastr.init.js"></script>



<script type="text/javascript">

$('.view_beh_forms').click(function() {
    view_f=$('.all_beh_forms').val();
    if(view_f==null){
        return false;
    }
    else{
        view_f=view_f[0];
        $('#form_open input[name="id"]').val(view_f);
        $('#form_open').submit();
    }
});

$('.view_mental_forms').click(function() {
    view_f=$('.all_mental_forms').val();
    if(view_f==null){
        return false;
    }
    else{
        view_f=view_f[0];
        $('#form_open input[name="id"]').val(view_f);
        $('#form_open').submit();
    }
});

$('.view_speech_forms').click(function() {
    view_f=$('.all_speech_forms').val();
    if(view_f==null){
        return false;
    }
    else{
        view_f=view_f[0];
        $('#form_open input[name="id"]').val(view_f);
        $('#form_open').submit();
    }
});

$('.view_beh2_forms').click(function() {
    view_f=$('.assigned_beh_forms').val();
    if(view_f==null){
        return false;
    }
    else{
        view_f=view_f[0];
        $('#form_open input[name="id"]').val(view_f);
        $('#form_open').submit();
    }
});

$('.view_mental2_forms').click(function() {
    view_f=$('.assigned_mental_forms').val();
    if(view_f==null){
        return false;
    }
    else{
        view_f=view_f[0];
        $('#form_open input[name="id"]').val(view_f);
        $('#form_open').submit();
    }
});

$('.view_speech2_forms').click(function() {
    view_f=$('.assigned_speech_forms').val();
    if(view_f==null){
        return false;
    }
    else{
        view_f=view_f[0];
        $('#form_open input[name="id"]').val(view_f);
        $('#form_open').submit();
    }
});
    

$('.add_beh_forms').click(function () {
    var forms = $('.all_beh_forms').val();
    $.ajax({
        type : "POST",
        url: "{{route('superadmin.save.forms')}}",
        data : {
            '_token' : "{{csrf_token()}}",
            'forms' : forms,
            'type' : 'behavior'
        },
        success:function(data){
            show_all_forms();
            if (data == 'done'){
                toastr["success"]("Form assigned successfully!", 'SUCCESS!');
            }
            else if(data=="some_applied"){
                toastr["error"]("Some of selected forms are already assigned!", 'ERROR!');
            }
            else if(data=="some_not_found"){
                toastr["error"]("Some of selected form templates are not found!", 'ERROR!');
            }
        }
    });


});

$('.remove_beh_forms').click(function () {
    var ass_forms = $('.assigned_beh_forms').val();
    $.ajax({
        type : "POST",
        url: "{{route('superadmin.remove.forms')}}",
        data : {
            '_token' : "{{csrf_token()}}",
            'forms' : ass_forms,
        },
        success:function(data){
            show_all_forms();
            if (data == 'done'){
                toastr["success"]("Forms removed successfully!", 'SUCCESS!');
            }
        }
    });


});


function show_all_forms(){

    //Available forms
    $.ajax({
        type : "POST",
        url: "{{route('superadmin.available.forms')}}",
        data : {
            '_token' : "{{csrf_token()}}",
            'type' : 'behavior'
        },
        success:function(data){
            $('.all_beh_forms').empty();
            $.each(data,function (index,value) {
                $('.all_beh_forms').append(
                    `<option value="${value.id}">${value.template_name}</option>`
                )
            });
        }
    });

    //Assigned Forms
    $.ajax({
        type : "POST",
        url: "{{route('superadmin.assigned.forms')}}",
        data : {
            '_token' : "{{csrf_token()}}",
            'type' : 'behavior'
        },
        success:function(data){
            $('.assigned_beh_forms').empty();
            $.each(data,function (index,value) {
                $('.assigned_beh_forms').append(
                    `<option value="${value.template_id}">${value.template_name}</option>`
                )
            });
        }
    });
}

show_all_forms();



//Mental Forms

$('.add_mental_forms').click(function () {
    var mental_forms = $('.all_mental_forms').val();
    $.ajax({
        type : "POST",
        url: "{{route('superadmin.save.forms')}}",
        data : {
            '_token' : "{{csrf_token()}}",
            'forms' : mental_forms,
            'type':'mental'
        },
        success:function(data){
            show_all_mental_forms();
            if (data == 'done'){
                toastr["success"]("Form assigned successfully!", 'SUCCESS!');
            }
            else if(data=="some_applied"){
                toastr["error"]("Some of selected forms are already assigned!", 'ERROR!');
            }
            else if(data=="some_not_found"){
                toastr["error"]("Some of selected form templates are not found!", 'ERROR!');
            }
        }
    });


});

$('.remove_mental_forms').click(function () {
    var ass_mental_forms = $('.assigned_mental_forms').val();
    $.ajax({
        type : "POST",
        url: "{{route('superadmin.remove.forms')}}",
        data : {
            '_token' : "{{csrf_token()}}",
            'forms' : ass_mental_forms,
        },
        success:function(data){
            show_all_mental_forms();
            if (data == 'done'){
                toastr["success"]("Forms removed successfully!", 'SUCCESS!');
            }
        }
    });


});


function show_all_mental_forms(){

    //Available forms
    $.ajax({
        type : "POST",
        url: "{{route('superadmin.available.forms')}}",
        data : {
            '_token' : "{{csrf_token()}}",
            'type' : 'mental'
        },
        success:function(data){
            $('.all_mental_forms').empty();
            $.each(data,function (index,value) {
                $('.all_mental_forms').append(
                    `<option value="${value.id}">${value.template_name}</option>`
                )
            });
        }
    });

    //Assigned Forms
    $.ajax({
        type : "POST",
        url: "{{route('superadmin.assigned.forms')}}",
        data : {
            '_token' : "{{csrf_token()}}",
            'type' : 'mental'
        },
        success:function(data){
            $('.assigned_mental_forms').empty();
            $.each(data,function (index,value) {
                $('.assigned_mental_forms').append(
                    `<option value="${value.template_id}">${value.template_name}</option>`
                )
            });
        }
    });
}

show_all_mental_forms();


//Speech Forms


$('.add_speech_forms').click(function () {
    var speech_forms = $('.all_speech_forms').val();
    $.ajax({
        type : "POST",
        url: "{{route('superadmin.save.forms')}}",
        data : {
            '_token' : "{{csrf_token()}}",
            'forms' : speech_forms,
            'type':'speech'
        },
        success:function(data){
            show_all_speech_forms();
            if (data == 'done'){
                toastr["success"]("Form assigned successfully!", 'SUCCESS!');
            }
            else if(data=="some_applied"){
                toastr["error"]("Some of selected forms are already assigned!", 'ERROR!');
            }
            else if(data=="some_not_found"){
                toastr["error"]("Some of selected form templates are not found!", 'ERROR!');
            }
        }
    });


});

$('.remove_speech_forms').click(function () {
    var ass_speech_forms = $('.assigned_speech_forms').val();
    $.ajax({
        type : "POST",
        url: "{{route('superadmin.remove.forms')}}",
        data : {
            '_token' : "{{csrf_token()}}",
            'forms' : ass_speech_forms,
        },
        success:function(data){
            show_all_speech_forms();
            if (data == 'done'){
                toastr["success"]("Forms removed successfully!", 'SUCCESS!');
            }
        }
    });


});


function show_all_speech_forms(){

    //Available forms
    $.ajax({
        type : "POST",
        url: "{{route('superadmin.available.forms')}}",
        data : {
            '_token' : "{{csrf_token()}}",
            'type' : 'speech'
        },
        success:function(data){
            $('.all_speech_forms').empty();
            $.each(data,function (index,value) {
                $('.all_speech_forms').append(
                    `<option value="${value.id}">${value.template_name}</option>`
                )
            });
        }
    });

    //Assigned Forms
    $.ajax({
        type : "POST",
        url: "{{route('superadmin.assigned.forms')}}",
        data : {
            '_token' : "{{csrf_token()}}",
            'type' : 'speech'
        },
        success:function(data){
            $('.assigned_speech_forms').empty();
            $.each(data,function (index,value) {
                $('.assigned_speech_forms').append(
                    `<option value="${value.template_id}">${value.template_name}</option>`
                )
            });
        }
    });
}

show_all_speech_forms();








</script>

@endsection