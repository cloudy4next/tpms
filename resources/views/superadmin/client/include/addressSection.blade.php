

<div class="col-md-4 pr-0">
    <h6 class="font-weight-bold">Address<i class="ri-question-line" title="Required for insurance billing—please use the client’s address they have on file with their insurance provider"></i>
        <span class="text-danger">*</span>
    </h6>
    <div class="row no-gutters">
        <div class="col-md-8 mb-2">
            <input type="text" class="form-control form-control-sm street {{ $errors->has('client_street') ? ' is-invalid' : '' }}" placeholder="Street" name="client_street" value="{{$client_id->client_street}}" required>
            @if ($errors->has('client_street'))
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('client_street') }}</strong>
            @endif
        </div>
        <div class="col-md-4 pl-2 mb-2">
            <button type="button" class="btn btn-sm btn-primary " id="addAddressClient" title="Add"><i class="ri-add-line"></i></button>
        </div>
        <div class="col-md-10 mb-2">
            <input type="text" class="form-control form-control-sm city {{ $errors->has('client_city') ? ' is-invalid' : '' }}" placeholder="City" name="client_city" value="{{$client_id->client_city}}" required>
            @if ($errors->has('client_city'))
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('client_city') }}</strong>
            @endif
        </div>
        <div class="col-md-6 mb-2 pr-2">
            <div class="ui-widget">
                <select class="form-control form-control-sm state {{ $errors->has('client_state') ? ' is-invalid' : '' }}" placeholder="State" name="client_state" required>
                    <optgroup label="-US">
                        <option value="0"></option>
                        <option value="AL" {{$client_id->client_state == "AL" ? 'selected' : ''}}>AL</option>
                        <option value="AK" {{$client_id->client_state == "AK" ? 'selected' : ''}}>AK</option>
                        <option value="AZ" {{$client_id->client_state == "AZ" ? 'selected' : ''}}>AZ</option>
                        <option value="AR" {{$client_id->client_state == "AR" ? 'selected' : ''}}>AR</option>
                        <option value="CA" {{$client_id->client_state == "CA" ? 'selected' : ''}}>CA</option>
                        <option value="CO" {{$client_id->client_state == "CO" ? 'selected' : ''}}>CO</option>
                        <option value="CT" {{$client_id->client_state == "CT" ? 'selected' : ''}}>CT</option>
                        <option value="DE" {{$client_id->client_state == "DE" ? 'selected' : ''}}>DE</option>
                        <option value="DC" {{$client_id->client_state == "DC" ? 'selected' : ''}}>DC</option>
                        <option value="FL" {{$client_id->client_state == "FL" ? 'selected' : ''}}>FL</option>
                        <option value="GA" {{$client_id->client_state == "GA" ? 'selected' : ''}}>GA</option>
                        <option value="HI" {{$client_id->client_state == "HI" ? 'selected' : ''}}>HI</option>
                        <option value="ID" {{$client_id->client_state == "ID" ? 'selected' : ''}}>ID</option>
                        <option value="IL" {{$client_id->client_state == "IL" ? 'selected' : ''}}>IL</option>
                        <option value="IN" {{$client_id->client_state == "IN" ? 'selected' : ''}}>IN</option>
                        <option value="IA" {{$client_id->client_state == "IA" ? 'selected' : ''}}>IA</option>
                        <option value="KS" {{$client_id->client_state == "KS" ? 'selected' : ''}}>KS</option>
                        <option value="KY" {{$client_id->client_state == "KY" ? 'selected' : ''}}>KY</option>
                        <option value="LA" {{$client_id->client_state == "LA" ? 'selected' : ''}}>LA</option>
                        <option value="ME" {{$client_id->client_state == "ME" ? 'selected' : ''}}>ME</option>
                        <option value="MD" {{$client_id->client_state == "MD" ? 'selected' : ''}}>MD</option>
                        <option value="MA" {{$client_id->client_state == "MA" ? 'selected' : ''}}>MA</option>
                        <option value="MI" {{$client_id->client_state == "MI" ? 'selected' : ''}}>MI</option>
                        <option value="MN" {{$client_id->client_state == "MN" ? 'selected' : ''}}>MN</option>
                        <option value="MS" {{$client_id->client_state == "MS" ? 'selected' : ''}}>MS</option>
                        <option value="MO" {{$client_id->client_state == "MO" ? 'selected' : ''}}>MO</option>
                        <option value="MT" {{$client_id->client_state == "MT" ? 'selected' : ''}}>MT</option>
                        <option value="NE" {{$client_id->client_state == "NE" ? 'selected' : ''}}>NE</option>
                        <option value="NV" {{$client_id->client_state == "NV" ? 'selected' : ''}}>NV</option>
                        <option value="NH" {{$client_id->client_state == "NH" ? 'selected' : ''}}>NH</option>
                        <option value="NJ" {{$client_id->client_state == "NJ" ? 'selected' : ''}}>NJ</option>
                        <option value="NM" {{$client_id->client_state == "NM" ? 'selected' : ''}}>NM</option>
                        <option value="NY" {{$client_id->client_state == "NY" ? 'selected' : ''}}>NY</option>
                        <option value="NC" {{$client_id->client_state == "NC" ? 'selected' : ''}}>NC</option>
                        <option value="ND" {{$client_id->client_state == "ND" ? 'selected' : ''}}>ND</option>
                        <option value="OH" {{$client_id->client_state == "OH" ? 'selected' : ''}}>OH</option>
                        <option value="OK" {{$client_id->client_state == "OK" ? 'selected' : ''}}>OK</option>
                        <option value="OR" {{$client_id->client_state == "OR" ? 'selected' : ''}}>OR</option>
                        <option value="PA" {{$client_id->client_state == "PA" ? 'selected' : ''}}>PA</option>
                        <option value="PR" {{$client_id->client_state == "PR" ? 'selected' : ''}}>PR</option>
                        <option value="RI" {{$client_id->client_state == "RI" ? 'selected' : ''}}>RI</option>
                        <option value="SC" {{$client_id->client_state == "SC" ? 'selected' : ''}}>SC</option>
                        <option value="SD" {{$client_id->client_state == "SD" ? 'selected' : ''}}>SD</option>
                        <option value="TN" {{$client_id->client_state == "TN" ? 'selected' : ''}}>TN</option>
                        <option value="TX" {{$client_id->client_state == "TX" ? 'selected' : ''}}>TX</option>
                        <option value="UT" {{$client_id->client_state == "UT" ? 'selected' : ''}}>UT</option>
                        <option value="VT" {{$client_id->client_state == "VT" ? 'selected' : ''}}>VT</option>
                        <option value="VA" {{$client_id->client_state == "VA" ? 'selected' : ''}}>VA</option>
                        <option value="WA" {{$client_id->client_state == "WA" ? 'selected' : ''}}>WA</option>
                        <option value="WV" {{$client_id->client_state == "WV" ? 'selected' : ''}}>WV</option>
                        <option value="WI" {{$client_id->client_state == "WI" ? 'selected' : ''}}>WI</option>
                        <option value="WY" {{$client_id->client_state == "WY" ? 'selected' : ''}}>WY</option>
                        <option value="AA" {{$client_id->client_state == "AA" ? 'selected' : ''}}>AA</option>
                        <option value="AE" {{$client_id->client_state == "AE" ? 'selected' : ''}}>AE</option>
                        <option value="AP" {{$client_id->client_state == "AP" ? 'selected' : ''}}>AP</option>
                        <option value="GU" {{$client_id->client_state == "GU" ? 'selected' : ''}}>GU</option>
                        <option value="VI" {{$client_id->client_state == "VI" ? 'selected' : ''}}>VI</option>
                    </optgroup>
                    <optgroup label="-CA-">
                        <option value="AB" {{$client_id->client_state == "AB" ? 'selected' : ''}}>AB</option>
                        <option value="BC" {{$client_id->client_state == "BC" ? 'selected' : ''}}>BC</option>
                        <option value="MB" {{$client_id->client_state == "MB" ? 'selected' : ''}}>MB</option>
                        <option value="NB" {{$client_id->client_state == "NB" ? 'selected' : ''}}>NB</option>
                        <option value="NL" {{$client_id->client_state == "NL" ? 'selected' : ''}}>NL</option>
                        <option value="NT" {{$client_id->client_state == "NT" ? 'selected' : ''}}>NT</option>
                        <option value="NS" {{$client_id->client_state == "NS" ? 'selected' : ''}}>NS</option>
                        <option value="NU" {{$client_id->client_state == "NU" ? 'selected' : ''}}>NU</option>
                        <option value="ON" {{$client_id->client_state == "ON" ? 'selected' : ''}}>ON</option>
                        <option value="PE" {{$client_id->client_state == "PE" ? 'selected' : ''}}>PE</option>
                        <option value="QC" {{$client_id->client_state == "QC" ? 'selected' : ''}}>QC</option>
                        <option value="SK" {{$client_id->client_state == "SK" ? 'selected' : ''}}>SK</option>
                        <option value="YT" {{$client_id->client_state == "YT" ? 'selected' : ''}}>YT</option>
                    </optgroup>
                    <optgroup label="-Other-">
                        <option value="0">N/A</option>
                    </optgroup>
                </select>
                @if ($errors->has('client_state'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('client_state') }}</strong>
                @endif
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <input type="text" class="form-control form-control-sm zip {{ $errors->has('client_zip') ? ' is-invalid' : '' }}" placeholder="Zip" name="client_zip" value="{{$client_id->client_zip}}" required>
            @if ($errors->has('client_zip'))
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('client_zip') }}</strong>
            @endif
        </div>





    </div>




    @foreach($address as $addres)
    <div class="row no-gutters existsaddresssection">
        <div class="col-md-12 pr-0">

            <h6 class="font-weight-bold">Address<i class="ri-question-line" title="Required for insurance billing—please use the client’s address they have on file with their insurance provider"></i>
                <span class="text-danger">*</span>
            </h6>        </div>
        <div class="col-md-8 mb-2">
            <input type="text" class="form-control form-control-sm" placeholder="Street" name="street[]" value="{{$addres->street}}" required>
            <input type="hidden" class="form-control form-control-sm" name="address_edit_id[]" value="{{$addres->id}}">
        </div>
        <div class="col-md-4 pl-2 mb-2">
            <button class="btn btn-sm btn-danger deleteexistsaddress" data-id="{{$addres->id}}" type="button" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
        </div>
        <div class="col-md-10 mb-2">
            <input type="text" class="form-control form-control-sm" placeholder="City" name="city[]" value="{{$addres->city}}" required>
        </div>
        <div class="col-md-6 mb-2 pr-2">
            <div class="ui-widget">
                <select placeholder="State" name="state[]" required>
                    <optgroup label="-US">
                        <option></option>
                        <option value="AL" {{$addres->state == 'AL' ? 'selected' : ''}}>AL</option>
                        <option value="AK" {{$addres->state == 'AK' ? 'selected' : ''}}>AK</option>
                        <option value="AZ" {{$addres->state == 'AZ' ? 'selected' : ''}}>AZ</option>
                        <option value="AR" {{$addres->state == 'AR' ? 'selected' : ''}}>AR</option>
                        <option value="CA" {{$addres->state == 'CA' ? 'selected' : ''}}>CA</option>
                        <option value="CO" {{$addres->state == 'CO' ? 'selected' : ''}}>CO</option>
                        <option value="CT" {{$addres->state == 'CT' ? 'selected' : ''}}>CT</option>
                        <option value="DE" {{$addres->state == 'DE' ? 'selected' : ''}}>DE</option>
                        <option value="DC" {{$addres->state == 'DC' ? 'selected' : ''}}>DC</option>
                        <option value="FL" {{$addres->state == 'FL' ? 'selected' : ''}}>FL</option>
                        <option value="GA" {{$addres->state == 'GA' ? 'selected' : ''}}>GA</option>
                        <option value="HI" {{$addres->state == 'HI' ? 'selected' : ''}}>HI</option>
                        <option value="ID" {{$addres->state == 'ID' ? 'selected' : ''}}>ID</option>
                        <option value="IL" {{$addres->state == 'IL' ? 'selected' : ''}}>IL</option>
                        <option value="IN" {{$addres->state == 'IN' ? 'selected' : ''}}>IN</option>
                        <option value="IA" {{$addres->state == 'IA' ? 'selected' : ''}}>IA</option>
                        <option value="KS" {{$addres->state == 'KS' ? 'selected' : ''}}>KS</option>
                        <option value="KY" {{$addres->state == 'KY' ? 'selected' : ''}}>KY</option>
                        <option value="LA" {{$addres->state == 'LA' ? 'selected' : ''}}>LA</option>
                        <option value="ME" {{$addres->state == 'ME' ? 'selected' : ''}}>ME</option>
                        <option value="MD" {{$addres->state == 'MD' ? 'selected' : ''}}>MD</option>
                        <option value="MA" {{$addres->state == 'MA' ? 'selected' : ''}}>MA</option>
                        <option value="MI" {{$addres->state == 'MI' ? 'selected' : ''}}>MI</option>
                        <option value="MN" {{$addres->state == 'MN' ? 'selected' : ''}}>MN</option>
                        <option value="MS" {{$addres->state == 'MS' ? 'selected' : ''}}>MS</option>
                        <option value="MO" {{$addres->state == 'MO' ? 'selected' : ''}}>MO</option>
                        <option value="MT" {{$addres->state == 'MT' ? 'selected' : ''}}>MT</option>
                        <option value="NE" {{$addres->state == 'NE' ? 'selected' : ''}}>NE</option>
                        <option value="NV" {{$addres->state == 'NV' ? 'selected' : ''}}>NV</option>
                        <option value="NH" {{$addres->state == 'NH' ? 'selected' : ''}}>NH</option>
                        <option value="NJ" {{$addres->state == 'NJ' ? 'selected' : ''}}>NJ</option>
                        <option value="NM" {{$addres->state == 'NM' ? 'selected' : ''}}>NM</option>
                        <option value="NY" {{$addres->state == 'NY' ? 'selected' : ''}}>NY</option>
                        <option value="NC" {{$addres->state == 'NC' ? 'selected' : ''}}>NC</option>
                        <option value="ND" {{$addres->state == 'ND' ? 'selected' : ''}}>ND</option>
                        <option value="OH" {{$addres->state == 'OH' ? 'selected' : ''}}>OH</option>
                        <option value="OK" {{$addres->state == 'OK' ? 'selected' : ''}}>OK</option>
                        <option value="OR" {{$addres->state == 'OR' ? 'selected' : ''}}>OR</option>
                        <option value="PA" {{$addres->state == 'PA' ? 'selected' : ''}}>PA</option>
                        <option value="PR" {{$addres->state == 'PR' ? 'selected' : ''}}>PR</option>
                        <option value="RI" {{$addres->state == 'RI' ? 'selected' : ''}}>RI</option>
                        <option value="SC" {{$addres->state == 'SC' ? 'selected' : ''}}>SC</option>
                        <option value="SD" {{$addres->state == 'SD' ? 'selected' : ''}}>SD</option>
                        <option value="TN" {{$addres->state == 'TN' ? 'selected' : ''}}>TN</option>
                        <option value="TX" {{$addres->state == 'TX' ? 'selected' : ''}}>TX</option>
                        <option value="UT" {{$addres->state == 'UT' ? 'selected' : ''}}>UT</option>
                        <option value="VT" {{$addres->state == 'VT' ? 'selected' : ''}}>VT</option>
                        <option value="VA" {{$addres->state == 'VA' ? 'selected' : ''}}>VA</option>
                        <option value="WA" {{$addres->state == 'WA' ? 'selected' : ''}}>WA</option>
                        <option value="WV" {{$addres->state == 'WV' ? 'selected' : ''}}>WV</option>
                        <option value="WI" {{$addres->state == 'WI' ? 'selected' : ''}}>WI</option>
                        <option value="WY" {{$addres->state == 'WY' ? 'selected' : ''}}>WY</option>
                        <option value="AA" {{$addres->state == 'AA' ? 'selected' : ''}}>AA</option>
                        <option value="AE" {{$addres->state == 'AE' ? 'selected' : ''}}>AE</option>
                        <option value="AP" {{$addres->state == 'AP' ? 'selected' : ''}}>AP</option>
                        <option value="GU" {{$addres->state == 'GU' ? 'selected' : ''}}>GU</option>
                        <option value="VI" {{$addres->state == 'VI' ? 'selected' : ''}}>VI</option>
                    </optgroup>
                    <optgroup label="-CA-">
                        <option value="AB" {{$addres->state == 'AB' ? 'selected' : ''}}>AB</option>
                        <option value="BC" {{$addres->state == 'BC' ? 'selected' : ''}}>BC</option>
                        <option value="MB" {{$addres->state == 'MB' ? 'selected' : ''}}>MB</option>
                        <option value="NB" {{$addres->state == 'NB' ? 'selected' : ''}}>NB</option>
                        <option value="NL" {{$addres->state == 'NL' ? 'selected' : ''}}>NL</option>
                        <option value="NT" {{$addres->state == 'NT' ? 'selected' : ''}}>NT</option>
                        <option value="NS" {{$addres->state == 'NS' ? 'selected' : ''}}>NS</option>
                        <option value="NU" {{$addres->state == 'NU' ? 'selected' : ''}}>NU</option>
                        <option value="ON" {{$addres->state == 'ON' ? 'selected' : ''}}>ON</option>
                        <option value="PE" {{$addres->state == 'PE' ? 'selected' : ''}}>PE</option>
                        <option value="QC" {{$addres->state == 'QC' ? 'selected' : ''}}>QC</option>
                        <option value="SK" {{$addres->state == 'SK' ? 'selected' : ''}}>SK</option>
                        <option value="YT" {{$addres->state == 'YT' ? 'selected' : ''}}>YT</option>
                    </optgroup>
                    <optgroup label="-Other-">
                        <option value="">N/A</option>
                    </optgroup>
                </select>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <input type="text" class="form-control form-control-sm" placeholder="Zip" name="zip[]" value="{{$addres->zip}}" required>
        </div>





    </div>
    @endforeach




    <div class="col-md-12 addresssection"></div>

{{--    <div class="row no-gutters">--}}
{{--        <div class="col-md-6 mb-2 pr-2">--}}
{{--            <h6 class="font-weight-bold">Location<i class="ri-question-line" title="The default office location where this client will typically be seen."></i><span class="text-danger">*</span></h6>--}}
{{--            <select class="form-control form-control-sm" name="location">--}}
{{--                <option value="Main Office" {{$client_id->location == "Main Office" ? 'selected' : ''}}>Main Office</option>--}}
{{--                <option value="Telehealth" {{$client_id->location == "Telehealth" ? 'selected' : ''}}>Telehealth</option>--}}
{{--                <option value="Home" {{$client_id->location == "Home" ? 'selected' : ''}}>Home</option>--}}
{{--            </select>--}}
{{--        </div>--}}
{{--        <div class="col-md-6 mb-2">--}}
{{--            <h6 class="font-weight-bold">Zone<i class="ri-question-line" title="The default office location where this client will typically be seen."></i><span class="text-danger">*</span></h6>--}}
{{--            <select class="form-control form-control-sm" name="zone">--}}
{{--                <option value="All Zone" {{$client_id->zone == "All Zone" ? 'selected' : ''}}>All Zone</option>--}}
{{--                @foreach($all_zone as $zone)--}}
{{--                <option value="{{$zone->name}}" {{$client_id->zone == $zone->name ? 'selected' : ''}}>{{$zone->name}}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}
{{--    </div>--}}



    <div class="row no-gutters">
        <div class="col-md-6 mb-2 pr-2">
            <h6 class="font-weight-bold">POS<i class="ri-question-line" title="The default office location where this client will typically be seen."></i><span class="text-danger">*</span></h6>
            <select class="form-control form-control-sm" name="location">
                <option value="Main Office" {{$client_id->location == "Main Office" ? 'selected' : ''}}>Main Office</option>
                <option value="Telehealth" {{$client_id->location == "Telehealth" ? 'selected' : ''}}>Telehealth</option>
                <option value="Home" {{$client_id->location == "Home" ? 'selected' : ''}}>Home</option>
            </select>
        </div>
        <div class="col-md-4 mb-2">
            <h6 class="font-weight-bold">Region<i class="ri-question-line" title="The default office location where this client will typically be seen."></i><span class="text-danger">*</span></h6>
            <select class="form-control form-control-sm" name="zone">
                @foreach($box_32 as $zone)
                <option value="{{$zone->id}}" {{$client_id->zone == $zone->id ? 'selected' : ''}}>{{$zone->zone_name}}</option>
                @endforeach

            </select>
        </div>
    </div>




</div>





