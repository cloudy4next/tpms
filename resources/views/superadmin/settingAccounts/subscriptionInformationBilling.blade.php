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
                            <a class="nav-link " href="{{route('superadmin.setting.subscription.information')}}">Billing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('superadmin.setting.subscription.information.billing')}}">Invoices</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <h5>View your SimplePractice Invoices</h5>
                        <p>Each time you are billed by SimplePractice, an invoice is created here and is also mailed to info@laurenhermann.org</p>
                        <table class="table table-sm table-bordered c_table">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>12/27/2020</td>
                                <td>$59.00</td>
                                <td>Paid</td>
                                <td><a href="#">View Invoice</a></td>
                            </tr>
                            <tr>
                                <td>12/27/2020</td>
                                <td>$59.00</td>
                                <td>Paid</td>
                                <td><a href="#">View Invoice</a></td>
                            </tr>
                            <tr>
                                <td>12/27/2020</td>
                                <td>$59.00</td>
                                <td>Paid</td>
                                <td><a href="#">View Invoice</a></td>
                            </tr>
                            <tr>
                                <td>12/27/2020</td>
                                <td>$59.00</td>
                                <td>Paid</td>
                                <td><a href="#">View Invoice</a></td>
                            </tr>
                            <tr>
                                <td>12/27/2020</td>
                                <td>$59.00</td>
                                <td>Paid</td>
                                <td><a href="#">View Invoice</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
