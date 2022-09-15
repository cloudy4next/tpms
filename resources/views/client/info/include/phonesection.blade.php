<div class="col-md-4 pr-2 pl-0">
    <h6 class="font-weight-bold">Phone<i class="ri-question-line"
                                         title="If you want to send this client text or voice reminders, add their phone number(s)."></i><span
            class="text-danger"></span></h6>
    <div class="row no-gutters">
        <div class="col-md-5 mb-2">
            <input type="tel" class="form-control form-control-sm" name="client_phone"
                   value="{{$client_id->phone_number}}" data-mask="(000)-000-0000" pattern=".{14,}">
        </div>
        <div class="col-md-4 pl-1 mb-2">
            <select class="form-control form-control-sm" name="phone_type">
                <option value="Work" {{$client_id->phone_type == 'Work' ? 'selected' :''}}>Work</option>
                <option value="Mobile" {{$client_id->phone_type == 'Cell' ? 'selected' :''}}>Cell</option>
                <option value="Home" {{$client_id->phone_type == 'Home' ? 'selected' :''}}>Home</option>
            </select>
        </div>
        <div class="col-md-3 pl-1 mb-2">

            <button type="button" class="btn btn-sm btn-primary" id="addPhoneClient" title="Add"><i
                    class="ri-add-line"></i></button>
        </div>
        <div class="col-md-12">
            <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" value="1"
                           name="is_voice_sms" {{$client_id->is_voice_sms == 1 ? 'checked' : ''}}>Voice message ok
                </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" value="1"
                           name="is_send_sms" {{$client_id->is_send_sms == 1 ? 'checked' : ''}}>Text message ok
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input">Send text/voice appointment reminders
                </label>
            </div>

        </div>
    </div>


    @foreach($phones as $phone)
        <div class="row no-gutters removeexistphondiv">
            <div class="col-md-12 pr-2 pl-0">

                <h6 class="font-weight-bold">Phone<i class="ri-question-line"
                                                     title="If you want to send this client text or voice reminders, add their phone number(s)."></i><span
                        class="text-danger">*</span></h6>
            </div>
            <div class="col-md-5 mb-2">
                <input type="tel" class="form-control form-control-sm" name="new_phone_number[]"
                       value="{{$phone->phone_number}}" data-mask="(000)-000-0000" pattern=".{14,}" required>
                <input type="hidden" class="form-control form-control-sm" name="client_phone_edit[]"
                       value="{{$phone->id}}">
            </div>
            <div class="col-md-4 pl-1 mb-2">
                <select class="form-control form-control-sm" name="new_phone_type[]" required>
                    <option value="Work" {{$phone->phone_type == 'Work' ? 'selected' :''}}>Work</option>
                    <option value="Mobile" {{$phone->phone_type == 'Cell' ? 'selected' :''}}>Cell</option>
                    <option value="Home" {{$phone->phone_type == 'Home' ? 'selected' :''}}>Home</option>
                </select>
            </div>
            <div class="col-md-3 pl-1 mb-2">
                <button class="btn btn-sm btn-danger existsphonedelete" id="" data-id="{{$phone->id}}" type="button"
                        title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </div>
            <div class="col-md-12">
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" value="1"
                               name="new_is_voice_sms[]" {{$phone->is_voice_sms == 1 ? 'checked' : ''}}>Voice message ok
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" value="1"
                               name="new_is_send_sms[]" {{$phone->is_send_sms == 1 ? 'checked' : ''}}>Text message ok
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input">Send text/voice appointment reminders
                    </label>
                </div>

            </div>
        </div>
    @endforeach

    <div class="addclientphone"></div>


</div>







