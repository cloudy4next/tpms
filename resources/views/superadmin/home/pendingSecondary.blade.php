@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-flex justify-content-between">
                <div class="align-self-center mb-2">
                    <h2 class="common-title m-0">Pending Secondary</h2>
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
                        <th>Patient</th>
                        <th>Billing Provider</th>
                        <th>Treating therapist</th>
                        <th>Insurance</th>
                        <th>Service</th>
                        <th>DOS</th>
                        <th style="width: 60px;">Cpt</th>
                        <th style="width: 60px;">POS</th>
                        <th style="width: 40px;">M1</th>
                        <th style="width: 40px;">M2</th>
                        <th style="width: 40px;">M3</th>
                        <th style="width: 40px;">M4</th>
                        <th style="width: 70px;">Amount</th>
                        <th style="width: 60px;">Units</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    {{--                    <tbody>--}}
                    {{--                    @foreach($employee as $emp)--}}
                    {{--                        <tr>--}}
                    {{--                            <td>--}}
                    {{--                                {{$emp->last_name}}--}}

                    {{--                            </td>--}}
                    {{--                            <td>--}}
                    {{--                                {{$emp->first_name}}--}}

                    {{--                            </td>--}}
                    {{--                        </tr>--}}
                    {{--                    @endforeach--}}

                    {{--                    </tbody>--}}
                </table>
                {{--                {{$employee->links()}}--}}
            </div>
        </div>
    </div>
    <input type="hidden" value="PendingSecondary_" id="fileName">

@endsection
@include('superadmin.home.include.export_include')
