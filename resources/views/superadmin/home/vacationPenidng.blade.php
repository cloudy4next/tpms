@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-flex justify-content-between">
                <div class="align-self-center mb-2">
                    <h2 class="common-title m-0">Vacation Pending</h2>
                </div>
                <div class="align-self-center mb-2">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <div class="dropdown">
                                <button class="btn btn-sm p-0 dropdown-toggle" type="button"
                                    data-toggle="dropdown">
                                    <i class="ri-download-2-line"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right download-icon-show">

                                    <a class="dropdown-item" href="#" id="download_pdf"><i class="fa fa-file-pdf-o mr-2 text-danger"></i>Download PDF</a>
                                    <a class="dropdown-item" href="#" id="download_csv"><i class="fa fa-file-excel-o mr-2 text-success"></i>Download CSV</a>
                                </div>
                            </div>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{route('superadmin.dashboard')}}" class="btn btn-sm btn-primary"
                                            title="Back to dashboard"><i
                            class="ri-arrow-left-circle-line mr-1 align-middle"></i>Back</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered c_table" id="export_table">
                    <thead>
                    <tr>
                        <th>Staff Last Name</th>
                        <th>Staff First Name</th>
                        <th>Holiday Date</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th data-tableexport-display="none">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($vacations as $vac)
                            @php
                                $emp=\App\Models\Employee::select('id','last_name','first_name')->where('id',$vac->employee_id)->first();
                                if($vac->status=='approved'){$status="Approved"; $color="badge-success";}
                                else if($vac->status=='pending'){ $status="Pending"; $color="badge-primary";}
                                else if($vac->status=='rejected'){ $status="Rejected"; $color="badge-danger";}
                                else {$status="Pending";$color="badge-primary";}
                            @endphp
                            <tr>
                                <td>{{$emp->last_name}}</td>
                                <td>{{$emp->first_name}}</td>
                                <td>{{\Carbon\Carbon::parse($vac->leave_date)->format('m/d/Y')}}</td>
                                <td title="{{$vac->description}}">{{$vac->description}}</td>
                                <td data-tableexport-display="none"><span class="badge {{$color}} font-weight-normal">{{$status}}</span></td>
                                <td data-tableexport-display="none">
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle p-0 text-primary" type="button"
                                        data-toggle="dropdown" data-boundary="viewport">
                                        <i class="ri-more-fill"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right session-dd">
                                            <a href="{{route('superadmin.employee.vacation.approval',[$vac->id,'approved'])}}" class="dropdown-item">Approve</i></a>
                                            <a href="{{route('superadmin.employee.vacation.approval',[$vac->id,'rejected'])}}" class="dropdown-item">Reject</i></a>
                                        </div>
                                    </div>
                                </td>
                                {{-- For report --}}
                                <td style="display: none;" data-tableexport-display="always">{{$status}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{--                {{$client_auth->links()}}--}}
            </div>
        </div>
    </div>
    <input type="hidden" value="VacationPending_" id="fileName">

@endsection
@include('superadmin.home.include.export_include')
