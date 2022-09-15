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
                            <a class="nav-link " href="{{route('superadmin.setting.notes.forms')}}">My Forms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('superadmin.setting.template.library')}}">Forms
                                Library</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        {{--                        <h5>Explore our new template library.</h5>--}}
                        {{--                        <p class="mb-2">Discover new Progress Note, Intake Form, and Assessment templates in--}}
                        {{--                            our Template Library. Quickly add any template from here, and customize it as--}}
                        {{--                            you see fit.</p>--}}
                        <a class="btn btn-light rounded-0 collapse_btn mr-2" data-toggle="collapse"
                           href="#pnote">Progress Notes <i class="ri-arrow-down-s-line arrow_down"></i></a>
                        <div class="collapse" id="pnote">
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless m-0">
                                    @foreach($template_library as $tem)
                                        <tr>
                                            <td><a
                                                    href="{{route('superadmin.setting.template.library.from',['slug'=>$tem->template_slug,'id'=>$tem->id])}}"
                                                    target="_blank" class="text-muted">{{$tem->template_name}}</a></td>
                                            <td>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <a
                                                            href="{{route('superadmin.setting.template.library.from',['slug'=>$tem->template_slug,'id'=>$tem->id])}}"
                                                            target="_blank" class="text-muted"><i
                                                                class="ri-eye-line" title="View"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="{{route('superadmin.setting.template.library.apply',$tem->id)}}"
                                                           class="text-muted"><i class="ri-exchange-box-line"
                                                                                 title="Apply to notes"></i></a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                        <a class="btn btn-light rounded-0 collapse_btn mr-2" data-toggle="collapse"
                           href="#iform">Intake Forms <i class="ri-arrow-down-s-line arrow_down"></i></a>
                        <div class="collapse" id="iform">
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="info">
                                            <label class="form-check-label" for="info">
                                                <a href="setting-noteDetail.html">Release of Information</a>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <button type="button" class="btn" title="Preview"
                                                data-toggle="modal" data-target="#preview"><i
                                                class="ri-eye-fill text-primary"></i></button>
                                        <a href="setting-noteDetail.html" title="Add"><i
                                                class="ri-add-circle-line text-success"></i></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="child">
                                            <label class="form-check-label" for="child">
                                                <a href="setting-noteDetail.html">Speech Language Child
                                                    Intake Form</a>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <button type="button" class="btn" title="Preview"
                                                data-toggle="modal" data-target="#preview"><i
                                                class="ri-eye-fill text-primary"></i></button>
                                        <a href="setting-noteDetail.html" title="Add"><i
                                                class="ri-add-circle-line text-success"></i></i></a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <a class="btn btn-light rounded-0 collapse_btn" data-toggle="collapse"
                           href="#Assessments">Assessments <i
                                class="ri-arrow-down-s-line arrow_down"></i></a>
                        <div class="collapse" id="Assessments">
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="newtem">
                                            <label class="form-check-label" for="newtem">
                                                <a href="setting-noteDetail.html">New Template</a>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <button type="button" class="btn" title="Preview"
                                                data-toggle="modal" data-target="#preview"><i
                                                class="ri-eye-fill text-primary"></i></button>
                                        <a href="setting-noteDetail.html" title="Add"><i
                                                class="ri-add-circle-line text-success"></i></i></a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
