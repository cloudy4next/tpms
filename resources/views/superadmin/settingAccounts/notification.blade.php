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
                    <h5>Email notifications</h5>
                    <p>Control when and how often SimplePractice sends emails to you.</p>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="dae">
                        <label class="form-check-label" for="dae">
                            Daily Agenda Email
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="ese">
                        <label class="form-check-label" for="ese">
                            Evening Summary Email
                        </label>
                    </div>
                    <a href="#" class="btn btn-primary mt-2">Save Notification Settings</a>
                </div>
            </div>
        </div>
    </div>
@endsection
