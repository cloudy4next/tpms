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
                            <a class="nav-link active" href="{{route('superadmin.setting.hrnotetype')}}">HR Note Type
                                Setup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.setting.employee.position')}}">Employee
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
                    <!-- Alert -->
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        No Notes Found!
                        <button type="button" class="close text-primary" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Add note -->
                    <button type="button" class="btn btn-sm btn-primary addnote_btn">Add NoteType</button>
                    <div class="add_note">
                        <div class="d-flex mt-2">
                            <div class="align-self-end mr-2">
                                <label>Description</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="align-self-end">
                                <button type="button" class="btn btn-sm btn-primary mr-2">Save</button>
                                <button type="button" class="btn btn-sm btn-danger">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
