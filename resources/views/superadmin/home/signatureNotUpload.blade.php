@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-flex justify-content-between">
                <div class="align-self-center mb-2">
                    <h2 class="common-title m-0">Sessions missing Patient/Provider Signature</h2>
                </div>
                <div class="align-self-center mb-2">
                    <ul class="list-inline">
                        <li class="list-inline-item">

                        </li>
                        <li class="list-inline-item">
                            <a href="{{ route('superadmin.dashboard') }}" class="btn btn-sm btn-primary"
                                title="Back to dashboard"><i
                                    class="ri-arrow-left-circle-line mr-1 align-middle"></i>Back</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="d-flex">
                <div class="mr-2 mb-2">
                    <label>Provider</label>
                    <select class="form-control form-control-sm multiselect" name="provider_id" id="sig_provider_id"
                        multiple required>
                    </select>
                </div>
                <div class="mr-2 mb-2 date">
                    <label>Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input class="form-control form-control-sm reportrange" readonly id="sig_date_range">
                    </div>
                </div>
                <div class="align-self-end mb-2">
                    <button type="button" class="btn btn-sm btn-primary go_btn" id="get_data_btn">Go</button>
                </div>
                <div class="mt-4 ml-auto">
                    <div class="dropdown">
                        <button class="btn btn-sm p-0 dropdown-toggle" type="button" data-toggle="dropdown">
                            <i class="ri-download-2-line"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right download-icon-show">

                            <a class="dropdown-item" href="#" id="download_pdf"><i
                                    class="fa fa-file-pdf-o mr-2 text-danger"></i>Download PDF</a>
                            <a class="dropdown-item" href="#" id="download_csv"><i
                                    class="fa fa-file-excel-o mr-2 text-success"></i>Download CSV</a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="table-responsive" id="table_box">

            </div>
        </div>
    </div>
    <input type="hidden" value="SignNotUpload_" id="fileName">
@endsection
@include('superadmin.home.include.sigInclude')
