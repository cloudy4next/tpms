@extends('layouts.MainAdmin')
@section('mainadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <!-- Tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('mainadmin.provider.access')}}">Facility</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('mainadmin.provider.create')}}">Create User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('mainadmin.provider.delete')}}">Delete User</a>
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
                    <label class="d-block">Facility</label>
                    <select class="form-control select2">
                        <option>A Balanced Child, PLLC(458)</option>
                        <option>ABA and Verbal Behavior Group(97)</option>
                        <option>ABA Behavioral Services LLC(159)</option>
                    </select>
                </div>
                <div class="align-self-end mr-2">
                    <label class="d-block">User Section(From Access Table)</label>
                    <select class="form-control select2">
                        <option>basestaffabach@webaba.com(Base Staff) (Staff) (MM)</option>
                    </select>
                </div>
                <div class="align-self-end mr-2">
                    <select class="form-control select2">
                        <option>Mimic</option>
                        <option>Super User(pull timesheet, render)</option>
                        <option>Manager Module Access</option>
                        <option>Allow MultiFacility Access</option>
                        <option>Delete Master access(Membership Table0</option>
                        <option>Delete Master access + clear user (Email)</option>
                        <option>Update Password</option>
                        <option>Update User(user table)</option>
                        <option>Update Master access + User</option>
                        <option>Allow Billing</option>
                    </select>
                </div>
                <div class="align-self-end">
                    <button type="button" class="btn btn-primary">Ok</button>
                </div>
            </div>
            <!-- Table -->
            <div class="row">
                <div class="col-md-4">
                    <label>Available Page(s)</label>
                    <select class="form-control" multiple style="min-height: 300px;">
                        <option></option>
                    </select>
                </div>
                <div class="col-md-3 align-self-center text-center">
                    <button class="btn btn-primary">Add</button>
                </div>
                <div class="col-md-4">
                    <label>Allocated Page(s)</label>
                    <table class="table table-sm table-bordered c_table">
                        <thead>
                        <tr>
                            <th>Remove</th>
                            <th>Permission</th>
                            <th>Change</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Billing</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Clients</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>CSVReport</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Dashboard</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Help</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Payroll</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Reports</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Scheduler</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Staff</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>StaffHRNotes</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>StaffOtherSetup</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>StaffPayrollRate</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Submit</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Timesheet</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary">Save Permission</button>
                </div>
            </div>
        </div>
    </div>
@endsection
