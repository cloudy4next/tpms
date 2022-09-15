@php
if (\Auth::user()->is_up_admin == 1) {
    $admin_id = \Auth::user()->id;
} else {
    $admin_id = \Auth::user()->up_admin_id;
}
@endphp

<table class="table table-sm table-bordered c_table" id="export_table">
    <thead>
        <tr>
            <th> Last Name</th>
            <th> First Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employee as $emp)
            @php
                $employe = \App\Models\Employee::select('last_name', 'first_name')
                    ->where('id', $emp->employee_id)
                    ->first();
            @endphp
            <tr>
                <td>
                    {{ $employe->last_name }}

                </td>
                <td>
                    {{ $employe->first_name }}

                </td>
            </tr>
        @endforeach

    </tbody>
</table>
