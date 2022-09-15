<table class="table table-sm table-bordered c_table">
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($providers as $pro)
        <tr>
            <td>{{$pro->full_name}}</td>
            <td>{{$pro->office_email}}</td>
            <td>{{$pro->office_phone}}</td>
            <td>
                <button data-id="{{$pro->id}}" class="btn btn-danger btn-sm delprov">Delete</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{$providers->links()}}
