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
                            <a class="nav-link active" href="{{route('superadmin.setting.game.goal')}}">Employee
                                Goals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.setting.game.goal.copay')}}">Copy Employee
                                Goal</a>
                        </li>
                    </ul>
                    <div class="d-flex mb-2">
                        <div class="align-self-end mr-2">
                            <label>Pay Period</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input class="form-control form-control-sm reportrange">
                            </div>
                        </div>
                        <div class="align-self-end">
                            <button type="button" class="btn btn-sm btn-primary load_goal">Load Goal</button>
                        </div>
                    </div>
                    <!-- Table -->
                    <div class="goal_table">
                        <table class="table table-sm table-bordered c_table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Provider Title</th>
                                <th>Provider Name</th>
                                <th width="150px;">Goal Points</th>
                                <th>Adjustment</th>
                                <th>Adjustment Date</th>
                                <th>Adjustment Comment</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Lorem, ipsum.</td>
                                <td>Lorem, ipsum.</td>
                                <td><input type="text" class="form-control form-control-sm"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Lorem, ipsum.</td>
                                <td>Lorem, ipsum.</td>
                                <td><input type="text" class="form-control form-control-sm"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Lorem, ipsum.</td>
                                <td>Lorem, ipsum.</td>
                                <td><input type="text" class="form-control form-control-sm"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Lorem, ipsum.</td>
                                <td>Lorem, ipsum.</td>
                                <td><input type="text" class="form-control form-control-sm"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Lorem, ipsum.</td>
                                <td>Lorem, ipsum.</td>
                                <td><input type="text" class="form-control form-control-sm"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Lorem, ipsum.</td>
                                <td>Lorem, ipsum.</td>
                                <td><input type="text" class="form-control form-control-sm"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Lorem, ipsum.</td>
                                <td>Lorem, ipsum.</td>
                                <td><input type="text" class="form-control form-control-sm"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Lorem, ipsum.</td>
                                <td>Lorem, ipsum.</td>
                                <td><input type="text" class="form-control form-control-sm"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Lorem, ipsum.</td>
                                <td>Lorem, ipsum.</td>
                                <td><input type="text" class="form-control form-control-sm"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Lorem, ipsum.</td>
                                <td>Lorem, ipsum.</td>
                                <td><input type="text" class="form-control form-control-sm"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                        <!-- Select -->
                        <div class="d-flex">
                            <div class="align-self-start mr-2">
                                <button type="button" class="btn btn-sm btn-primary mr-2">Select All</button>
                                <button type="button" class="btn btn-sm btn-primary">Unselect All</button>
                            </div>
                            <div class="align-self-start mr-2 select_goal">
                                <select class="form-control form-control-sm">
                                    <option value="0"></option>
                                    <option value="1">Goal</option>
                                    <option value="2">Adjustment</option>
                                </select>
                            </div>
                            <div class="align-self-start mr-2 goal">
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="align-self-start mr-2 adjustment">
                                <textarea class="form-control form-control-sm"></textarea>
                            </div>
                            <div class="align-self-start">
                                <button type="button" class="btn btn-sm btn-primary">Save Goal</button>
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
            $('.goal_table').hide();
            $('.goal').hide();
            $('.adjustment').hide();
            $('.load_goal').click(function (event) {
                $('.goal_table').show();
                $('.select_goal select').change(function (event) {
                    var v = $(this).val();
                    if (v == 1) {
                        $('.goal').show();
                        $('.adjustment').hide();
                    } else if (v == 2) {
                        $('.goal').show();
                        $('.adjustment').show();
                    } else {
                        $('.goal').hide();
                        $('.adjustment').hide();
                    }
                });
            });
        });
    </script>
@endsection
