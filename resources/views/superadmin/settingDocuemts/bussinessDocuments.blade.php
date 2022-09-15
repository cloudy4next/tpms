@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-lg-flex">
                <!-- menu -->
                <div class="setting_menu">
                    @include('superadmin.include.settingMenu')
                </div>
                <!-- content -->
                <div class="all_content flex-fill">
                    <h2 class="common-title">Business Documents</h2>
                    @if (count($bus_doc) <= 0)


                        <div class="text-center no_doc">
                            <img src="{{asset('assets/dashboard/')}}/images/client/default.png" class="img-fluid"
                                 alt="business-documents">
                            <h4>Safely store your business documents.</h4>
                            <p>Upload relevant business documents for easy access — like your rent agreement,
                                professional
                                license, continuing education certificates, employment contracts, and more.</p>
                        </div>


                        <a href="#addoc" data-toggle="collapse" class="btn btn-sm btn-primary">+Add Document</a>
                        <div id="addoc" class="collapse mt-2">
                            <form action="{{route('superadmin.setting.bussiness.documents.save')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md">
                                        <label>Description</label>
                                        <input type="text" class="form-control form-control-sm" name="description">
                                    </div>
                                    <div class="col-md">
                                        <label>Upload File</label>
                                        <input type="file" class="form-control-file" name="file_name">
                                    </div>
                                    <div class="col-md align-self-end">
                                        <button type="submit" class="btn btn-sm btn-primary mr-2">Upload</button>
                                        <button type="button" class="btn btn-sm btn-danger"
                                                onClick="window.location.reload();">Cancel
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    @else
                        <div class="has_doc">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered c_table">
                                    <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Uploaded On</th>
                                        <th>Created By</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($bus_doc as $doc)
                                        <tr>
                                            <td>{{$doc->description}}</td>
                                            <td>{{\Carbon\Carbon::parse($doc->uploadedon)->format('m/d/Y')}}</td>
                                            <td>{{$doc->upload_by}}</td>
                                            <td>
                                                <a href="{{asset($doc->file_name)}}" target="_blank" title="View"><i
                                                        class="ri-eye-line mr-2"></i></a>
                                                <a href="#editbusdoc{{$doc->id}}" title="Edit" data-toggle="modal"><i
                                                        class="ri-pencil-line"></i></a>
                                                <a href="{{route('superadmin.setting.bussiness.documents.delete',$doc->id)}}"
                                                   title="Delete"><i class="ri-delete-bin-6-line ml-2"></i></a>
                                                <!-- Edit Document -->
                                                <div class="modal fade" id="editbusdoc{{$doc->id}}"
                                                     data-backdrop="static">
                                                    <div
                                                        class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4>Edit Document</h4>
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal">
                                                                    &times;
                                                                </button>
                                                            </div>
                                                            <form
                                                                action="{{route('superadmin.setting.bussiness.documents.update')}}"
                                                                method="post" enctype="multipart/form-data">
                                                                <div class="modal-body">


                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-md">
                                                                            <label>Description</label>
                                                                            <input type="text"
                                                                                   class="form-control form-control-sm"
                                                                                   name="description"
                                                                                   value="{{$doc->description}}">
                                                                            <input type="hidden"
                                                                                   class="form-control form-control-sm"
                                                                                   name="edit_bus_doc"
                                                                                   value="{{$doc->id}}">
                                                                        </div>
                                                                        <div class="col-md">
                                                                            <label>Upload File</label>
                                                                            <input type="file"
                                                                                   class="form-control-file"
                                                                                   name="file_name">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                    </button>
                                                                    <button type="button" class="btn btn-primary"
                                                                            data-dismiss="modal">Close
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>


                            <a href="#addoc" data-toggle="collapse" class="btn btn-sm btn-primary">+Add Document</a>
                            <div id="addoc" class="collapse mt-2">
                                <form action="{{route('superadmin.setting.bussiness.documents.save')}}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md">
                                            <label>Description</label>
                                            <input type="text" class="form-control form-control-sm" name="description">
                                        </div>
                                        <div class="col-md">
                                            <label>Upload File</label>
                                            <input type="file" class="form-control-file" name="file_name">
                                        </div>
                                        <div class="col-md align-self-end">
                                            <button type="submit" class="btn btn-sm btn-primary mr-2">Upload</button>
                                            <button type="button" class="btn btn-sm btn-danger"
                                                    onClick="window.location.reload();">Cancel
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
