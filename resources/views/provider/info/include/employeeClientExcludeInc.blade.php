<table class="table table-sm table-bordered c_table">
    <thead>
    <tr>
        <th>Patient Name</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($assign_clients as $ass_clint)
        <?php
        $client_name = \App\Models\Client::where('id', $ass_clint->client_id)->first();
        ?>
        <tr>
            <td>
                @if ($client_name)
                    {{$client_name->client_full_name}}
                @endif
            </td>
            <td><i class="fa fa-times text-danger delete_client" data-id="{{$ass_clint->id}}" aria-hidden="true"></i>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
