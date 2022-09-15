<?php
if (Auth::user()->is_up_admin == 1) {
    $admin_id = Auth::user()->id;
} else {
    $admin_id = Auth::user()->up_admin_id;
}
?>


<table class="table table-sm table-bordered c_table" id="export_table">
    <thead>
    <tr>
        <th data-tableexport-display="none"><input type="checkbox" class="select_all_sec_claim"></th>
        <th>Claim</th>
        <th>Payor</th>
        <th>Patient</th>
        <th>Date Range</th>
        <th>Total</th>
        <th>Action</th>
        <th title="First Billed Date">F. Billed Dt.</th>
        <th title="Last Billed Date">L. Billed Dt.</th>
        <th>Box 19</th>
        <th>Resub. Code</th>
        <th>Org. Ref. No.</th>
        @if($name_location->is_combo == 1)
            <th>Auth No.</th>
        @endif
    </tr>
    </thead>
    <tbody>

    @foreach ($sec_claims as $query)
        <?php
        $data = \App\Models\manage_claim_transaction::where('claim_id', $query->claim_id)
            ->where('admin_id', $admin_id)
            ->first();
        $payor = \App\Models\All_payor_detail::select('id', 'payor_id', 'admin_id', 'payor_name')
            ->where('admin_id', $admin_id)
            ->where('payor_id', $data->payor_id)
            ->first();


        $client = \App\Models\Client::where('id', $data->client_id)
            ->where('admin_id', $admin_id)
            ->first();

        $first_date = \App\Models\manage_claim_transaction::select('id', 'admin_id', 'claim_id', 'batch_id', 'schedule_date')
            ->where('admin_id', $admin_id)
            ->where('claim_id', $data->claim_id)
            ->where('batch_id', $data->batch_id)
            ->orderBy('schedule_date', 'asc')
            ->first();
        $last_date = \App\Models\manage_claim_transaction::select('id', 'admin_id', 'claim_id', 'batch_id', 'schedule_date')
            ->where('admin_id', $admin_id)
            ->where('claim_id', $data->claim_id)
            ->where('batch_id', $data->batch_id)
            ->orderBy('schedule_date', 'desc')
            ->first();

        $total = \App\Models\manage_claim_transaction::where('admin_id', $admin_id)
            ->where('claim_id', $data->claim_id)
            ->where('batch_id', $data->batch_id)
            ->sum('billed_am');

        $auth = \App\Models\Client_authorization::select('id', 'admin_id', 'authorization_number')
            ->where('admin_id', $admin_id)
            ->where('id', $data->authorization_id)
            ->first();

        //        $total = \App\Models\manage_claim_transaction::where('claim_id', $query->claim_id)->sum('billed_am');

        ?>
        <tr>
            <td data-tableexport-display="none">
                <input type="checkbox" class="claim_id_select claim_id_select_form" value="{{ $query->claim_id }}">
                <input type="hidden" class="add_claim_ids" disabled name="claim_ids[]"
                       value="{{ $query->claim_id }}">
            </td>
            <td>{{ $query->claim_id }}</td>
            <td>

                @if ($payor)
                    {{ $payor->payor_name }}
                @endif
            </td>
            <td>

                @if ($client)
                    {{ $client->client_full_name }}
                @endif
            </td>
            <td>
                @if ($first_date)
                    {{ \Carbon\Carbon::parse($first_date->schedule_date)->format('m/d/Y') }} -
                @endif
                @if ($last_date)
                    {{ \Carbon\Carbon::parse($last_date->schedule_date)->format('m/d/Y') }}
                @endif

            </td>
            <td>{{ is_numeric($total) ? number_format($total, 2) : $total }}</td>
            <td>
                {{--                    <form action="{{ route('superadmin.claim.show.hcfa',$data->claim_id) }}" method="post" target="_blank"--}}
                {{--                        id="singleclaimfrom" class="d-inline">--}}
                {{--                        @csrf--}}
                {{--                        <input type="text" name="claim_id" value="{{ $data->claim_id }}">--}}
                <a href="{{ route('superadmin.claim.show.hcfa',$query->claim_id) }}" target="_blank"
                   class="show_sing_hcfa" title="View"><i class="ri-eye-line mr-2"></i></a>
                {{--                    </form>--}}

                <a href="{{ route('superadmin.claim.show.edi.single', $query->claim_id) }}" target="_blank"
                   title="Download"><i class="ri-download-2-line"></i></a>
                <a href="#" title="Activity"><i class="las la-history align-middle ml-1"></i></a>
            </td>
            <td>{{ \Carbon\Carbon::parse($query->created_at)->format('m/d/Y') }}</td>
            <td>
                {{ \Carbon\Carbon::parse($query->resubmit_date)->format('m/d/Y') }}
            </td>
            <td data-tableexport-display="none"><input type="text" class="form-control form-control-sm box_19"
                                                       value="{{ $query->box_19 }}">
            </td>
            <td data-tableexport-display="none"><input type="text" class="form-control form-control-sm resubmit_code"
                                                       value="{{ $query->resubmit_code }}"></td>
            <td data-tableexport-display="none"><input type="text" class="form-control form-control-sm orginal_ref_no"
                                                       value="{{ $query->orginal_ref_number }}"></td>
            @if($name_location->is_combo == 1)
                <td data-tableexport-display="none"><input type="text" class="form-control form-control-sm auth_no"
                                                           value="{{ $data->auth_no }}"></td>
            @endif


            {{--  For exporting Table --}}

            <td style="display:none;" data-tableexport-display="always">
                {{ $query->box_19 }}
            </td>
            <td style="display:none;" data-tableexport-display="always">
                {{ $query->resubmit_code }}
            </td>
            <td style="display:none;" data-tableexport-display="always">
                {{ $query->orginal_ref_number }}
            </td>
            {{--            @if($name_location->is_combo == 1)--}}
            {{--                <td data-tableexport-display="always">{{$data->auth_no}}</td>--}}
            {{--            @endif--}}
        </tr>
    @endforeach

    </tbody>
</table>
