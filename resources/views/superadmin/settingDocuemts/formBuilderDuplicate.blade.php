@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-flex justify-content-between">
                <div class="align-self-center">
                    <h2 class="common-title">Create New Form</h2>
                </div>
                <div class="align-self-center">
                    <a href="{{route('superadmin.setting.forms.builder')}}" class="btn btn-sm btn-primary mb-3"><i
                            class="ri-arrow-left-circle-line"></i>Back</a>
                </div>
            </div>
            <form action="{{route('superadmin.setting.forms.builder.save')}}" method="post"
                  enctype="multipart/form-data" id="buildeform">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label>Enter form title:</label>
                        <input type="text" id="form_title" class="form-control form-control-sm" placeholder="Enter form title">
                    </div>
                    <div class="col-md-3">
                        <label>Select form type:</label>
                        <select class="form-control form-control-sm" id="form_type">
                            <option value="behavior" {{$type=='behavior'?'selected':''}}>Behavior</option>
                            <option value="speech" {{$type=='speech'?'selected':''}}>Speech</option>
                            <option value="mental" {{$type=='mental'?'selected':''}}>Mental</option>
                        </select>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3"></div>
                </div>

                <div id="build-wrap"></div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
    <script>
        data=<?php echo $data;?>;
        id="{{$id}}";

        jQuery(function ($) {
            var fbEditor = document.getElementById('build-wrap');
            var formBuilder= $(fbEditor).formBuilder().promise.then(formBuilder => {
                formBuilder.actions.setData(data);
                $(document).on('click', '.save-template', function () {

                    var htmldata = formBuilder.actions.getData('json');
                    const result = formBuilder.actions.save();
                    form_title=$('#form_title').val();
                    form_type=$('#form_type option:selected').val();
                    if(form_title==''){
                         toastr["error"]("Form title is not added.", 'Error!');
                    }
                    else{
                        $.ajax({
                            type: "POST",
                            url: "{{ route('superadmin.setting.forms.builder.duplicate.save') }}",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'formHtml': htmldata,
                                'form_title':form_title,
                                'form_type':form_type,
                                'id':id
                            },
                            success: function (data) {
                                if(data=='success'){
                                    window.location.href = "{{route('superadmin.setting.forms.builder')}}";
                                }
                                else if(data=="title"){
                                    toastr["error"]("Title already assigned",'Error!');
                                }
                                //console.log(data)
                                $('.loading2').hide();
                            }
                        });
                    }


                })
            });




        });


    </script>



@endsection

