@extends('layouts.MainAdmin')
@section('mainadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <!-- Tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="adminAccess.html">Page Access</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="createUser.html">Create User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="deleteUser.html">Delete User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="unlockUser.html">Unlock Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="switchUser.html">Switch User(Staff to Provider)</a>
                </li>
            </ul>
            <!-- Filter -->
            <div class="d-flex mb-3">
                <div class="align-self-end mr-2">
                    <label class="d-block">Sort By</label>
                    <select class="form-control sortbyuser">
                        <option value="0">select any</option>
                        <option value="1">Main Admin</option>
                        <option value="2">Sub Admin</option>
                    </select>
                </div>
                <div class="align-self-end mr-2">
                    <label class="d-block">Admins</label>
                    <select class="form-control  all_admin">

                    </select>
                </div>
                <div class="align-self-end">
                    <button type="button" class="btn btn-primary" id="ok_btn">Ok</button>
                </div>
            </div>
            <!-- Table -->
            <div class="row">
                <div class="col-md-4">
                    <label>Available Page(s)</label>
                    <select class="form-control all_page" multiple style="min-height: 300px;">

                    </select>
                </div>
                <div class="col-md-3 text-center mt-4">
                    <div class="mb-2">
                        <button class="btn btn-primary" id="add_page">Add</button>
                    </div>
                    <div>
                        <button class="btn btn-danger" id="remove_page">Remove</button>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Allocated Page(s)</label>
                    <select class="form-control allocate_page" multiple style="min-height: 300px;">

                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('mainadmin.adminaccess.include.adminAccessJs')
