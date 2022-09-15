@foreach($bill_data as $data)
    <tr id="row_{{$data->id}}" s-prevent="2">

        <input type="hidden" class="s_id" value="{{$data->id}}">
        <input type="hidden" class="s_insurance" value="">
        <input type="hidden" class="s_client_id" value="{{$data->client_id}}">
        <input type="hidden" class="s_schedule_date" value="{{$data->schedule_date}}">
        <input type="hidden" class="s_provider_id" value="{{$data->provider_id}}">
        <input type="hidden" class="s_activity_id" value="{{$data->activity_id}}">
        <input type="hidden" class="s_hours" value="{{$data->time_duration / 60}}">
        <input type="hidden" class="s_activity_type" value="{{$data->activity_type}}">
        <input type="hidden" class="s_cpt" value="{{$data->cpt}}">
        <input type="hidden" class="s_location" value="{{$data->location}}">
        <input type="hidden" class="s_m1" value="{{$data->m1}}">
        <input type="hidden" class="s_m2" value="{{$data->m2}}">
        <input type="hidden" class="s_m3" value="{{$data->m3}}">
        <input type="hidden" class="s_m4" value="{{$data->m4}}">
        <input type="hidden" class="s_unit"
               value="{{is_numeric($data->units)  ? number_format($data->units,2):$data->units}}">
        <input type="hidden" class="s_rate"
               value="{{is_numeric($data->rate) ? number_format($data->rate,2) : $data->rate}}">
        <input type="hidden" class="s_cms" value="{{$data->cms_24j}}">
        <input type="hidden" class="s_qual" value="{{$data->id_qualifier}}">
        <input type="hidden" class="s_status" value="{{$data->status}}">
        <input type="hidden" class="s_auth_id" value="{{$data->authorization_id}}">
        <td class="checkbox1_td" data-tableexport-display="none">
            <input type="checkbox" class="m-0 claim_checked" value="{{$data->id}}">
            <label></label>
        </td>
        <td class="">
            <?php
            $client = \App\Models\Client::where('id', $data->client_id)->first();
            ?>
            @if ($client)
                {{$client->client_first_name}} {{$client->client_middle}} {{$client->client_last_name}}
            @endif
        </td>
        <td class="s_date_td">  {{\Carbon\Carbon::parse($data->schedule_date)->format('m/d/Y')}}</td>
        <td class="s_pro_name_td">
            <?php
            $provider = \App\Models\Employee::where('id', $data->provider_id)->first();
            ?>
            @if ($provider)
                {{$provider->first_name}} {{$provider->middle_name}} {{$provider->last_name}}
            @endif
        </td>
        <td class="s_hours_td">
            <?php
            $activity = \App\Models\Client_authorization_activity::where('id', $data->activity_id)->first();
            $hours = $data->time_duration / 60;
            ?>
            {{--                {{$data->activity_type}} ({{$data->time_duration}} MIN)--}}
            {{$data->activity_type}} ({{number_format((float)$hours,2)}} Hrs)
        </td>

        <td data-tableexport-display="none" class="cpt_namen_td"><input type="text" class="form-control form-control-sm cpt_name"
                                                   name="cpt_name" value="{{$data->cpt}}"
                                                   maxlength="5"></td>
        <td data-tableexport-display="none" class="pos pos_td"><input type="text" class="form-control form-control-sm location"
                                                   name="location" value="{{$data->location}}" maxlength="2"></td>
        <td data-tableexport-display="none" class="m1_name_td"><input type="text" class="form-control form-control-sm m1_name"
                                                   name="m1_name" value="{{$data->m1}}" maxlength="2">
        </td>
        <td data-tableexport-display="none" class="m2_name_td"><input type="text" class="form-control form-control-sm m2_name"
                                                   name="m2_name" value="{{$data->m2}}" maxlength="2">
        </td>
        <td data-tableexport-display="none" class="m3_name_td"><input type="text" class="form-control form-control-sm m3_name"
                                                   name="m3_name" value="{{$data->m3}}" maxlength="2">
        </td>
        <td data-tableexport-display="none" class="m4_name_td"><input type="text" class="form-control form-control-sm m4_name"
                                                   name="m4_name" value="{{$data->m4}}" maxlength="2">
        </td>
        <td data-tableexport-display="none" class="unit_name_td"><input type="text" class="form-control form-control-sm unit_name"
                                                   name="unit_name"
                                                   value="{{is_numeric($data->units)  ? number_format($data->units,2):$data->units}}"
                                                   maxlength="5"></td>
        <td data-tableexport-display="none" class="rates_name_td"><input type="text" class="form-control form-control-sm rates_name"
                                                   name="rates_name"
                                                   value="{{is_numeric($data->rate) ? number_format($data->rate,2,'.','') : $data->rate}}"
                                                   maxlength="5"></td>
        <td data-tableexport-display="none" class="cms_24j_name_td">
            <?php
            $employee_name = \App\Models\Employee::where('id', $data->cms_24j)->first();
            ?>
            <select class="form-control form-control-sm cms_24j_name" name="cms_24j_name">
                @if ($employee_name)
                    <option
                        value="{{$employee_name->id}}">{{$employee_name->first_name}} {{$employee_name->middle_name}} {{$employee_name->last_name}}</option>
                @endif
            </select>
        </td>
        <td data-tableexport-display="none" class="qualifier_id_td">
            <select class="form-control form-control-sm id_qualifier qualifier_id" name="qualifier_id_val">
                <option value=""></option>
                <option value="0B" {{$data->id_qualifier == "0B" ? 'selected' : ''}}>0B</option>
                <option value="1B" {{$data->id_qualifier == "1B" ? 'selected' : ''}}>1B</option>
                <option value="1C" {{$data->id_qualifier == "1C" ? 'selected' : ''}}>1C</option>
                <option value="1D" {{$data->id_qualifier == "1D" ? 'selected' : ''}}>1D</option>
                <option value="1G" {{$data->id_qualifier == "1G" ? 'selected' : ''}}>1G</option>
                <option value="1H" {{$data->id_qualifier == "1H" ? 'selected' : ''}}>1H</option>
                <option value="EI" {{$data->id_qualifier == "EI" ? 'selected' : ''}}>EI</option>
                <option value="G2" {{$data->id_qualifier == "G2" ? 'selected' : ''}}>G2</option>
                <option value="LU" {{$data->id_qualifier == "LU" ? 'selected' : ''}}>LU</option>
                <option value="N5" {{$data->id_qualifier == "N5" ? 'selected' : ''}}>N5</option>
                <option value="SY" {{$data->id_qualifier == "SY" ? 'selected' : ''}}>SY</option>
                <option value="X5" {{$data->id_qualifier == "X5" ? 'selected' : ''}}>X5</option>
                <option value="ZZ" {{$data->id_qualifier == "ZZ" ? 'selected' : ''}}>ZZ</option>
            </select>
        </td>
        <td data-tableexport-display="none">
            <p class="bil_status_show">
                <i class="fa fa-exclamation-triangle text-primary s_modal" id="scrubbing_modal_btn" data-id="{{$data->id}}" style="cursor:pointer;"></i>
                @if ($data->status == 'Ready to Bill')
                    <i class="ri-checkbox-blank-circle-fill text-success s_status" title="Ready to Bill"></i>
                @elseif ($data->status == 'Pending for Approval')
                    <i class="ri-checkbox-blank-circle-fill text-danger s_status" title="Clarification Pending"></i>
                @else
                    <i class="ri-checkbox-blank-circle-fill text-success s_status" title="Ready to Bill"></i>
                @endif
            </p>
        </td>

        {{-- For Exporting Table  --}}
        <td style="display: none;" data-tableexport-display="always">
            {{$data->cpt}}
        </td>
        <td style="display: none;" data-tableexport-display="always">
            {{$data->location}}
        </td>
        <td style="display: none;" data-tableexport-display="always">
            {{$data->m1}}
        </td>
        <td style="display: none;" data-tableexport-display="always">
            {{$data->m2}}
        </td>
        <td style="display: none;" data-tableexport-display="always">
            {{$data->m3}}
        </td>
        <td style="display: none;" data-tableexport-display="always">
            {{$data->m4}}
        </td>
        <td style="display: none;" data-tableexport-display="always">
            {{is_numeric($data->units)  ? number_format($data->units,2):$data->units}}
        </td>
        <td style="display: none;" data-tableexport-display="always">
            {{is_numeric($data->rate) ? number_format($data->rate,2,'.','') : $data->rate}}
        </td>
        <td style="display: none;" data-tableexport-display="always">
            <?php
            $employee_name = \App\Models\Employee::where('id', $data->cms_24j)->first();
            ?>
            @if($employee_name)
                {{$employee_name->first_name}} {{$employee_name->middle_name}} {{$employee_name->last_name}}
            @endif
        </td>
        <td style="display: none;" data-tableexport-display="always">
            {{$data->id_qualifier}}
        </td>
        <td style="display: none;" data-tableexport-display="always">
            {{$data->status}}
        </td>
    </tr>
@endforeach




