<table class="table table-sm table-bordered c_table" id="export_table">
    <thead>
    <tr>
        <th class="check1_th" data-tableexport-display="none"><input type="checkbox" class="select_all_claim"></th>
        <th class="claim_th">Claim</th>
        <th class="payor_th">Payor</th>
        <th class="pt_th">Patient</th>
        <th class="date_range_th">Date Range</th>
        <th class="total_th">Total</th>
        <th class="fbdt_th" title="First Billed Date">F. Billed Dt.</th>
        <th class="lbdt_th" title="Last Billed Date">L. Billed Dt.</th>
        {{-- <th style="display: none;" data-tableexport-display="always" class="box19_th">Box 19</th>
        <th style="display: none;" data-tableexport-display="always" class="resub_th">Resub. Code</th>
        <th style="display: none;" data-tableexport-display="always" class="orfno_th">Org. Ref. No.</th> --}}
        @if($name_location->is_combo == 1)
            <th>Auth No.</th>
        @endif
        <th data-tableexport-display="none" class="action_th">Action</th>
    </tr>
    </thead>
    <tbody>

    @foreach ($query_exe as $query)
        <?php
        if (Auth::user()->is_up_admin == 1) {
            $admin_id = Auth::user()->id;
        } else {
            $admin_id = Auth::user()->up_admin_id;
        }
        $data = \App\Models\manage_claim_transaction::where('claim_id', $query->claim_id)
            ->where('admin_id', $admin_id)
            ->first();
        $payor = \App\Models\All_payor_detail::select('id', 'payor_id', 'admin_id', 'payor_name')
            ->where('admin_id', $admin_id)
            ->where('payor_id', $query->payor_id)
            ->first();


        $client = \App\Models\Client::where('id', $data->client_id)
            ->where('admin_id', $admin_id)
            ->first();

        $first_date = \App\Models\manage_claim_transaction::select('id', 'admin_id', 'claim_id', 'batch_id', 'schedule_date')
            ->where('admin_id', $admin_id)
            ->where('claim_id', $query->claim_id)
            ->where('batch_id', $query->batch_id)
            ->orderBy('schedule_date', 'asc')
            ->first();
        $last_date = \App\Models\manage_claim_transaction::select('id', 'admin_id', 'claim_id', 'batch_id', 'schedule_date')
            ->where('admin_id', $admin_id)
            ->where('claim_id', $query->claim_id)
            ->where('batch_id', $query->batch_id)
            ->orderBy('schedule_date', 'desc')
            ->first();

        $total = \App\Models\manage_claim_transaction::where('admin_id', $admin_id)
            ->where('claim_id', $query->claim_id)
            ->where('batch_id', $query->batch_id)
            ->sum('billed_am');

        $auth = \App\Models\Client_authorization::select('id', 'admin_id', 'authorization_number')
            ->where('admin_id', $admin_id)
            ->where('id', $query->authorization_id)
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
            
            <td>{{ \Carbon\Carbon::parse($query->created_at)->format('m/d/Y') }}</td>
            <td>
                @if($query->resubmit_date != null || $query->resubmit_date != '')
                    {{ \Carbon\Carbon::parse($query->resubmit_date)->format('m/d/Y') }}
                @endif
            </td>
            {{-- <td data-tableexport-display="none"><input type="text" class="form-control form-control-sm box_19" value="{{ $query->box_19 }}">
            </td>
            <td data-tableexport-display="none"><input type="text" class="form-control form-control-sm resubmit_code" value="{{ $query->resubmit_code }}"></td>
            <td data-tableexport-display="none"><input type="text" class="form-control form-control-sm orginal_ref_no" value="{{ $query->orginal_ref_number }}"></td> --}}
            {{--  For exporting Table --}}

            {{-- <td style="display:none;" data-tableexport-display="always">
                {{ $query->box_19 }}
            </td>
            <td style="display:none;" data-tableexport-display="always">
                {{ $query->resubmit_code }}
            </td>
            <td style="display:none;" data-tableexport-display="always">
                {{ $query->orginal_ref_number }}
            </td> --}}
            
            @if($name_location->is_combo == 1)
                <td data-tableexport-display="none"><input type="text" class="form-control form-control-sm auth_no" value="{{ $data->auth_no }}"></td>
                <td style="display: none;" data-tableexport-display="always">{{ $data->auth_no }}</td>
            @endif

            <td data-tableexport-display="none">
                <div class="dropdown">
                    <button class="btn dropdown-toggle p-0 text-primary" type="button"
                            data-toggle="dropdown" data-boundary="viewport">
                        <i class="ri-more-fill"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right session-dd">
                        <a href="{{ route('superadmin.claim.show.hcfa',$query->claim_id) }}" target="_blank"
                           class="show_sing_hcfa dropdown-item" title="View"><i class="ri-eye-line mr-2"></i> View HCFA</a>
                        {{--                    </form>--}}
                        <a href="{{ route('superadmin.claim.show.edi.single', $query->claim_id) }}" target="_blank" title="Download" class="dropdown-item"><i class="ri-download-line mr-2"></i>View EDI</a>
                        <a href="javascript:void(0);" title="Activity" class="dropdown-item"><i class="las la-history align-middle mr-2"></i>View History</a>
                        <a href="javascript:void(0);" title="Activity" class="dropdown-item view_code_btn" data-box19="{{$query->box_19}}" data-resub="{{$query->resubmit_code}}" data-ref="{{$query->orginal_ref_number}}" data-auth="{{$data->auth_no}}" data-claim="{{ $query->claim_id }}"><i class="ri-edit-box-line align-middle mr-2"></i>Corrected Claim</a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
