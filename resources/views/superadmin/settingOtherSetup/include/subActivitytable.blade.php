<table class="table table-sm table-bordered c_table">
    <thead>
    <tr>
        <th>Description</th>
        <th>Active</th>
        <th>Edit</th>
    </tr>
    </thead>
    <tbody>
    @foreach($query_exe as $a_act)
        <tr>
            <td>{{$a_act->sub_activity}}</td>
            <td>
                {{--                <input type="checkbox" {{$a_act->is_active == 1 ? 'checked' : ''}}>--}}
                <div class="custom-control custom-switch active-switch">
                    <input type="checkbox" class="custom-control-input active_switch" id="ac{{$a_act->id}}" data-id="{{$a_act->id}}" {{$a_act->is_active == 2 ? '':'checked'}}>
                    <label class="custom-control-label" for="ac{{$a_act->id}}">Active</label>
                </div>
            </td>
            <td>
                <a href="#" class="edit_btn edit_admin_act" data-id="{{$a_act->id}}"
                   title="Edit"><i class="ri-edit-box-line text-primary"></i></a>

                <a href="#" class="delete_btn delete_admin_act" data-id="{{$a_act->id}}" title="Delete"><i
                        class="ri-delete-bin-line text-danger"></i></a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
<button type="button" class="btn btn-sm btn-primary add_activity">Add Service Sub Type</button>
