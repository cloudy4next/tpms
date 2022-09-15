@extends('layouts.MainAdmin')
@section('mainadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <!-- Filter -->
            <div class="d-flex">
                <div class="mr-2">
                    <label>Company</label>
                </div>
                <div class="mr-2">

                </div>
                <div class="ml-auto">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        + Create Billerlog User
                    </button>
                </div>
            </div>


            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Create Billerlog User </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('mainadmin.billerlog.user.save')}}" method="post">
                            @csrf
                            <div class="modal-body">

                                <div class="form-group">
                                    <label>Full Name(*)</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label>Account Email(*)</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label>Password (*)</label>
                                    <input type="text" class="form-control sub_password" name="password" required>
                                    <span class="text-danger error_msg_subpass"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <br>
            <table class="table table-sm table-bordered mb-0 c_table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all_users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{\Carbon\Carbon::parse($user->created_at)->format('m/d/Y')}}</td>
                        <td>
                            <button type="button" data-toggle="modal"
                                    data-target="#edituser{{$user->id}}">
                                Edit
                            </button>
                            <button type="button" data-toggle="modal"
                                    data-target="#deleteuser{{$user->id}}">
                                Delete
                            </button>
                        </td>
                    </tr>




                    <div class="modal fade" id="edituser{{$user->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Update Billerlog User </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('mainadmin.billerlog.user.update')}}" method="post">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label>Full Name(*)</label>
                                            <input type="text" class="form-control" name="name" value="{{$user->name}}"
                                                   required>
                                            <input type="hidden" class="form-control" name="user_edit_biller"
                                                   value="{{$user->id}}"
                                                   required>
                                        </div>
                                        <div class="form-group">
                                            <label>Account Email(*)</label>
                                            <input type="email" class="form-control" name="email"
                                                   value="{{$user->email}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="text" class="form-control sub_password" name="password"
                                            >
                                            <span class="text-danger error_msg_subpass"></span>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteuser{{$user->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Delete Billerlog User </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('mainadmin.billerlog.user.delete')}}" method="post">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label>are you sure to delete this user ?</label>
                                            <input type="hidden" class="form-control" name="user_del_biller"
                                                   value="{{$user->id}}"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
