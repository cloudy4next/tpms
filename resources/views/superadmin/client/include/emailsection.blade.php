<div class="col-md-4 pr-0 pl-0">
    <h6 class="font-weight-bold">Email<i class="ri-question-line"
                                         title="If you want to send this client email reminders or billing documents, and to grant them Client Portal access, add their email address."></i><span
            class="text-danger"></span></h6>
    <div class="row no-gutters">
        <div class="col-md-6 mb-2">
            <input type="email" class="form-control form-control-sm" name="client_email" value="{{$client_id->email}}">
        </div>
        <div class="col-md-3 pl-1 mb-2">
            <select class="form-control form-control-sm" name="client_email_type">
                <option value="Work" {{$client_id->email_type == 'Work' ? 'selected' : ''}}>Work</option>
                <option value="Home" {{$client_id->email_type == 'Home' ? 'selected' : ''}}>Home</option>
            </select>
        </div>
        <div class="col-md-3 pl-1 mb-2">

            <button type="button" class="btn btn-sm btn-primary" id="addEmailClient" title="Add"><i
                    class="ri-add-line"></i></button>

        </div>
        <div class="col-md-12 mb-2">
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="is_email_ok"
                           value="1" {{$client_id->is_email_ok == 1 ? 'checked' : ''}}>Email ok
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" value="1"
                           name="email_reminder" {{$client_id->email_reminder == 1 ? 'checked' : ''}}>Send email
                    appointment reminders
                </label>
            </div>

        </div>
    </div>


    @foreach($emails as $email)
        <div class="row no-gutters existsemailsection">
            <div class="col-md-12 pr-0 pl-0">

                <h6 class="font-weight-bold">Email<i class="ri-question-line"
                                                     title="If you want to send this client email reminders or billing documents, and to grant them Client Portal access, add their email address."></i><span
                        class="text-danger">*</span></h6>
            </div>
            <div class="col-md-6 mb-2">
                <input type="email" class="form-control form-control-sm" name="new_email[]" value="{{$email->email}}"
                       required>
                <input type="hidden" class="form-control form-control-sm" name="edit_email_id[]" value="{{$email->id}}">
            </div>
            <div class="col-md-3 pl-1 mb-2">
                <select class="form-control form-control-sm" name="new_email_type[]" required>
                    <option value="Work" {{$email->email_type == 'Work' ? 'selected' : ''}}>Work</option>
                    <option value="Home" {{$email->email_type == 'Home' ? 'selected' : ''}}>Home</option>
                </select>
            </div>
            <div class="col-md-3 pl-1 mb-2">
                <button class="btn btn-sm btn-danger deleteexistsemail" data-id="{{$email->id}}" type="button"
                        title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>

            </div>
            <div class="col-md-12 mb-2">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="new_is_email_ok"
                               value="1" {{$email->is_email_ok == 1 ? 'checked' : ''}}>Email ok
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" value="1"
                               name="new_email_reminder[]" {{$email->email_reminder == 1 ? 'checked' : ''}}>Send email
                        appointment reminders
                    </label>
                </div>

            </div>
        </div>
    @endforeach


    <div class="emailsection"></div>


</div>





