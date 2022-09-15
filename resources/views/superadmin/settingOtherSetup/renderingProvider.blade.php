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
                                <h5 class="common-title">Referring Provider</h5>
                            </div>
                            <div class="align-self-center">
                                <button type="button" data-target="#rendering-provider"
                                        class="btn btn-sm btn-primary mb-3" data-toggle="modal">Add Referring
                                    Provider
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered c_table">
                                <thead>
                                <tr>
                                    <th>Provider First Name</th>
                                    <th>Provider Last Name</th>
                                    <th>NPI</th>
                                    <th>UPIN</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ren_providers as $provi)
                                    <tr>
                                        <td>{{$provi->provider_name}}</td>
                                        <td>{{$provi->provider_last_name}}</td>
                                        <td>{{$provi->npi}}</td>
                                        <td>{{$provi->upin}}</td>
                                        <td>
                                            <a href="#rendering-provideredit{{$provi->id}}" data-toggle="modal"><i
                                                    class="ri-edit-box-line px-2"></i></a>|
                                            <a href="{{route('superadmin.setting.rendering.provider.delete',$provi->id)}}"><i
                                                    class="ri-delete-bin-line text-danger px-2"></i></a>
                                        </td>
                                    </tr>


                                    <div class="modal fade" id="rendering-provideredit{{$provi->id}}"
                                         data-backdrop="static">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4>Edit Rendering Provider</h4>
                                                    <button type="button" class="close"
                                                            data-dismiss="modal">&times;
                                                    </button>
                                                </div>
                                                <form action="{{route('superadmin.setting.rendering.provider.update')}}"
                                                      method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-2">
                                                                <label>Provider First Name</label>
                                                                <input type="text" name="provider_name"
                                                                       value="{{$provi->provider_name}}"
                                                                       class="form-control form-control-sm"
                                                                       required>
                                                                <input type="hidden" name="edit_ref_provider"
                                                                       value="{{$provi->id}}"
                                                                       class="form-control form-control-sm"
                                                                       required>
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <label>Provider Last Name</label>
                                                                <input type="text" name="provider_last_name"
                                                                       value="{{$provi->provider_last_name}}"
                                                                       class="form-control form-control-sm"
                                                                       required>
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <label>NPI</label>
                                                                <input type="text" name="npi" value="{{$provi->npi}}"
                                                                       class="form-control form-control-sm"
                                                                       required>
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <label>UPIN</label>
                                                                <input type="text" name="upin" value="{{$provi->upin}}"
                                                                       class="form-control form-control-sm">
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
                            {{$ren_providers->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="rendering-provider" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Add Rendering Provider</h4>
                    <button type="button" class="close"
                            data-dismiss="modal">&times;
                    </button>
                </div>
                <form action="{{route('superadmin.setting.rendering.provider.save')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label>Provider First Name</label>
                                <input type="text" name="provider_name" class="form-control form-control-sm"
                                       required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Provider Last Name</label>
                                <input type="text" name="provider_last_name"
                                       class="form-control form-control-sm"
                                       required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>NPI</label>
                                <input type="text" name="npi" class="form-control form-control-sm"
                                       required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>UPIN</label>
                                <input type="text" name="upin" class="form-control form-control-sm">
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
@endsection
