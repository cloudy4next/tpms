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
                    <h5>Recent Exports</h5>
                    <table class="table table-sm table-bordered c_table">
                        <thead>
                        <tr>
                            <th>Created</th>
                            <th>Filename</th>
                            <th>Password</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <b>January 6, 2021</b> <span class="text-muted ml-2">1:27 PM</span>
                            </td>
                            <td>Lorem ipsum dolor sit amet.</td>
                            <td>Not protected</td>
                            <td><a href="#">Ready for download</a></td>
                        </tr>
                        <tr>
                            <td>
                                <b>January 6, 2021</b> <span class="text-muted ml-2">1:27 PM</span>
                            </td>
                            <td>Lorem ipsum dolor, sit amet.</td>
                            <td>Not protected</td>
                            <td><a href="#">Ready for download</a></td>
                        </tr>
                        <tr>
                            <td>
                                <b>January 6, 2021</b> <span class="text-muted ml-2">1:27 PM</span>
                            </td>
                            <td>Lorem ipsum dolor sit, amet.</td>
                            <td>Not protected</td>
                            <td><a href="#">Ready for download</a></td>
                        </tr>
                        <tr>
                            <td>
                                <b>January 6, 2021</b> <span class="text-muted ml-2">1:27 PM</span>
                            </td>
                            <td>Lorem ipsum dolor sit amet.</td>
                            <td>Not protected</td>
                            <td><a href="#">Ready for download</a></td>
                        </tr>
                        <tr>
                            <td>
                                <b>January 6, 2021</b> <span class="text-muted ml-2">1:27 PM</span>
                            </td>
                            <td>Lorem ipsum, dolor sit amet.</td>
                            <td>Not protected</td>
                            <td><a href="#">Ready for download</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
