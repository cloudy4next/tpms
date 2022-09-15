<div class="col-md-12">
    <hr class="mt-0 mb-2">
    <div class="form-check mb-2">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input is_gran" id="checkg" name="is_guarantor" value="1" {{$client_info->is_guarantor == 1 ? 'checked' : ''}}>Is Guarantor Available?
        </label>
    </div>
    <div id="showg" class="client_gran_info">
        <h6 class="font-weight-bold">Guarantor Info</h6>
        <div class="row">
            <div class="col-md-3 mb-2">
                <label>First Name</label>
                <input type="text" class="form-control form-control-sm" name="guarantor_first_name" value="{{$garanter_info->guarantor_first_name}}">
            </div>
            <div class="col-md-3 mb-2">
                <label>Last Name</label>
                <input type="text" class="form-control form-control-sm" name="guarantor_last_name" value="{{$garanter_info->guarantor_last_name}}">
            </div>
            <div class="col-md-3 mb-2">
                <label>DOB</label>
                <input type="date" class="form-control form-control-sm" name="guarantor_dob" value="{{$garanter_info->guarantor_dob}}">
            </div>

            <div class="col-md-12">
                <h6 class="font-weight-bold mb-2">Address<i class="ri-question-line" title="Required for insurance billing—please use the client’s address they have on file with their insurance provider"></i></h6>
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <input type="text" class="form-control form-control-sm gstreet" name="g_street" value="{{$garanter_info->g_street}}" placeholder="Street">
                    </div>
                    <div class="col-md-9 mb-2">
                        <button type="button" class="btn btn-sm btn-secondary" id="save_client_address">Same as Patient Address</button>
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="text" class="form-control form-control-sm g_city" name="g_city" value="{{$garanter_info->g_city}}" placeholder="City">
                    </div>
                    <div class="col-md-2 mb-2 ">
                        <select class="g_state form-control form-control-sm" name="g_state" placeholder="State">
                            <optgroup label="-US">
                                <option></option>
                                <option value="AL" {{$garanter_info->g_state == 'AL' ? 'selected' : ''}}>AL</option>
                                <option value="AK" {{$garanter_info->g_state == 'AK' ? 'selected' : ''}}>AK</option>
                                <option value="AZ" {{$garanter_info->g_state == 'AZ' ? 'selected' : ''}}>AZ</option>
                                <option value="AR" {{$garanter_info->g_state == 'AR' ? 'selected' : ''}}>AR</option>
                                <option value="CA" {{$garanter_info->g_state == 'CA' ? 'selected' : ''}}>CA</option>
                                <option value="CO" {{$garanter_info->g_state == 'CO' ? 'selected' : ''}}>CO</option>
                                <option value="CT" {{$garanter_info->g_state == 'CT' ? 'selected' : ''}}>CT</option>
                                <option value="DE" {{$garanter_info->g_state == 'DE' ? 'selected' : ''}}>DE</option>
                                <option value="DC" {{$garanter_info->g_state == 'DC' ? 'selected' : ''}}>DC</option>
                                <option value="FL" {{$garanter_info->g_state == 'FL' ? 'selected' : ''}}>FL</option>
                                <option value="GA" {{$garanter_info->g_state == 'GA' ? 'selected' : ''}}>GA</option>
                                <option value="HI" {{$garanter_info->g_state == 'HI' ? 'selected' : ''}}>HI</option>
                                <option value="ID" {{$garanter_info->g_state == 'ID' ? 'selected' : ''}}>ID</option>
                                <option value="IL" {{$garanter_info->g_state == 'IL' ? 'selected' : ''}}>IL</option>
                                <option value="IN" {{$garanter_info->g_state == 'IN' ? 'selected' : ''}}>IN</option>
                                <option value="IA" {{$garanter_info->g_state == 'IA' ? 'selected' : ''}}>IA</option>
                                <option value="KS" {{$garanter_info->g_state == 'KS' ? 'selected' : ''}}>KS</option>
                                <option value="KY" {{$garanter_info->g_state == 'KY' ? 'selected' : ''}}>KY</option>
                                <option value="LA" {{$garanter_info->g_state == 'LA' ? 'selected' : ''}}>LA</option>
                                <option value="ME" {{$garanter_info->g_state == 'ME' ? 'selected' : ''}}>ME</option>
                                <option value="MD" {{$garanter_info->g_state == 'MD' ? 'selected' : ''}}>MD</option>
                                <option value="MA" {{$garanter_info->g_state == 'MA' ? 'selected' : ''}}>MA</option>
                                <option value="MI" {{$garanter_info->g_state == 'MI' ? 'selected' : ''}}>MI</option>
                                <option value="MN" {{$garanter_info->g_state == 'MN' ? 'selected' : ''}}>MN</option>
                                <option value="MS" {{$garanter_info->g_state == 'MS' ? 'selected' : ''}}>MS</option>
                                <option value="MO" {{$garanter_info->g_state == 'MO' ? 'selected' : ''}}>MO</option>
                                <option value="MT" {{$garanter_info->g_state == 'MT' ? 'selected' : ''}}>MT</option>
                                <option value="NE" {{$garanter_info->g_state == 'NE' ? 'selected' : ''}}>NE</option>
                                <option value="NV" {{$garanter_info->g_state == 'NV' ? 'selected' : ''}}>NV</option>
                                <option value="NH" {{$garanter_info->g_state == 'NH' ? 'selected' : ''}}>NH</option>
                                <option value="NJ" {{$garanter_info->g_state == 'NJ' ? 'selected' : ''}}>NJ</option>
                                <option value="NM" {{$garanter_info->g_state == 'NM' ? 'selected' : ''}}>NM</option>
                                <option value="NY" {{$garanter_info->g_state == 'NY' ? 'selected' : ''}}>NY</option>
                                <option value="NC" {{$garanter_info->g_state == 'NC' ? 'selected' : ''}}>NC</option>
                                <option value="ND" {{$garanter_info->g_state == 'ND' ? 'selected' : ''}}>ND</option>
                                <option value="OH" {{$garanter_info->g_state == 'OH' ? 'selected' : ''}}>OH</option>
                                <option value="OK" {{$garanter_info->g_state == 'OK' ? 'selected' : ''}}>OK</option>
                                <option value="OR" {{$garanter_info->g_state == 'OR' ? 'selected' : ''}}>OR</option>
                                <option value="PA" {{$garanter_info->g_state == 'PA' ? 'selected' : ''}}>PA</option>
                                <option value="PR" {{$garanter_info->g_state == 'PR' ? 'selected' : ''}}>PR</option>
                                <option value="RI" {{$garanter_info->g_state == 'RI' ? 'selected' : ''}}>RI</option>
                                <option value="SC" {{$garanter_info->g_state == 'SC' ? 'selected' : ''}}>SC</option>
                                <option value="SD" {{$garanter_info->g_state == 'SD' ? 'selected' : ''}}>SD</option>
                                <option value="TN" {{$garanter_info->g_state == 'TN' ? 'selected' : ''}}>TN</option>
                                <option value="TX" {{$garanter_info->g_state == 'TX' ? 'selected' : ''}}>TX</option>
                                <option value="UT" {{$garanter_info->g_state == 'UT' ? 'selected' : ''}}>UT</option>
                                <option value="VT" {{$garanter_info->g_state == 'VT' ? 'selected' : ''}}>VT</option>
                                <option value="VA" {{$garanter_info->g_state == 'VA' ? 'selected' : ''}}>VA</option>
                                <option value="WA" {{$garanter_info->g_state == 'WA' ? 'selected' : ''}}>WA</option>
                                <option value="WV" {{$garanter_info->g_state == 'WV' ? 'selected' : ''}}>WV</option>
                                <option value="WI" {{$garanter_info->g_state == 'WI' ? 'selected' : ''}}>WI</option>
                                <option value="WY" {{$garanter_info->g_state == 'WY' ? 'selected' : ''}}>WY</option>
                                <option value="AA" {{$garanter_info->g_state == 'AA' ? 'selected' : ''}}>AA</option>
                                <option value="AE" {{$garanter_info->g_state == 'AE' ? 'selected' : ''}}>AE</option>
                                <option value="AP" {{$garanter_info->g_state == 'AP' ? 'selected' : ''}}>AP</option>
                                <option value="GU" {{$garanter_info->g_state == 'GU' ? 'selected' : ''}}>GU</option>
                                <option value="VI" {{$garanter_info->g_state == 'VI' ? 'selected' : ''}}>VI</option>
                            </optgroup>
                            <optgroup label="-CA-">
                                <option value="AB" {{$garanter_info->g_state == 'AB' ? 'selected' : ''}}>AB</option>
                                <option value="BC" {{$garanter_info->g_state == 'BC' ? 'selected' : ''}}>BC</option>
                                <option value="MB" {{$garanter_info->g_state == 'MB' ? 'selected' : ''}}>MB</option>
                                <option value="NB" {{$garanter_info->g_state == 'NB' ? 'selected' : ''}}>NB</option>
                                <option value="NL" {{$garanter_info->g_state == 'NL' ? 'selected' : ''}}>NL</option>
                                <option value="NT" {{$garanter_info->g_state == 'NT' ? 'selected' : ''}}>NT</option>
                                <option value="NS" {{$garanter_info->g_state == 'NS' ? 'selected' : ''}}>NS</option>
                                <option value="NU" {{$garanter_info->g_state == 'NU' ? 'selected' : ''}}>NU</option>
                                <option value="ON" {{$garanter_info->g_state == 'ON' ? 'selected' : ''}}>ON</option>
                                <option value="PE" {{$garanter_info->g_state == 'PE' ? 'selected' : ''}}>PE</option>
                                <option value="QC" {{$garanter_info->g_state == 'QC' ? 'selected' : ''}}>QC</option>
                                <option value="SK" {{$garanter_info->g_state == 'SK' ? 'selected' : ''}}>SK</option>
                                <option value="YT" {{$garanter_info->g_state == 'YT' ? 'selected' : ''}}>YT</option>
                            </optgroup>
                            <optgroup label="-Other-">
                                <option value="">N/A</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <input type="text" class="form-control form-control-sm g_zip" name="g_zip" value="{{$garanter_info->g_zip}}" placeholder="Zip">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
