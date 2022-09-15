<table class="table table-sm table-bordered c_table">
    <thead>
        <tr>
            <th>Insurance</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($assign_pyaor as $payorname)
        <?php
        $p_name = \App\Models\All_payor::select('id', 'payor_name')->where('id', $payorname->payor_id)->first();
        ?>
        <tr>
            <td>
                @if ($p_name)
                {{ $p_name->payor_name }}
                @endif
            </td>
            <td><i class="fa fa-times text-danger deleteasspayor" data-id={{$payorname->id}} aria-hidden="true"></i></td>
        </tr>
        @endforeach
    </tbody>
</table>