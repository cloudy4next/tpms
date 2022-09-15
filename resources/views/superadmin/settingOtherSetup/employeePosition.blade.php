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
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.setting.employee.setup')}}">Credential
                                Setup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{route('superadmin.setting.hrnotetype')}}">HR Note Type
                                Setup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('superadmin.setting.employee.position')}}">Employee
                                Position</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.setting.game.goal')}}">Employee Goals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.setting.game.goal.copay')}}">Copy Employee
                                Goal</a>
                        </li>
                    </ul>
                    <div class="mb-2">
                        <button type="button" class="btn btn-sm btn-primary mr-2 addPos_btn">Add Position</button>
                        <button type="button" class="btn btn-sm btn-primary showPos_btn">Show Position</button>
                    </div>
                    <!-- Show Position -->
                    <div class="show_pos">
                        <table class="table table-sm table-bordered c_table">
                            <thead>
                            <tr>
                                <th>Position</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Accounting</td>
                                <td><a href="#"><i class="ri-delete-bin-line"></i></a></td>
                                <td><a href="#"><i class="ri-edit-box-line addPos_btn"></i></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Add Position -->
                    <div class="add_pos">
                        <h6>Add/Edit Position</h6>
                        <div class="d-flex">
                            <div class="align-self-end mr-2">
                                <label>Description</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="align-self-end">
                                <button type="button" class="btn btn-sm btn-primary mr-2">Save</button>
                                <button type="button" class="btn btn-sm btn-danger cancel_btn">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        jQuery(document).ready(function ($) {
            $('.show_pos').hide();
            $('.add_pos').hide();
            $('.addPos_btn').click(function (event) {
                event.preventDefault();
                $('.add_pos').show();
                $('.cancel_btn').click(function (event) {
                    $('.add_pos').hide();
                });
            });
            $('.showPos_btn').click(function (event) {
                $('.show_pos').show();
            });
        });
    </script>
@endsection
