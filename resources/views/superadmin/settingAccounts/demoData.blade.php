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
                    <h5>We have included a demo client, Jamie Appleseed, to help you try out features in SimplePractice</h5>
                    <p>You can disable or enable Jamie Appleseed whenever you want.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
