<table class="table table-sm tableed c_table">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Display Name</th>
        <th>Type</th>
        <th>Email</th>
        <th>Reset Password</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td><input type="checkbox"></td>
            <td>{{$user->client_full_name}}</td>
            <td>{{$user->client_full_name}}</td>
            <td>Patient</td>
            <td>{{$user->email}}</td>
            <td><a href="#" class="editusr_btn"><i class="ri-edit-box-line"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{$users->links()}}
