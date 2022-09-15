var max = 1;
var max1 = 1;


$('#addPhoneClient').click(function () {
    max++;
    $('.addclientphone').append(
        `
                <div class="removephondiv">
    <h6 class="font-weight-bold">Phone<i class="ri-question-line" title="If you want to send this client text or voice reminders, add their phone number(s)."></i><span class="text-danger"></span></h6>
    <div class="row no-gutters">
        <div class="col-md-5 mb-2">
            <input type="tel" class="form-control form-control-sm phone_appned" id="phone" name="new_phone_number[]"  >
            <input type="hidden" class="form-control form-control-sm" value="0" name="client_phone_edit[]">
        </div>
        <div class="col-md-3 pl-1 mb-2">
            <select class="form-control form-control-sm" name="new_phone_type[]" >
                <option value="Work"  >Work</option>
                <option value="Mobile" >Mobile</option>
                <option value="Home">Home</option>
                <option value="Fax" >Fax</option>
            </select>
        </div>
        <div class="col-md-4 pl-1 mb-2">
            <button class="btn btn-sm btn-danger removephn" type="button" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>

        </div>
        <div class="col-md-12">
            <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" id="v_msgnew${max}" value="1" name="new_is_send_sms[]" >Voice message ok
                </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" id="t_msgnew${max}" value="1" name="new_is_voice_sms[]" >Text message ok
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input">Send text/voice appointment reminders
                </label>
            </div>

        </div>
    </div>
                </div>


                `
    );


    $('.phone_appned').mask('(000)-000-0000');
    $('.phone_appned').pattern = ".{14,}";


    $('.removephn').click(function () {
        $(this).closest('.removephondiv').remove();
        return false;
    })

});


//client add email
$('#addEmailClient').click(function () {
    max1++;
    $('.emailsection').append(
        `
                            <div class="removeemaildiv">
                              <h6 class="font-weight-bold">Email<i class="ri-question-line" title="If you want to send this client email reminders or billing documents, and to grant them Client Portal access, add their email address."></i><span class="text-danger"></span></h6>
    <div class="row no-gutters">
        <div class="col-md-5 mb-2">
            <input type="email" class="form-control form-control-sm" name="new_email[]" >
            <input type="hidden" class="form-control form-control-sm" name="edit_email_id[]">
        </div>
        <div class="col-md-3 pl-1 mb-2">
            <select class="form-control form-control-sm" name="new_email_type[]" >
                 <option value="Mobile" >Mobile</option>
                 <option value="Home" >Home</option>
                 <option value="Fax" >Fax</option>
            </select>
        </div>
        <div class="col-md-4 pl-1 mb-2">
            <button class="btn btn-sm btn-danger removeem" type="button" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>


        </div>
        <div class="col-md-12 mb-2">
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" id="t_msgnewemok${max}" name="new_is_email_ok" value="1">Email ok
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" id="t_msgnew${max}" name="new_email_reminder[]" value="1">Send email appointment reminders
                </label>
            </div>

        </div>
    </div>
                           </div>

                `
    );


    $('.removeem').click(function () {
        $(this).closest('.removeemaildiv').remove();
        return false;
    })
});


//client address
$('#addAddressClient').click(function () {
    max1++;
    $('.addresssection').append(
        `
     <div class="removeaddressdiv row">
         <h6 class="font-weight-bold">Address<i class="ri-question-line" title="Required for insurance billing—please use the client’s address they have on file with their insurance provider"></i>
        <span class="text-danger">*</span>
    </h6>
    <div class="row no-gutters">
        <div class="col-md-8 mb-2">
            <input type="text" class="form-control form-control-sm" placeholder="Street" name="street[]" required>
              <input type="hidden" class="form-control form-control-sm"  name="address_edit_id[]" >
        </div>
        <div class="col-md-4 pl-2 mb-2">
            <button class="btn btn-sm btn-danger removadd" type="button" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>


        </div>
        <div class="col-md-10 mb-2">
            <input type="text" class="form-control form-control-sm" placeholder="City" name="city[]" required>
        </div>
        <div class="col-md-6 mb-2 pr-2">
           <select placeholder="State" name="state[]" class="form-control form-control-sm" required>
                    <optgroup label="-US">

                        <option value="AL">AL</option>
                        <option value="AK">AK</option>
                        <option value="AZ">AZ</option>
                        <option value="AR">AR</option>
                        <option value="CA">CA</option>
                        <option value="CO">CO</option>
                        <option value="CT">CT</option>
                        <option value="DE">DE</option>
                        <option value="DC">DC</option>
                        <option value="FL">FL</option>
                        <option value="GA">GA</option>
                        <option value="HI">HI</option>
                        <option value="ID">ID</option>
                        <option value="IL">IL</option>
                        <option value="IN">IN</option>
                        <option value="IA">IA</option>
                        <option value="KS">KS</option>
                        <option value="KY">KY</option>
                        <option value="LA">LA</option>
                        <option value="ME">ME</option>
                        <option value="MD">MD</option>
                        <option value="MA">MA</option>
                        <option value="MI">MI</option>
                        <option value="MN">MN</option>
                        <option value="MS">MS</option>
                        <option value="MO">MO</option>
                        <option value="MT">MT</option>
                        <option value="NE">NE</option>
                        <option value="NV">NV</option>
                        <option value="NH">NH</option>
                        <option value="NJ">NJ</option>
                        <option value="NM">NM</option>
                        <option value="NY">NY</option>
                        <option value="NC">NC</option>
                        <option value="ND">ND</option>
                        <option value="OH">OH</option>
                        <option value="OK">OK</option>
                        <option value="OR">OR</option>
                        <option value="PA">PA</option>
                        <option value="PR">PR</option>
                        <option value="RI">RI</option>
                        <option value="SC">SC</option>
                        <option value="SD">SD</option>
                        <option value="TN">TN</option>
                        <option value="TX">TX</option>
                        <option value="UT">UT</option>
                        <option value="VT">VT</option>
                        <option value="VA">VA</option>
                        <option value="WA">WA</option>
                        <option value="WV">WV</option>
                        <option value="WI">WI</option>
                        <option value="WY">WY</option>
                        <option value="AA">AA</option>
                        <option value="AE">AE</option>
                        <option value="AP">AP</option>
                        <option value="GU">GU</option>
                        <option value="VI">VI</option>
                    </optgroup>
                    <optgroup label="-CA-">
                        <option value="AB">AB</option>
                        <option value="BC">BC</option>
                        <option value="MB">MB</option>
                        <option value="NB">NB</option>
                        <option value="NL">NL</option>
                        <option value="NT">NT</option>
                        <option value="NS">NS</option>
                        <option value="NU">NU</option>
                        <option value="ON">ON</option>
                        <option value="PE">PE</option>
                        <option value="QC">QC</option>
                        <option value="SK">SK</option>
                        <option value="YT">YT</option>
                    </optgroup>
                    <optgroup label="-Other-">
                        <option value="">N/A</option>
                    </optgroup>
                </select>
        </div>
        <div class="col-md-4 mb-2">
            <input type="text" class="form-control form-control-sm" placeholder="Zip" name="zip[]" required>
        </div>





    </div>
</div>

                `
    );


    $('.removadd').click(function () {
        $(this).closest('.removeaddressdiv').remove();
        return false;
    })
});
