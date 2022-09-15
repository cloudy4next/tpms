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
                    <h5 class="pull-left">Meet Lists</h5>
                    <a href="{{route('superadmin.meet.create')}}" class="btn btn-sm btn-primary pull-right">+Create New
                        Meet</a>
                    <br>
                    <table class="table table-sm table-bordered c_table">
                        <thead>
                        <tr>
                            <th>Meet Link</th>
                            <th>Created Date</th>
                            <th>Video URL</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($meets as $meet)
                            <tr>
                                <td>
                                    {{$meet->meet_url}}
                                </td>
                                <td>
                                    {{\Carbon\Carbon::parse($meet->created_at)->format('m/d/Y')}}
                                </td>
                                <td>
                                    {{$meet->video_url}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$meets->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
