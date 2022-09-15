<style>
    .popover {
        width: 300px;
    }

    .popover-header {
        height: auto;
        color: white;
        font-size: 16px;
        padding: 5px 5px;
        padding-left: 15px;
        background-color: #089BAB;
    }
</style>


<table class="table-bordered table table-sm c_table deposit_table" id="export_table">
    <thead>
        <tr>
            <th data-tableexport-display="none" style="width: 20px;">
                <input type="checkbox" class="deposit_all_check">
            </th>
            <th style="width: 100px;">Deposit Date</th>
            <th>Check No</th>
            <th style="width: 100px;">Check Date</th>
            <th>Payee Name</th>
            <th style="width: 140px;">Payee Type</th>
            <th style="width: 110px;max-width: 110px;">Allocated Amt.</th>
            <th style="width: 110px;max-width: 110px;">Unallocated</th>
            <th style="width: 140px;">Pay Type</th>
            <th style="display: none;" data-tableexport-display="always">Description</th>
            <th style="display: none;" data-tableexport-display="always">File</th>
            <th data-tableexport-display="none" style="width: 50px;">Notes</th>
            <th data-tableexport-display="none" style="width: 50px;">Action</th>
        </tr>
    </thead>
    <tbody>

        <?php
        
        $totalAll = 0;
        $totalUnAll = 0;
        ?>
        @foreach ($deposits as $depisit)
            <tr class="data-tr">
                <td data-tableexport-display="none">
                    <input type="checkbox" class="deposit_in_check" value="{{ $depisit->id }}">
                </td>
                <td>{{ \Carbon\Carbon::parse($depisit->deposit_date)->format('m/d/Y') }}</td>
                <td style=" width: 180px; min-width: 180px; max-width: 180px;">{{ $depisit->instrument }}</td>
                <td>{{ \Carbon\Carbon::parse($depisit->instrument_date)->format('m/d/Y') }}</td>
                <td>
                    <?php
                    
                    if (Auth::user()->is_up_admin == 1) {
                        $payor_name = \App\Models\All_payor_detail::select('id', 'payor_id', 'admin_id', 'payor_name')
                            ->where('payor_id', $depisit->payor_id)
                            ->where('admin_id', Auth::user()->id)
                            ->first();
                    } else {
                        $payor_name = \App\Models\All_payor_detail::select('id', 'payor_id', 'admin_id', 'payor_name')
                            ->where('payor_id', $depisit->payor_id)
                            ->where('admin_id', Auth::user()->up_admin_id)
                            ->first();
                    }
                    
                    $client_name = \App\Models\Client::where('id', $depisit->client_id)->first();
                    ?>
                    @if ($depisit->payor_type == 1)
                        @if ($client_name)
                            {{ $client_name->client_full_name }}
                        @endif
                    @elseif ($depisit->payor_type == 2)
                        @if ($payor_name)
                            {{ $payor_name->payor_name }}
                        @endif
                    @else
                    @endif

                </td>
                <td>
                    @if ($depisit->payor_type == 1)
                        Client
                    @else
                        Payor
                    @endif
                </td>
                <td>
                    {{ number_format($depisit->amount, 2) }}
                    <?php
                    
                    $totalAll += $depisit->amount;
                    ?>
                </td>
                <td>
                    <?php
                    $sm = \App\Models\deposit_apply::where('deopsit_id', $depisit->id)->sum('payment');
                    $un = $depisit->amount - $sm;
                    $totalUnAll += $un;
                    ?>
                    
                    <input type="hidden" class="un_h" value="{{$un}}">
                    {{ number_format($un, 2) }}
                </td>
                <td>
                    @if ($depisit->payment_method == 1)
                        Check
                    @elseif($depisit->payment_method == 2)
                        EFT
                    @elseif($depisit->payment_method == 3)
                        Credit Card
                    @elseif($depisit->payment_method == 4)
                        Cash
                    @elseif($depisit->payment_method == 5)
                        Credit Memo
                    @elseif($depisit->payment_method == 6)
                        Write Off
                    @else
                        Not Set
                    @endif
                </td>
                <td style="display: none;" data-tableexport-display="always">
                    {{ $depisit->notes }}
                </td>
                <td style="display:none;" data-tableexport-display="always">
                    <?php
                    $get_name = substr($depisit->file, 25);
                    $ext = pathinfo($depisit->file, PATHINFO_EXTENSION);
                    $name = $get_name . $ext;
                    ?>
                    {{ $get_name }}
                </td>
                <td data-tableexport-display="none">
                    @if (strlen($depisit->notes) > 0)
                        <button class="btn text-primary text-nowrap p-0" data-toggle="popover" data-placement="right"
                            data-trigger="focus" class="" title="Deposit Notes"
                            data-content="{{ $depisit->notes }}"><i class="ri-eye-line mr-1"></i></button>
                    @else
                        <button class="btn text-primary p-0" class=""><i class="ri-eye-line mr-1 text-light"
                                disabled></i>
                        </button>
                    @endif
                </td>
                <td data-tableexport-display="none">

                    <div class="dropdown">
                        <button class="btn dropdown-toggle p-0 text-primary" type="button" data-toggle="dropdown"
                            data-boundary="viewport">
                            <i class="ri-more-fill"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right session-dd">
                            <a href="{{ route('superadmin.deposit.apply', $depisit->id) }}" title="Apply"
                                class="dropdown-item"><i class="ri-function-line mr-2"></i>Apply Payment</a>
                            <a href="{{ route('superadmin.deposit.edit', $depisit->id) }}" title="Edit"
                                class="dropdown-item"><i class="ri-pencil-line mr-2"></i>Edit Deposit </a>
                            <a href="{{ route('superadmin.deposit.delete', $depisit->id) }}" title="Delete"
                                class="dropdown-item"><i class="ri-delete-bin-6-line mr-2"></i>Delete Deposit</a>
                            <a href="#deposit_details" title="Details" class="ddetail_btn dropdown-item"
                                data-id="{{ $depisit->id }}"><i class="ri-file-line mr-2"></i>Deposit Details</a>
                            <a href="{{ route('superadmin.deposit.recipt', $depisit->id) }}" target="_blank"
                                class="dropdown-item"><i class="ri-printer-line mr-2"></i>Print Receipt</a>
                            @if (!empty($depisit->file) && file_exists($depisit->file))
                                <a href="{{ asset($depisit->file) }}" target="_blank" class="dropdown-item"><i
                                        class="ri-file-text-line mr-2"></i>ERA Text File</a>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        <tr style="display: none;" data-tableexport-display="always">
            <th colspan="5">Total</th>
            <th>
                {{ number_format($totalAll, 2) }}
                <input type="hidden" value="0" class="t_h_al">
            </th>
            <th>
                {{ number_format($totalUnAll, 2) }}
                <input type="hidden" value="0" class="t_h_un">
            </th>
            <th colspan="3" style="border: none;"></th>
        </tr>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('[data-toggle="popover"]').popover();
    });
</script>
