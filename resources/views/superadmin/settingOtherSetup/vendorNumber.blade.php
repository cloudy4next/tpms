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
                    <h5 class="common-title">Vendor number setup</h5>
                    <!-- filter -->
                    <div class="d-flex mb-3">
                        <div class="mr-2">
                            <label>Tx Type</label>
                            <select class="form-control form-control-sm tx_id">
                                <option></option>
                            </select>
                        </div>
                        <div class="mr-2">
                            <label>Regional Center</label>
                            <select class="form-control form-control-sm region_id">
                                <option></option>
                            </select>
                        </div>
                        <div class="align-self-end">
                            <a href="#addVendor" data-toggle="modal" class="btn btn-sm btn-primary">Create
                                New</a>
                        </div>
                    </div>
                    <!-- table -->
                    <div class="table-responsive vendor_table">

                    </div>
                    <button type="button" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addVendor" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Edit Vendor Setup</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('superadmin.vendor.save')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Service</label>
                                <select class="form-control form-control-sm" name="service_id">
                                    <option value=""></option>
                                    @foreach($service as $ser)
                                        <option value="{{$ser->id}}">{{$ser->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Tx Type</label>
                                <select class="form-control form-control-sm" name="treatment_id">
                                    <option value=""></option>
                                    @foreach($tx_types as $txtype)
                                        <option value="{{$txtype->id}}">{{$txtype->treatment_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Regional Center</label>
                                <select class="form-control form-control-sm" name="regional_center_id">
                                    <option value=""></option>
                                    @foreach($get_all_pay as $getallpay)
                                        <option value="{{$getallpay->payor_id}}">{{$getallpay->payor_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Vendor No</label>
                                <input type="text" class="form-control form-control-sm" name="vendor_no" required>
                            </div>
                            <div class="col-md-4">
                                <label>Service Code</label>
                                <input type="text" class="form-control form-control-sm" name="service_code" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@include('superadmin.settingOtherSetup.include.vendorNumberjs')
