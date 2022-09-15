@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <h4 class="mb-3">Staff</h4>
            <div class="d-lg-flex">
                <!-- menu -->
                <div class="all_menu">
                    <ul class="nav flex-column setting_menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.biographic',$employee->id)}}">Bio’s</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.contact.details',$employee->id)}}">Contact Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.credentials',$employee->id)}}">Credentials / Qualifications</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.department',$employee->id)}}">Department Supervisor(s)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.payroll',$employee->id)}}">Payroll Setup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.other.setup',$employee->id)}}">Other Setup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.leave.tracking',$employee->id)}}">Leave Tracking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.payor.exclusion',$employee->id)}}">Insurance Exclusion(s)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.subactivity.exclusion',$employee->id)}}">Service Sub-Type Exclusions</a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link active" href="{{route('superadmin.emaployee.hr.notes',$employee->id)}}">HR Notes</a>--}}
{{--                        </li>--}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.client.exclusion',$employee->id)}}">Patient Exclusions</a>
                        </li>
                    </ul>
                </div>
                <!-- content -->
                <div class="all_content flex-fill">
                    <h2 class="subtitle">HR Notes</h2>
                    @if($em_hr_notes_count <= 0)
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>No any Notes</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table-bordered table-sm table c_table bill_table">
                                <thead>
                                <tr>
                                    <th>Note Type</th>
                                    <th>Details</th>
                                    <th>Additional Details</th>
                                    <th>File</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($em_hr_notes as $emhnote)
                                    <tr>
                                        <td>{{$emhnote->note_type}}</td>
                                        <td>{{$emhnote->note_details}}</td>
                                        <td>{{$emhnote->note_additional_details}}</td>
                                        <td>{{$emhnote->note_file}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <a href="#addNote" class="btn btn-sm btn-primary" data-toggle="collapse" aria-expanded="true">Add Note</a>
                    <div id="addNote" class="my-4 collapse show" style="">
                        <form action="{{route('superadmin.emaployee.hr.notes.save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label>Type of Notes</label>
                                    <select class="form-control form-control-sm" name="note_type">
                                        <option value="1">1</option>
                                        <option value="1">1</option>
                                        <option value="1">1</option>
                                        <option value="1">1</option>
                                    </select>
                                    <input type="hidden" name="exployee_note_id" value="{{$employee->id}}">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="d-block">File Name</label>
                                    <input type="file" name="note_file">
                                </div>
                                <div class="col-md-12"></div>
                                <div class="col-md-4 form-group">
                                    <label>Details</label>
                                    <textarea class="form-control form-control-sm" name="note_details"></textarea>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>Additional Details</label>
                                    <textarea class="form-control form-control-sm" name="note_additional_details"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-sm btn-primary mr-3">Save</button>
                                    <button type="button" class="btn btn-sm btn-primary">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
