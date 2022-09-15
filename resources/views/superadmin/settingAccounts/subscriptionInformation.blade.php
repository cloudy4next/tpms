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
                            <a class="nav-link active" href="{{route('superadmin.setting.subscription.information')}}">Billing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.setting.subscription.information.billing')}}">Invoices</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="card border">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-md-6 align-self-center">
                                        <h5>Telehealth by SimplePractice</h5>
                                        <p>Add Telehealth to all of your practice management needs in one secure, HIPAA-compliant place. Easy for both you and your clients, and fully mobile; $10 a month.</p>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="collapse" data-target="#smore">Show More</button>
                                    </div>
                                    <div class="col-md-6 align-self-center">
                                        <img src="../images/client/subcription-info.png" class="img-fluid" alt="subcription-info">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card border border-top-0 collapse" id="smore">
                            <div class="card-body pb-0">
                                <h6 class="mb-3">Here are 6 reasons you’ll love Telehealth:</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="text-dark font-weight-bold"><i class="fa fa-check-circle-o text-success mr-2"></i>Fully integrated in your SimplePractice account</h6>
                                        <p class="ml-4">No need to manage different logins and services</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="text-dark font-weight-bold"><i class="fa fa-check-circle-o text-success mr-2"></i>Simple and stress-free for you and your clients</h6>
                                        <p class="ml-4">No need to manage different logins and services</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="text-dark font-weight-bold"><i class="fa fa-check-circle-o text-success mr-2"></i>Fully integrated in your SimplePractice account</h6>
                                        <p class="ml-4">No need to manage different logins and services</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="text-dark font-weight-bold"><i class="fa fa-check-circle-o text-success mr-2"></i>Fully integrated in your SimplePractice account</h6>
                                        <p class="ml-4">No need to manage different logins and services</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="text-dark font-weight-bold"><i class="fa fa-check-circle-o text-success mr-2"></i>Fully integrated in your SimplePractice account</h6>
                                        <p class="ml-4">No need to manage different logins and services</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="text-dark font-weight-bold"><i class="fa fa-check-circle-o text-success mr-2"></i>Fully integrated in your SimplePractice account</h6>
                                        <p class="ml-4">No need to manage different logins and services</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table s_table my-4">
                            <tr>
                                <th>Professional Plan</th>
                                <td>
                                    <p><b>$59/month</b><a href="#" class="ml-3">Change Plan</a></p>
                                    <p>Your next charge will be $59 on January 27, 2021</p>
                                    <p>Your card on file is Visa ending in 4343 <a href="#" class="ml-3">Edit Payment Info</a></p>
                                    <p>Your customer ID: cus_H6tEqhmKJ3izti</p>
                                </td>
                            </tr>
                        </table>
                        <h5>Insurance Filing</h5>
                        <p>Filing period: 12/16/2020 - 01/15/2021</p>
                        <p>Claims filed in current period: 0</p>
                        <p>Coverage reports requested in current period: 0</p>
                        <p>Total Balance: $0</p>
                        <a href="#" class="btn btn-primary">Choose an insurance package and save</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
