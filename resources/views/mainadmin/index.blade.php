@extends('layouts.MainAdmin')
@section('mainadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <h5>Welcome to Admin site</h5>
            <ul class="list-unstyled">
                <li><a href="{{route('mainadmin.provider.access')}}">Provider Access</a></li>
                <li><a href="{{route('mainadmin.admin.access')}}">Admin Access</a></li>
                <li><a href="{{route('mainadmin.payor.manager')}}">Payor</a></li>
                <li><a href="{{route('mainadmin.company.facility')}}">Companies & Facilities</a></li>
                <li><a href="companyCsv.html">Company Level CSV Report</a></li>
                <li><a href="userpagePermission.html">User Page Permission</a></li>
                <li><a href="addviewfacility.html">Add Views to the facility</a></li>
                <li><a href="manageCredential.html">Manage Credential</a></li>
                <li><a href="bulkUpload.html">Bulk Upload</a></li>
                <li><a href="{{route('mainadmin.billerlog.user')}}">Billerlog User</a></li>


            </ul>
        </div>
    </div>
@endsection
