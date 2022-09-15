@extends('layouts.client')
@section('client')
    <div class="iq-card">
        <div class="iq-card-body">
            <h5 class="mb-2">
                <a href="{{route('client.myinfo')}}" title="Back To Client"><i
                        class="ri-arrow-left-circle-line text-primary"></i> </a>
                <?php
                $client_info = \App\Models\Client_info::where('client_id', $client_id->id)->first();
                $client = \App\Models\Client::where('id', $client_id->id)->first();
                ?>
                <a href="{{route('client.myinfo')}}"
                   class="cmn_a">{{$client_id->client_first_name}} {{$client_id->client_middle}} {{$client_id->client_last_name}}</a>
                | <small>
                    <span
                        class=" font-weight-bold text-orange">DOB:</span> {{\Carbon\Carbon::parse($client->client_dob)->format('m/d/Y')}}
                    |
                    <span class=" font-weight-bold text-orange">Phone:</span> {{$client_id->phone_number}} |
                    <span class=" font-weight-bold text-orange">Address:</span>
                    {{$client_id->client_street}}, {{$client_id->client_city}}, {{$client_id->client_state}}
                    , {{$client_id->client_zip}}

                </small>
            </h5>
            <div class="d-lg-flex">
                <div class="client_menu mr-2">
                    <ul class="nav flex-column setting_menu">
                        <li class="nav-item border-0"><img src="{{asset('assets/dashboard/')}}/images/user/01.jpg"
                                                           class="img-fluid d-block mx-auto" alt=""></li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('client.myinfo')}}">Patient
                                Info</a></li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('client.myauthorization')}}">Ins/Authorization</a>
                        </li>
                        <li class="nav-item"><a class="nav-link active"
                                                href="{{route('client.mydocuments')}}">Documents</a>
                        </li>
                    </ul>
                </div>
                <div class="all_content flex-fill">
                    @if (count($docuemtnts) <= 0)
                        <div class="text-center">
                            <img src="{{asset('assets/dashboard/')}}/images/client/contact.png" class="img-fluid py-4"
                                 alt="contact">
                            <p>{{Auth::user()->name}} has no document</p>
                            {{--                        <label for="file-up">--}}
                            {{--                            <a role="button" class="btn btn-primary text-white"><i class="fa fa-plus"></i> Add document</a>--}}
                            {{--                        </label>--}}
                            {{--                        <input id="file-up" type="file" class="d-none">--}}
                        </div>
                    @else
                        <h5>Document</h5>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered c_table">
                                <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>File Name</th>
                                    <th>Uploaded On</th>
                                    <th>Created By</th>
                                    <th>Expiry Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($docuemtnts as $document)
                                    <tr>
                                        <td>{!! $document->description !!}</td>
                                        <td>
                                            <?php
                                            $get_name = substr($document->file_name, 27);
                                            $ext = pathinfo($document->file_name, PATHINFO_EXTENSION);
                                            ?>
                                            {{$get_name}}
                                        </td>
                                        <td>{{\Carbon\Carbon::parse($document->created_at)->format('m/d/Y')}}</td>
                                        <td>{{$document->created_by}}</td>
                                        <td>
                                            @if ($document->exp_date != null || $document->exp_date != '')
                                                {{\Carbon\Carbon::parse($document->exp_date)->format('m/d/Y')}}
                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{asset($document->file_name)}}" target="_blank" title="View"><i
                                                    class="ri-eye-line mr-2"></i></a>
                                            {{-- <button class="btn p-0" disabled>
                                                <a href="#editdoc{{$document->id}}" title="Edit" data-toggle="modal" disabled><i
                                                        class="ri-pencil-line"></i></a>
                                            </button>
                                            <button class="btn p-0" disabled>
                                                <a href="{{route('client.mydocument.delete',$document->id)}}"
                                                   title="Delete" disabled><i class="ri-delete-bin-6-line ml-2"></i></a>
                                            </button> --}}
                                        </td>
                                    </tr>



                                    <div class="modal fade" id="editdoc{{$document->id}}" data-backdrop="static">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4>Edit Document</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('client.mydocuments.update')}}"
                                                          enctype="multipart/form-data" method="post" id="updatedoc"
                                                          autocomplete="off">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md">
                                                                <label>Description</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                       name="description"
                                                                       value="{!! $document->description !!}">
                                                                <input type="hidden"
                                                                       class="form-control form-control-sm"
                                                                       name="edit_doc" value="{!! $document->id !!}">
                                                            </div>
                                                            <div class="col-md">
                                                                <label>Expiry Date</label>
                                                                <input type="date" class="form-control form-control-sm"
                                                                       name="exp_date" value="{{$document->exp_date}}">
                                                            </div>
                                                            <div class="col-md">
                                                                <label>Upload File</label>
                                                                <input type="file" class="form-control-file"
                                                                       name="file_name">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" id="update">Save
                                                    </button>
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    @endif
                    <a href="#addoc" data-toggle="collapse" class="btn btn-sm btn-primary" id="addDoc">+Add Document</a>
                    <div id="addoc" class="collapse mt-2">
                        <form action="{{route('client.mydocuments.upload')}}" method="post"
                              enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md">
                                    <label>Description</label>
                                    <input type="text" class="form-control form-control-sm" name="description">
                                    <input type="hidden" class="form-control form-control-sm" name="client_id"
                                           value="{{$client_id->id}}">
                                </div>
                                <div class="col-md">
                                    <label>Expiry Date</label>
                                    <input type="date" class="form-control form-control-sm" name="exp_date">
                                </div>
                                <div class="col-md">
                                    <label>Upload File</label>
                                    <input type="file" class="form-control-file" name="file_name">
                                </div>
                                <div class="col-md align-self-end">
                                    <button type="submit" class="btn btn-sm btn-primary mr-2">Upload</button>
                                    <button type="reset" class="btn btn-sm btn-dark" id="cancel"
                                            onClick="window.location.reload();">Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('#update').click(function () {
                $('#updatedoc').submit();
            });


        })
    </script>
@endsection
