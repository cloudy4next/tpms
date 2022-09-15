@extends('layouts.superadmin')
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-flex justify-content-between">
                <div class="align-self-center mb-2">
                    <h2 class="common-title m-0">Last Month Billed Dates</h2>
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
            <form action="{{ route('superadmin.last.month.dates.export') }}" method="post">
                @csrf
                <div class="d-flex mb-3">
                    <div class="mr-2">
                        <label>Date Type</label>
                        <select class="form-control form-control-sm filtertype filter-date" name="filter_type">
                            <option value=""></option>
                            <option value="1">Specific Date</option>
                            <option value="2">Date Range</option>
                        </select>
                    </div>
                    <div class="mr-2 specific-date">
                        <label>Select Date</label>
                        <input type="date" class="form-control form-control-sm single_data" name="select_date">
                    </div>
                    <div class="mr-2 date-range">
                        <label>Date Range</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input class="form-control form-control-sm reportrange" name="date_range">
                        </div>
                    </div>
                    <div class="align-self-end">
                        <button type="button" class="btn btn-sm btn-primary" id="goBtn">Go</button>
                        {{-- <button type="submit" class="btn btn-sm btn-primary" id="goBtn">Export</button> --}}
                    </div>

                </div>
            </form>
            <div class="d-flex justify-content-between">
                <div class="align-self-center mb-2">
                    <h2 class="common-title m-0">Billed Table</h2>
                </div>
                <div class="align-self-center mb-2">
                    <ul class="list-inline">
                        <li class="list-inline-item">
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
                        </li>
                        <li class="list-inline-item">

                        </li>
                    </ul>
                </div>
            </div>
            <!-- bill-table -->
            <div class="bill-table">
                <div class="table-responsive lastMonthBulledData" id="export_table">

                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="align-self-center mb-2">
                    <h2 class="common-title m-0">Detail Table</h2>
                </div>
                <div class="align-self-center mb-2">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <div class="dropdown">
                                <button class="btn btn-sm p-0 dropdown-toggle" type="button" data-toggle="dropdown">
                                    <i class="ri-download-2-line"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right download-icon-show">

                                    <a class="dropdown-item" href="#" id="download_pdf2"><i
                                            class="fa fa-file-pdf-o mr-2 text-danger"></i>Download PDF</a>
                                    <a class="dropdown-item" href="#" id="download_csv2"><i
                                            class="fa fa-file-excel-o mr-2 text-success"></i>Download CSV</a>
                                </div>
                            </div>
                        </li>
                        <li class="list-inline-item">

                        </li>
                    </ul>
                </div>
            </div>
            <!-- detail-table -->
            <div class="detail-table">
                <div class="table-responsive lastMonthBulledDetails" id="export_table2">

                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="BilledTable_" id="fileName">
    <input type="hidden" value="DetailsTable_" id="fileName2">
@endsection

@include('superadmin.home.include.export_include')
