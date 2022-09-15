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
                    <h5>Forms Builders</h5>
                    <a href="{{route('superadmin.setting.forms.builder.create')}}"
                       class="btn btn-sm btn-primary pull-right mb-3">+Create New
                        Form</a>

                    <table class="table table-sm table-bordered c_table">
                        <thead>
                        <tr>
                            <th width="50%">Template Name</th>
                            <th width="30%">Template Type</th>
                            <th width="20%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($forms as $form)
                            <tr>
                                <td>
                                    {{$form->template_name}}
                                </td>
                                <td>
                                    @if($form->template_type=="behavior")
                                    Behavior
                                    @elseif($form->template_type=="mental")
                                    Mental
                                    @elseif($form->template_type=="speech")
                                    Speech
                                    @endif

                                </td>
                                <td>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <a href="{{route('superadmin.setting.forms.builder.template.view',$form->id)}}" target="_blank" title="View"><i class="ri-eye-line"></i></a>
                                        </li>
                                        @if($form->session_id == null || $form->session_id == '')
                                        <li class="list-inline-item">
                                            <a href="{{route('superadmin.setting.forms.builder.template.edit',$form->id)}}" target="_blank"><i class="las la-edit" title="Edit"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="{{route('superadmin.setting.forms.builder.template.delete',$form->id)}}" title="Delete"><i class="ri-delete-bin-6-line text-danger"></i></a>
                                        </li>
                                        @endif
                                        <li class="list-inline-item">
                                            <a href="{{route('superadmin.setting.forms.builder.template.duplicate',$form->id)}}" title="Duplicate" target="_blank"><i class="fa fa-clone text-success"></i></a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

