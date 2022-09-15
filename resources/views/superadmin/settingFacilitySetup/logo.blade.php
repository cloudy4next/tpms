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
                    <form action="{{route('superadmin.setting.logo.update')}}" method="post"
                          enctype="multipart/form-data" id="logo_update_form">
                        @csrf
                        <div class="d-flex">
                            <div>
                                <label>Browse Logo</label>
                                <input type="file" class="form-control-file" name="logo" id="fileupimg">
                            </div>
                            <div class="align-self-end">
                                <button type="button" class="btn btn-sm btn-primary mr-3" id="upload_btn">Upload</button>
                                <button type="button" class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="preview-sig">
                                    <button type="button" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    @if (!empty($logo->logo) && file_exists($logo->logo))
                                        <img src="{{asset($logo->logo)}}"
                                             id="wizardPicturePreview" class="img-fluid"
                                             width="70"
                                             alt="therapypm">
                                    @else
                                        <img src="{{asset('assets/dashboard/')}}/images/client/contact.png"
                                             id="wizardPicturePreview" class="img-fluid"
                                             width="70"
                                             alt="therapypm">
                                    @endif

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {

            var check=true;
            $("#fileupimg").change(function () {
                $('#wizardPicturePreview').attr('src', '');
                readURL(this);
            });

            $('#upload_btn').click(function(){
                if(check==true){
                    $('#logo_update_form').submit();
                }
                else{
                    toastr["error"]("Upload image in jpeg, jpg or png.");
                }
            })

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var extension = input.files[0].name.split('.').pop().toLowerCase();
                    if(extension == 'png' || extension == 'jpg' || extension == 'jpeg'){
                        check=true;
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('#wizardPicturePreview').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                    else{
                        check=false;
                        toastr["error"]("Upload image in jpeg, jpg or png.");
                    }
                }
            }

        })
    </script>
@endsection
