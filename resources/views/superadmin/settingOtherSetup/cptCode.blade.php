@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-lg-flex">
                <!-- menu -->
                <div class="setting_menu">
                    @include('superadmin.include.settingMenu')
                </div>
                <!-- content -->
                <div class="all_content flex-fill">
                    <h6>Click on each Service name to edit</h6>
                    <p class="mb-2">Service Descriptions are shown throughout the SimplePractice platform internally, in
                        some client communications and in Superbills.</p>
                    <a href="#addcptcode" class="btn btn-sm btn-primary mb-3" data-toggle="modal">Add new
                        Cpt Code</a>
                    <div class="modal fade" id="addcptcode" data-backdrop="static">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Add/Edit Cpt Code</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <form action="{{route('superadmin.setting.cpt.code.save')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <form action="#" method="post">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Tx Type</label>
                                                    <select class="form-control form-control-sm"
                                                            name="facility_treatment_id" required>
                                                        <option value=""></option>
                                                        @foreach($facility_treatment as $treat_type)
                                                            <option
                                                                value="{{$treat_type->id}}">{{$treat_type->treatment_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if($name_location->is_combo != 1)
                                                    <div class="col-md-6">
                                                        <label>Cpt Code</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                               name="cpt_code" required>
                                                    </div>
                                                @else
                                                    <div class="col-md-6 main-cpt">
                                                        <label>Cpt Code</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control form-control-sm"
                                                                   name="cpt_code[]" required="">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-sm btn-primary addcptmore"
                                                                        type="button"><i
                                                                        class="las la-plus"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="duplicate-cpt mt-2"></div>
                                                    </div>
                                                @endif

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

                    <h6 class="mt-2">Services</h6>
                    <div class="table-responsive">
                        <table class="table-bordered table-sm table c_table">
                            <thead>
                            <tr>
                                <th>Tx Type</th>
                                <th>Cpt Code</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($all_cpt_codes as $cpt)
                                <?php
                                $facility_tret_name = \App\Models\Treatment_facility::where('id', $cpt->facility_treatment_id)->first();
                                ?>
                                <tr>
                                    <td>
                                        @if ($facility_tret_name)
                                            {{$facility_tret_name->treatment_name}}
                                        @else
                                            Not Set
                                        @endif
                                    </td>
                                    <td>{{$cpt->cpt_code}}</td>
                                    <td>
                                        <a href="#editcptcode{{$cpt->id}}" data-toggle="modal"><i
                                                class="ri-edit-box-line px-2"></i></a>|
                                        <a href="{{route('superadmin.setting.cpt.code.delete',$cpt->id)}}"><i
                                                class="ri-delete-bin-line text-danger px-2"></i></a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editcptcode{{$cpt->id}}" data-backdrop="static">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4>Add/Edit Cpt Code</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;
                                                </button>
                                            </div>
                                            <form action="{{route('superadmin.setting.cpt.code.update')}}"
                                                  method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <form action="#" method="post">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Tx Type</label>
                                                                <select class="form-control form-control-sm"
                                                                        name="edit_facility_treatment_id" required>
                                                                    <option value=""></option>
                                                                    @foreach($facility_treatment as $treat_type)
                                                                        <option
                                                                            value="{{$treat_type->id}}" {{$treat_type->id == $cpt->facility_treatment_id ? 'selected' : ''}}>{{$treat_type->treatment_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <input type="hidden"
                                                                       class="form-control form-control-sm"
                                                                       name="cpt_code_edit" value="{{$cpt->id}}">
                                                            </div>
                                                            @if($name_location->is_combo != 1)
                                                                <div class="col-md-6">
                                                                    <label>Cpt Code</label>
                                                                    <input type="text"
                                                                           class="form-control form-control-sm"
                                                                           name="edit_cpt_code"
                                                                           value="{{$cpt->cpt_code}}"
                                                                           required>

                                                                </div>
                                                            @else
                                                                <?php
                                                                $get_ctps = $cpt->cpt_code;
                                                                $exp_ctps = explode(",", $get_ctps);

                                                                ?>

                                                                @foreach($exp_ctps as $cpt => $value)
                                                                    <div class="col-md-6">
                                                                        <label>Cpt Code</label>
                                                                        <div class="input-group">
                                                                            <input type="text"
                                                                                   class="form-control form-control-sm"
                                                                                   name="edit_cpt_code[]"
                                                                                   value="{{$value}}"
                                                                                   required="">
                                                                            @if($cpt == 0)
                                                                                <div class="input-group-append">
                                                                                    <button
                                                                                        class="btn btn-sm btn-primary addcptmoreedit"
                                                                                        type="button"><i
                                                                                            class="las la-plus"></i>
                                                                                    </button>
                                                                                </div>
                                                                            @else
                                                                                <button class="btn btn-sm btn-danger"
                                                                                        type="button" id="removecpt"><i
                                                                                        class="ri-delete-bin-line"></i>
                                                                                </button>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6"></div>
                                                                @endforeach
                                                                <div class="col-md-6">
                                                                    <div class="duplicate-cpt-edit mt-2"></div>
                                                                </div>
                                                            @endif

                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                            </tbody>
                        </table>
                        {{$all_cpt_codes->links()}}
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
@section('js')

    <script>
        $(document).ready(function () {
            $('.addcptmore').click(function (e) {
                $('.duplicate-cpt').append(`
	<label>Cpt Code</label>
	<div class="input-group">
		<input type="text" class="form-control form-control-sm"
			name="cpt_code[]" required="" autocomplete="nope">
		<div class="input-group-append">
			<button class="btn btn-sm btn-danger"
				type="button" id="removecpt"><i
					class="ri-delete-bin-line"></i></button>
		</div>
	</div>`);
            });


            $('.addcptmoreedit').click(function () {
                $('.duplicate-cpt-edit').append(`
	<label>Cpt Code</label>
	<div class="input-group">
		<input type="text" class="form-control form-control-sm"
			name="edit_cpt_code[]" required="" autocomplete="nope">
		<div class="input-group-append">
			<button class="btn btn-sm btn-danger"
				type="button" id="removecpt"><i
					class="ri-delete-bin-line"></i></button>
		</div>
	</div>`);
            })

        })
    </script>
@endsection
