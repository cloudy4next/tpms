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
                    <h6>Zone Setup</h6>
                    <table class="table table-sm table-bordered c_table">
                        <thead>
                        <tr>
                            <th>Zone Id</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($all_zone as $zone)
                        <tr>
                            <td>{{$zone->id}}</td>
                            <td>{{$zone->name}}</td>
                            <td>{!! $zone->description !!}</td>
                            <td><a href="{{route('superadmin.setting.zone.setup.delete',$zone->id)}}"><i class="ri-delete-bin-line text-danger"></i></a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$all_zone->links()}}
                    <div class="overflow-hidden">
                        <button type="button" class="btn btn-sm btn-primary float-left add_zone">Add Zone</button>
                        <button type="button" class="btn btn-sm btn-primary float-right default_zone">Zone Default Provider</button>
                    </div>
                    <!-- create_zone -->
                    <div class="create_zone">
                        <hr>
                        <h6>Create Zone</h6>
                        <form action="{{route('superadmin.setting.zone.setup.save')}}" method="post">
                            @csrf
                            <div class="d-flex">
                                <div class="mr-3 form-inline">
                                    <label class="mr-2">Name</label>
                                    <input type="text" class="form-control form-control-sm" name="name" required>
                                </div>
                                <div class="mr-3 form-inline">
                                    <label class="mr-2">Description</label>
                                    <textarea class="form-control form-control-sm" name="description"></textarea>
                                </div>
                                <div class="align-self-center">
                                    <button type="submit" class="btn btn-sm btn-primary mr-2">Save</button>
                                    <button type="button" class="btn btn-sm btn-danger cancel_btn">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Default Provider -->
                    <div class="default_provider">
                        <hr>
                        <h6>Default Providers for Zone</h6>
                        <div class="d-inline-block mb-2">
                            <label>Zone</label>
                            <select class="form-control form-control-sm">
                                @foreach($all_zone_get as $al_zon)
                                <option value="{{$al_zon->id}}">{{$al_zon->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-4 align-self-center">
                                <label>All Providers</label>
                                <select class="form-control-sm form-control" multiple>
                                    @foreach($all_provider as $all_pro)
                                    <option value="{{$all_pro->id}}">{{$all_pro->first_name}} {{$all_pro->middle_name}} {{$all_pro->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 align-self-center text-center">
                                <button type="button" class="btn btn-sm btn-primary">Add &gt;&gt;</button>
                                <div class="my-2">
                                    <button type="button" class="btn btn-sm btn-danger">
                                        &lt;&lt; Remove</button>
                                </div>
                                <button type="button" class="btn btn-sm btn-danger cancel_btn2">Cancel</button>
                            </div>
                            <div class="col-md-4 align-self-center">
                                <label>Zone Default Providers</label>
                                <select class="form-control-sm form-control" multiple>
                                    <option></option>
                                </select>
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
        jQuery(document).ready(function($) {
            $('.create_zone').hide();
            $('.default_provider').hide();
            $('.add_zone').click(function(event) {
                $('.create_zone').show();
                $('.default_provider').hide();
                $('.cancel_btn').click(function(event) {
                    $('.create_zone').hide();
                });
            });
            $('.default_zone').click(function(event) {
                $('.default_provider').show();
                $('.create_zone').hide();
                $('.cancel_btn2').click(function(event) {
                    $('.default_provider').hide();
                });
            });
        });
    </script>
@endsection
