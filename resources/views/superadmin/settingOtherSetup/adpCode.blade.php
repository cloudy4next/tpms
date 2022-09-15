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
                            <a class="nav-link " href="{{route('superadmin.setting.sub.activity.setup')}}">Service/Activity Sub Types</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('superadmin.setting.adp.codes')}}">ADP Codes</a>
                        </li>
                    </ul>
                    <button type="button" class="btn btn-sm btn-primary load_adp">Load ADP Code</button>
                    <!-- table -->
                    <div class="adp_table mt-2">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered c_table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Activity</th>
                                    <th>SubActivity</th>
                                    <th width="200px;">PayCode</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="checkbox" class="checkbox"></td>
                                    <td>Lorem, ipsum.</td>
                                    <td>Lorem, ipsum.</td>
                                    <td><input type="text" class="form-control form-control-sm"></td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="checkbox"></td>
                                    <td>Lorem, ipsum.</td>
                                    <td>Lorem, ipsum.</td>
                                    <td><input type="text" class="form-control form-control-sm"></td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="checkbox"></td>
                                    <td>Lorem, ipsum.</td>
                                    <td>Lorem, ipsum.</td>
                                    <td><input type="text" class="form-control form-control-sm"></td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="checkbox"></td>
                                    <td>Lorem, ipsum.</td>
                                    <td>Lorem, ipsum.</td>
                                    <td><input type="text" class="form-control form-control-sm"></td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="checkbox"></td>
                                    <td>Lorem, ipsum.</td>
                                    <td>Lorem, ipsum.</td>
                                    <td><input type="text" class="form-control form-control-sm"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Select Filter -->
                        <div class="d-flex mb-2">
                            <div class="mr-2 align-self-end">
                                <button type="button" class="btn btn-sm btn-primary mr-2">Select All</button>
                                <button type="button" class="btn btn-sm btn-primary">Unselect All</button>
                            </div>
                            <div class="mr-2 align-self-end updatepayroll">
                                <select class="form-control form-control-sm">
                                    <option value="0"></option>
                                    <option value="1">Update Paycode</option>
                                </select>
                            </div>
                            <div class="mr-2 align-self-end hour3">
                                <label>Hour3 Code</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="mr-2 align-self-end">
                                <button type="button" class="btn btn-sm btn-primary">OK</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary">Save ADP Code</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        jQuery(document).ready(function($) {
            $('.adp_table').hide();
            $('.hour3').hide();
            $('.load_adp').click(function(event) {
                $('.adp_table').show();
                $('.updatepayroll select').change(function(event) {
                    var v = $(this).val();
                    if (v == 1) {
                        $('.hour3').show();
                    } else
                        $('.hour3').hide();
                });
            });
        });
    </script>
@endsection
