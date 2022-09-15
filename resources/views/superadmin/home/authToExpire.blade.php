@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-flex justify-content-between">
                <div class="align-self-center mb-2">
                    <h2 class="common-title m-0">Expiring Authorizations</h2>
                </div>
            </div>

            <div class="d-flex">
                <div class="mr-2 mb-2">
                    <label>Select Interval</label>
                    <select class="form-control form-control-sm" name="time_interval" id="time_interval">
                        <option value="30">30 Days</option>
                        <option value="60">60 Days</option>
                        <option value="90">90 Days</option>
                        <option value="120">120 Days</option>
                    </select>
                </div>
                <div class="align-self-end mb-2">
                    <button type="button" class="btn btn-sm btn-primary" id="get_authToExpire">Go</button>
                </div>
                <div class="mt-4 ml-auto">
                    <div class="dropdown download_div">
                        <button class="btn btn-sm p-0 dropdown-toggle" type="button"
                            data-toggle="dropdown">
                            <i class="ri-download-2-line"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right download-icon-show">

                            <a class="dropdown-item" href="#" id="download_pdf"><i class="fa fa-file-pdf-o mr-2 text-danger"></i>Download PDF</a>
                            <a class="dropdown-item" href="#" id="download_csv"><i class="fa fa-file-excel-o mr-2 text-success"></i>Download CSV</a>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="table-responsive authTable">
                
            </div>
        </div>
    </div>
    <input type="hidden" value="ExpiringAuthorizations_" id="fileName">
@endsection


@include('superadmin.home.include.export_include')
