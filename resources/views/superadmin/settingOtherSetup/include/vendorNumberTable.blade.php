@php
if(Auth::user()->is_up_admin==1){
    $admin_id=Auth::user()->id;
}
else{
    $admin_id=Auth::user()->is_up_admin;
}


@endphp

<table class="table table-sm table-bordered c_table">
    <thead>
    <tr>
        <th>Service</th>
        <th style="width: 100px;">Vendor No</th>
        <th style="width: 100px;">Service Code</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($vendors as $vendor)
        <?php
        $ser_name = \App\Models\setting_service::where('id', $vendor->service_id)->first();
        $service_edit = \App\Models\setting_service::where('admin_id', $admin_id)->get();
        $tx_types_edit = \App\Models\Treatment_facility::where('admin_id', $admin_id)->get();
        $get_all_pay_edit = \App\Models\Payor_facility::where('admin_id', $admin_id)->get();

        ?>
        <tr>
            <td>
                @if ($ser_name)
                    {{$ser_name->description}}
                @endif
            </td>
            <td><input type="text" value="{{$vendor->vendor_no}}" class="form-control form-control-sm"></td>
            <td><input type="text" value="{{$vendor->service_code}}" class="form-control form-control-sm"></td>
            <td>
                <a href="#editVendor{{$vendor->id}}" data-toggle="modal"><i
                        class="ri-edit-box-line mr-2" title="Edit"></i></a>
                <a href="{{route('superadmin.vendor.number.delete',$vendor->id)}}"><i
                        class="ri-delete-bin-line text-danger"
                        title="Delete"></i></a>
                <!-- Edit Modal -->
                <div class="modal fade" id="editVendor{{$vendor->id}}" data-backdrop="static">
                    <div
                        class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Edit Vendor Setup</h4>
                                <button type="button" class="close"
                                        data-dismiss="modal">&times;
                                </button>
                            </div>
                            <form action="{{route('superadmin.vendor.update')}}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Service</label>
                                            <select class="form-control form-control-sm" name="service_id">
                                                <option value=""></option>
                                                @foreach($service_edit as $ser)
                                                    <option
                                                        value="{{$ser->id}}" {{$vendor->service_id == $ser->id ? 'selected' :''}}>{{$ser->description}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Tx Type</label>
                                            <select class="form-control form-control-sm" name="treatment_id">
                                                <option value=""></option>
                                                @foreach($tx_types_edit as $txtype)
                                                    <option
                                                        value="{{$txtype->id}}" {{$vendor->treatment_id == $txtype->id ? 'selected' :''}}>{{$txtype->treatment_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Regional Center</label>
                                            <select class="form-control form-control-sm" name="regional_center_id">
                                                <option value=""></option>
                                                @foreach($get_all_pay_edit as $getallpay)
                                                    <option
                                                        value="{{$getallpay->payor_id}}" {{$vendor->regional_center_id == $getallpay->payor_id ? 'selected' :''}}>{{$getallpay->payor_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Vendor No</label>
                                            <input type="text" class="form-control form-control-sm"
                                                   value="{{$vendor->vendor_no}}" name="vendor_no"
                                                   required>
                                            <input type="hidden" class="form-control form-control-sm"
                                                   value="{{$vendor->id}}" name="edit_vendor"
                                                   required>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Service Code</label>
                                            <input type="text" class="form-control form-control-sm"
                                                   value="{{$vendor->service_code}}" name="service_code"
                                                   required>
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
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{$vendors->links()}}
