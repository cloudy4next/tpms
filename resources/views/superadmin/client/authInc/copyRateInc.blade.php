{{--@if($name_location->is_combo != 1)--}}
<?php

if (Auth::user()->is_up_admin == 1) {
    $admin_id = Auth::user()->id;
} else {
    $admin_id = Auth::user()->up_admin_id;
}


?>


<div class="modal fade" id="selectClient{{$authorization->id}}"
     data-backdrop="static">
    <div
        class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Select Contact Rate</h4>
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
            </div>
            <form action="{{route('superadmin.copy.contact.rate')}}"
                  method="post">
                @csrf
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered c_table">
                            <thead>
                            <tr>
                                <th><input type="checkbox"
                                           class="check_all_rate">
                                </th>
                                <th>Service Type</th>
                                <th>Service Sub-Type</th>
                                <th>Cpt</th>
                                <th>M1</th>
                                <th>M2</th>
                                <th>M3</th>
                                <th>M4</th>
                                <th>Rate Per</th>
                                <th>Contracted Rate</th>
                                <th>Billing Rate</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $contact_rates = \App\Models\rate_list::select('id', 'admin_id', 'payor_id', 'treatment_type', 'activity_type', 'sub_activity', 'cpt_code', 'm1', 'm2', 'm3', 'm4', 'rate_per', 'contracted_rate', 'billed_rate', 'increasing_percentage')
                                ->where('admin_id', $admin_id)
                                ->where('payor_id', $authorization->payor_id)
                                ->where('treatment_type', $authorization->treatment_type_id)
                                ->where('active', 1)
                                ->get();

                            ?>
                            @foreach($contact_rates as $rate)
                                <?php
                                $sub_act_exsis = \App\Models\Client_authorization_activity::where('admin_id', $admin_id)
                                    ->where('authorization_id', $authorization->id)
                                    ->where('rate_id', $rate->id)
                                    ->get();
                                $set_act_name = \App\Models\setting_service::where('id', $rate->activity_type)->first();
                                $sub_act_name = \App\Models\all_sub_activity::where('admin_id', $admin_id)->where('id', $rate->sub_activity)->first();
                                $cpt_name = \App\Models\setting_cpt_code::where('admin_id', $admin_id)
                                    ->where('id', $rate->cpt_code)->first();

                                ?>
                                @if (count($sub_act_exsis) <= 0)
                                    <tr>
                                        <td><input type="checkbox"
                                                   class="rate_check"
                                                   name="array[]"
                                                   value="{{$rate->id}}">
                                            <input type="hidden"
                                                   class=""
                                                   name="auth_id"
                                                   value="{{$authorization->id}}">
                                        </td>
                                        <td style="max-width: 100%">
                                            @if ($set_act_name)
                                                {{$set_act_name->description}}
                                            @endif

                                        </td>
                                        <td>
                                            @if ($sub_act_name)
                                                {{$sub_act_name->sub_activity}}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($cpt_name)
                                                {{$cpt_name->cpt_code}}
                                            @endif

                                        </td>
                                        <td>{{$rate->m1}}</td>
                                        <td>{{$rate->m2}}</td>
                                        <td>{{$rate->m3}}</td>
                                        <td>{{$rate->m4}}</td>
                                        <td>{{$rate->rate_per}}</td>
                                        <td>{{$rate->contracted_rate}}</td>
                                        <td>{{$rate->billed_rate}}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"
                            class="btn btn-primary copy_contact_rate"
                            data-id="{{$authorization->id}}">Copy
                    </button>
                    <button type="button" class="btn btn-danger"
                            data-dismiss="modal">Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--@else--}}
{{--    <div class="modal fade" id="selectClient{{$authorization->id}}"--}}
{{--         data-backdrop="static">--}}
{{--        <div--}}
{{--            class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h4>Select Contact Rate</h4>--}}
{{--                    <button type="button" class="close" data-dismiss="modal">--}}
{{--                        &times;--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <form action="{{route('superadmin.copy.contact.rate')}}"--}}
{{--                      method="post">--}}
{{--                    @csrf--}}
{{--                    <div class="modal-body">--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table class="table table-sm table-bordered c_table">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th><input type="checkbox"--}}
{{--                                               class="check_all_rate">--}}
{{--                                    </th>--}}
{{--                                    <th>Service Type</th>--}}
{{--                                    <th>Service Sub-Type</th>--}}
{{--                                    <th>Cpt</th>--}}
{{--                                    <th>M1</th>--}}
{{--                                    <th>M2</th>--}}
{{--                                    <th>M3</th>--}}
{{--                                    <th>M4</th>--}}
{{--                                    <th>Rate Per</th>--}}
{{--                                    <th>Contracted Rate</th>--}}
{{--                                    <th>Billing Rate</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                <?php--}}
{{--                                if (Auth::user()->is_up_admin == 1) {--}}
{{--                                    $contact_rates = \App\Models\rate_list::select('id', 'admin_id', 'payor_id', 'treatment_type', 'activity_type', 'sub_activity', 'cpt_code', 'm1', 'm2', 'm3', 'm4', 'rate_per', 'contracted_rate', 'billed_rate', 'increasing_percentage')--}}
{{--                                        ->where('admin_id', Auth::user()->id)--}}
{{--                                        ->where('payor_id', $authorization->payor_id)--}}
{{--                                        ->where('treatment_type', $authorization->treatment_type_id)--}}
{{--                                        ->where('active', 1)--}}
{{--                                        ->get();--}}
{{--                                } else {--}}
{{--                                    $contact_rates = \App\Models\rate_list::select('id', 'admin_id', 'payor_id', 'treatment_type', 'activity_type', 'sub_activity', 'cpt_code', 'm1', 'm2', 'm3', 'm4', 'rate_per', 'contracted_rate', 'billed_rate', 'increasing_percentage')--}}
{{--                                        ->where('admin_id', Auth::user()->up_admin_id)--}}
{{--                                        ->where('payor_id', $authorization->payor_id)--}}
{{--                                        ->where('treatment_type', $authorization->treatment_type_id)--}}
{{--                                        ->where('active', 1)--}}
{{--                                        ->get();--}}
{{--                                }--}}


{{--                                ?>--}}
{{--                                @foreach($contact_rates as $rate)--}}
{{--                                    <?php--}}
{{--                                    if (Auth::user()->is_up_admin == 1) {--}}
{{--                                        $sub_act_exsis = \App\Models\Client_authorization_activity::where('admin_id', Auth::user()->id)--}}
{{--                                            ->where('authorization_id', $authorization->id)--}}
{{--                                            ->where('rate_id', $rate->id)--}}
{{--                                            ->get();--}}


{{--                                        $set_act_name = \App\Models\setting_service::where('id', $rate->activity_type)->first();--}}
{{--                                        $sub_act_name = \App\Models\all_sub_activity::where('admin_id', Auth::user()->id)->where('id', $rate->sub_activity)->first();--}}
{{--                                        $cpt_name = \App\Models\setting_cpt_code::where('admin_id', Auth::user()->id)--}}
{{--                                            ->where('id', $rate->cpt_code)->first();--}}


{{--                                        $exc_cpt = explode(",", $cpt_name->cpt_code);--}}

{{--                                    } else {--}}
{{--                                        $sub_act_exsis = \App\Models\Client_authorization_activity::where('admin_id', Auth::user()->up_admin_id)--}}
{{--                                            ->where('authorization_id', $authorization->id)--}}
{{--                                            ->where('rate_id', $rate->id)--}}
{{--                                            ->get();--}}
{{--                                        $set_act_name = \App\Models\setting_service::where('id', $rate->activity_type)->first();--}}
{{--                                        $sub_act_name = \App\Models\all_sub_activity::where('admin_id', Auth::user()->up_admin_id)->where('id', $rate->sub_activity)->first();--}}
{{--                                        $cpt_name = \App\Models\setting_cpt_code::where('admin_id', Auth::user()->up_admin_id)--}}
{{--                                            ->where('id', $rate->cpt_code)->first();--}}

{{--                                        $exc_cpt = explode(",", $cpt_name->cpt_code);--}}
{{--                                    }--}}

{{--                                    ?>--}}
{{--                                    @if (count($sub_act_exsis) <= 0)--}}
{{--                                        @foreach($exc_cpt as $key =>$value)--}}
{{--                                            <tr>--}}
{{--                                                <td><input type="checkbox"--}}
{{--                                                           class="rate_check"--}}
{{--                                                           name="array[]"--}}
{{--                                                           value="{{$rate->id}}">--}}
{{--                                                    <input type="hidden"--}}
{{--                                                           class=""--}}
{{--                                                           name="auth_id"--}}
{{--                                                           value="{{$authorization->id}}">--}}
{{--                                                    <input type="hidden"--}}
{{--                                                           class=""--}}
{{--                                                           name="cpt_code_name[]"--}}
{{--                                                           value="{{$value}}">--}}
{{--                                                    <input type="hidden"--}}
{{--                                                           class=""--}}
{{--                                                           name="db_cpt_name[]"--}}
{{--                                                           value="{{$cpt_name->cpt_code}}">--}}
{{--                                                </td>--}}
{{--                                                <td style="max-width: 100%">--}}
{{--                                                    @if ($set_act_name)--}}
{{--                                                        {{$set_act_name->description}}--}}
{{--                                                    @endif--}}

{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    @if ($sub_act_name)--}}
{{--                                                        {{$sub_act_name->sub_activity}}--}}
{{--                                                    @endif--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    @if ($cpt_name)--}}
{{--                                                        {{$value}}--}}
{{--                                                    @endif--}}

{{--                                                </td>--}}
{{--                                                <td>{{$rate->m1}}</td>--}}
{{--                                                <td>{{$rate->m2}}</td>--}}
{{--                                                <td>{{$rate->m3}}</td>--}}
{{--                                                <td>{{$rate->m4}}</td>--}}
{{--                                                <td>{{$rate->rate_per}}</td>--}}
{{--                                                <td>{{$rate->contracted_rate}}</td>--}}
{{--                                                <td>{{$rate->billed_rate}}</td>--}}
{{--                                            </tr>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer">--}}
{{--                        <button type="submit"--}}
{{--                                class="btn btn-primary copy_contact_rate"--}}
{{--                                data-id="{{$authorization->id}}">Copy--}}
{{--                        </button>--}}
{{--                        <button type="button" class="btn btn-danger"--}}
{{--                                data-dismiss="modal">Close--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endif--}}
