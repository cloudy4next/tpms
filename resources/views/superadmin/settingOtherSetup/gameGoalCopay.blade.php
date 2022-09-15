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
                            <a class="nav-link " href="{{route('superadmin.setting.employee.position')}}">Employee
                                Position</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{route('superadmin.setting.game.goal')}}">Employee Goals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('superadmin.setting.game.goal.copay')}}">Copy
                                Employee Goal</a>
                        </li>
                    </ul>
                    <div class="d-flex mb-2">
                        <div class="align-self-end mr-3">
                            <label>Source Pay Period</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input class="form-control form-control-sm reportrange">
                            </div>
                        </div>
                        <div class="align-self-end mr-3">
                            <label>Target Pay Period</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input class="form-control form-control-sm reportrange">
                            </div>
                        </div>
                        <div class="align-self-end">
                            <button type="button" class="btn btn-sm btn-primary">Copy Goal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
