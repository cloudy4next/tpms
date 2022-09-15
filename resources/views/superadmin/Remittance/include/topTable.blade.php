<table class="table table-sm table-borderless summary">
    <tbody>
        @foreach($check_data as $data)
            <tr>
                <th>Check Number:</th>
                <td class="check_num">{{$data["check_number"]}}</td>
                <th>Check Date:</th>
                <td class="check_date">{{$data["check_date"]}}</td>
                <th>Total Check Amount :</th>
                <td class="t_check">{{$data["total_check"]}}</td>
                <th>Paid Amount :</th>
                <td class="t_net">{{$data["net"]}}</td>
                <th>Pat Res Amount :</th>
                <td class="t_resp">{{$data["respons"]}}</td>
            </tr>
        @endforeach
    </tbody>
</table>