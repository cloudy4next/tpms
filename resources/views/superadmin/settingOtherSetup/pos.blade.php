@extends('layouts.superadmin')
@section('superadmin')
    <div class="container-fluid">
        <div class="iq-card">
            <div class="iq-card-body">
                <div class="d-lg-flex">
                    <!-- menu -->
                    <div class="setting_menu">
                        @include('superadmin.include.settingMenu')
                    </div>
                    <!-- content -->
                    <div class="all_content flex-fill">
                        <div class="d-flex justify-content-between">
                            <div class="align-self-center">
                                <h5 class="common-title">Place of Service</h5>
                            </div>
                            <div class="align-self-center">
                                <button type="button" data-target="#addpos"
                                        class="btn btn-sm btn-primary mb-3" data-toggle="modal">Add Place of Service
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered c_table">
                                <thead>
                                <tr>
                                    <th>Place of Service</th>
                                    <th>Place of Service Code</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pos_data as $pos)
                                    <tr>
                                        <td>{{$pos->pos_name}}</td>
                                        <td>{{$pos->pos_code}}</td>
                                        <td>
                                            <a href="#editpos{{$pos->id}}" data-toggle="modal"><i
                                                    class="ri-edit-box-line px-2"></i></a>|
                                            <a href="{{route('superadmin.setting.pos.delete',$pos->id)}}"><i
                                                    class="ri-delete-bin-line text-danger px-2"></i></a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="editpos{{$pos->id}}" data-backdrop="static">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4>Edit Place of Service</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                </div>
                                                <form action="{{route('superadmin.setting.pos.update')}}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md mb-2">
                                                                <label>Place of Service</label>
                                                                <input type="text" name="pos_name"
                                                                       value="{{$pos->pos_name}}"
                                                                       class="form-control form-control-sm"
                                                                       placeholder="Enter here"
                                                                       required>
                                                                <input type="hidden" name="edit_pos"
                                                                       value="{{$pos->id}}"
                                                                       class="form-control form-control-sm"
                                                                       placeholder="Enter here"
                                                                       required>
                                                            </div>
                                                            <div class="col-md mb-2">
                                                                <label>Place of Service Code</label>
                                                                <input type="number" name="pos_code"
                                                                       value="{{$pos->pos_code}}"
                                                                       class="form-control form-control-sm"
                                                                       placeholder="Enter here"
                                                                       required>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                        <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                                </tbody>
                            </table>
                            {{$pos_data->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addpos" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Add Place of Service</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('superadmin.setting.pos.save')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md mb-2">
                                <label>Place of Service</label>
                                <input type="text" name="pos_name" class="form-control form-control-sm"
                                       placeholder="Enter here"
                                       required>
                            </div>
                            <div class="col-md mb-2">
                                <label>Place of Service Code</label>
                                <input type="number" name="pos_code" class="form-control form-control-sm"
                                       placeholder="Enter here"
                                       required>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
