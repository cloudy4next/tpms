<table class="table table-sm table-bordered c_table">
    <thead>
    <tr>
        <th>Service Sub-Type</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($assign_sub_type as $sub_type)
        <?php
        $sub_type_name = \App\Models\all_sub_activity::select('id', 'sub_activity')->where('id', $sub_type->sub_activity_id)->first();
        ?>
        <tr>
            <td>{{$sub_type_name->sub_activity}}</td>
            <td><i class="fa fa-times text-danger delete_sub_act" data-id="{{$sub_type->id}}" aria-hidden="true"></i>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
