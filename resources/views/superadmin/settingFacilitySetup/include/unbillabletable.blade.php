<table class="table  table-sm table-bordered c_table">
    <thead>
    <tr>
        <th><input type="checkbox" class="all_checked"></th>
        <th style="min-width: 100px;">Patients</th>
        <th>DOS</th>
        <th>Tx. Provider</th>
        <th>Service & Hrs.</th>
        <th style="width: 70px;">Cpt</th>
        <th style="width: 50px;">POS</th>
        <th style="width: 50px;">M1</th>
        <th style="width: 50px;">M2</th>
        <th style="width: 50px;">M3</th>
        <th style="width: 50px;">M4</th>
        <th style="width: 50px;">Units</th>
        <th style="width: 50px;">Rate</th>
        <th style="width: 50px;">Rendering 24-J</th>
        <th style="width: 50px;">ID Qual</th>
        <th style="width: 50px;">Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($unbillable_acts as $data)
        <tr>
            <td>
                <input type="checkbox" class="m-0 claim_checked" value="{{$data->id}}">
                <label></label>
            </td>
            <td>
                <?php
                $client = \App\Models\Client::where('id', $data->client_id)->first();
                ?>
                @if ($client)
                    {{$client->client_first_name}} {{$client->client_middle}} {{$client->client_last_name}}
                @endif
            </td>
            <td>  {{\Carbon\Carbon::parse($data->schedule_date)->format('m/d/Y')}}</td>
            <td>
                <?php
                $provider = \App\Models\Employee::where('id', $data->provider_id)->first();
                ?>
                @if ($provider)
                    {{$provider->first_name}} {{$provider->middle_name}} {{$provider->last_name}}
                @endif
            </td>
            <td>
                <?php
                $activity = \App\Models\Client_authorization_activity::where('id', $data->activity_id)->first();
                $hours = $data->time_duration / 60;
                ?>
                {{--                {{$data->activity_type}} ({{$data->time_duration}} MIN)--}}
                {{$data->activity_type}} ({{$hours}} Hrs)
            </td>

            <td><input type="text" class="form-control form-control-sm cpt_name" name="cpt_name"
                       value="{{$data->cpt}}" maxlength="5"></td>
            <td><input type="text" class="form-control form-control-sm location" name="location"
                       value="{{$data->location}}"></td>
            <td><input type="text" class="form-control form-control-sm m1_name" name="m1_name"
                       value="{{$data->m1}}"></td>
            <td><input type="text" class="form-control form-control-sm m2_name" name="m2_name"
                       value="{{$data->m2}}"></td>
            <td><input type="text" class="form-control form-control-sm m3_name" name="m3_name"
                       value="{{$data->m3}}"></td>
            <td><input type="text" class="form-control form-control-sm m4_name" name="m4_name"
                       value="{{$data->m4}}"></td>
            <td><input type="text" class="form-control form-control-sm unit_name"
                       name="unit_name"
                       value="{{is_numeric($data->units)  ? number_format($data->units,2):$data->units}}">
            </td>
            <td><input type="text" class="form-control form-control-sm rates_name"
                       name="rates_name"
                       value="{{is_numeric($data->rate) ? number_format($data->rate,2) : $data->rate}}">
            </td>
            <td>
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
            <td>
                <select class="form-control form-control-sm id_qualifier qualifier_id"
                        name="qualifier_id_val">
                    <option value=""></option>
                    <option value="0B" {{$data->id_qualifier == "0B" ? 'selected' : ''}}>0B
                    </option>
                    <option value="1B" {{$data->id_qualifier == "1B" ? 'selected' : ''}}>1B
                    </option>
                    <option value="1C" {{$data->id_qualifier == "1C" ? 'selected' : ''}}>1C
                    </option>
                    <option value="1D" {{$data->id_qualifier == "1D" ? 'selected' : ''}}>1D
                    </option>
                    <option value="1G" {{$data->id_qualifier == "1G" ? 'selected' : ''}}>1G
                    </option>
                    <option value="1H" {{$data->id_qualifier == "1H" ? 'selected' : ''}}>1H
                    </option>
                    <option value="EI" {{$data->id_qualifier == "EI" ? 'selected' : ''}}>EI
                    </option>
                    <option value="G2" {{$data->id_qualifier == "G2" ? 'selected' : ''}}>G2
                    </option>
                    <option value="LU" {{$data->id_qualifier == "LU" ? 'selected' : ''}}>LU
                    </option>
                    <option value="N5" {{$data->id_qualifier == "N5" ? 'selected' : ''}}>N5
                    </option>
                    <option value="SY" {{$data->id_qualifier == "SY" ? 'selected' : ''}}>SY
                    </option>
                    <option value="X5" {{$data->id_qualifier == "X5" ? 'selected' : ''}}>X5
                    </option>
                    <option value="ZZ" {{$data->id_qualifier == "ZZ" ? 'selected' : ''}}>ZZ
                    </option>
                </select>
            </td>
            <td>
                <p class="bil_status_show">
                    @if ($data->status == 'Ready to Bill')
                        <i class="ri-checkbox-blank-circle-fill text-success"
                           title="Ready to Bill"></i>
                    @elseif ($data->status == 'Pending for Approval')
                        <i class="ri-checkbox-blank-circle-fill text-danger"
                           title="Clarification Pending"></i>
                    @else
                        <i class="ri-checkbox-blank-circle-fill text-success"
                           title="Ready to Bill"></i>
                    @endif
                </p>
            </td>

        </tr>
    @endforeach

    </tbody>
</table>
