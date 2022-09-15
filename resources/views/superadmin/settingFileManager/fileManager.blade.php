@extends('layouts.superadmin')
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-lg-flex">
                <!-- menu -->
                <div class="setting_menu">
                    @include('superadmin.include.settingMenu')
                </div>
                <!-- content -->
                <div class="all_content flex-fill">
                    <h2 class="common-title">OA Files</h2>
                    <div class="d-flex">
                        <div class="mr-2 mb-2 status">
                            <label>File Type</label>
                            <select class="form-control form-control-sm report_type">
                                <option value="0"></option>
                                <option value="1">EDI</option>
                                <option value="2">ERA</option>
                            </select>
                        </div>
                        <div class="align-self-end mb-2">
                            <button type="button" class="btn btn-sm btn-primary go_btn">Go</button>
                        </div>
                    </div>
                    <div class="html_data">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('superadmin.settingFileManager.include.fileManager_include')