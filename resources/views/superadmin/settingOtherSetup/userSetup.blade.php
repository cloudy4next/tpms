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
                    <!-- Filter -->
                    <div class="d-flex mb-2">
                        <div class="align-self-end mr-2">
                            <label>Select Any</label>
                            <select class="form-control form-control-sm user_type">
                                <option value=""></option>
                                <option value="1">Patient</option>
                                <option value="2">Staff</option>
                            </select>
                        </div>
                        <div class="align-self-end mr-2">
                            <label>Name</label>
                            <input type="text" class="form-control form-control-sm user_name">
                        </div>
                        <div class="align-self-end mr-2">
                            <label>Email</label>
                            <input type="email" class="form-control form-control-sm user_email">
                        </div>
                        <div class="align-self-end">
                            <button type="button" class="btn btn-sm btn-primary mr-2" id="search">Search</button>
                            <button type="button" class="btn btn-sm btn-danger">Cancel</button>
                        </div>
                    </div>
                    <!-- table -->
                    <div class="usertable"></div>
                    <!-- Select -->
                    <div class="d-flex action_type">
                        <div class="align-self-end mr-2 action_type">
                            <select class="form-control form-control-sm">
                                <option>Choose Any</option>
                                <option>Unlock users</option>
                                <option>Activate users</option>
                            </select>
                        </div>
                        <div class="align-self-end">
                            <button type="button" class="btn btn-sm btn-primary action_typebtn">OK</button>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <div class="align-self-end mr-2 user_type">
                            <label>User Type</label>
                            <select class="form-control form-control-sm">
                                <option value="0"></option>
                                <option value="1">Provider</option>
                                <option value="2">Office Staff</option>
                                <option value="3">Patient</option>
                            </select>
                        </div>
                        <div class="align-self-end">
                            <button type="button" class="btn btn-sm btn-primary" id="add_user">Add
                                User
                            </button>
                        </div>
                    </div>
                    <!-- Edit User -->
                    <div class="editusr">
                        <hr>
                        <h6 class="mb-2">Add/Edit User</h6>
                        <div class="row">
                            <div class="col-md-3 align-self-end mb-2">
                                <label>First Name</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-3 align-self-end mb-2">
                                <label>Last Name</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-3 align-self-end mb-2">
                                <label>User Email</label>
                                <input type="email" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-3 align-self-end mb-2">
                                <label>Display Name</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-3 align-self-end mb-2 schedule">
                                <label>Select</label>
                                <select class="form-control form-control-sm">
                                    <option>My Schedule Access Only</option>
                                    <option>My Schedule + Edit Own Schedule</option>
                                    <option>My Schedule + Edit Own Schedule + View All</option>
                                    <option>My Schedule + View/Edit All</option>
                                </select>
                            </div>
                            <div class="col-md-3 align-self-end mb-2 csv">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input">Report CSV
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 align-self-end">
                                <hr>
                                <button type="button" class="btn btn-sm btn-primary mr-2">Create/Edit
                                    User
                                </button>
                                <button type="button" class="btn btn-sm btn-danger"
                                        onclick="window.location.reload();">Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('superadmin.settingOtherSetup.include.userSetupJs')
