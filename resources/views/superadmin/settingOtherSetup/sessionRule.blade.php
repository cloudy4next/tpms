@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <form action="{{route('superadmin.setting.session.rule.update')}}" method="post">
            @csrf
            <div class="iq-card-body">
                <div class="d-lg-flex">
                    <!-- menu -->
                    <div class="setting_menu">
                        @include('superadmin.include.settingMenu')
                    </div>
                    <!-- content -->
                    <div class="all_content flex-fill">
                        <div class="d-flex mb-2">

                        </div>
                        <!-- Table -->
                        <h6>Service Rules</h6>
                        <table class="table table-sm table-bordered c_table">
                            <thead>
                            <tr>

                                <th>Rule</th>
                                <th>Description/Message</th>
                                <th>Run Rule</th>
                                <th>Prevent Session Creation</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($get_rules as $rules)
                                <tr>

                                    <td>{{$rules->rule_name}}</td>
                                    <td>{!! $rules->rule_description !!}</td>
                                    <td>
                                        {{--                                        <input type="checkbox" class="is_active"--}}
                                        {{--                                               name="is_active" value="1" {{$rules->is_active == 1 ? 'checked' : ''}}>--}}
                                        <div class="custom-control custom-switch">
                                            @if ($rules->is_active == 1)

                                                <input type="checkbox" value="1" name="is_active"
                                                       class="custom-control-input clientactswt"
                                                       id="is_active{{$rules->id}}"
                                                       checked>
                                                <label class="custom-control-label"
                                                       for="is_active{{$rules->id}}">Yes</label>
                                            @else
                                                <input type="checkbox" value="2" name="is_active"
                                                       class="custom-control-input clientactswt"
                                                       id="is_active{{$rules->id}}"
                                                >
                                                <label class="custom-control-label"
                                                       for="is_active{{$rules->id}}">No</label>
                                            @endif
                                        </div>

                                        <input type="hidden" class="checked_dis" name="edit_id"
                                               value="{{$rules->id}}">
                                    </td>
                                    <td>
                                        {{--                                        <input type="checkbox" class="prevent_session" value="1"--}}
                                        {{--                                               name="prevent_session" {{$rules->prevent_session == 1 ? 'checked' : ''}}>--}}

                                        <div class="custom-control custom-switch">
                                            @if ($rules->prevent_session == 1)
                                                <input type="checkbox" name="prevent_session" value="1"
                                                       class="custom-control-input prevesess" id="presess{{$rules->id}}"
                                                       checked>
                                                <label class="custom-control-label"
                                                       for="presess{{$rules->id}}">Yes</label>
                                            @else
                                                <input type="checkbox" name="prevent_session" value="2"
                                                       class="custom-control-input prevesess" id="presess{{$rules->id}}"
                                                >
                                                <label class="custom-control-label"
                                                       for="presess{{$rules->id}}">No</label>
                                            @endif


                                        </div>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                        <!-- Select -->
                        <div class="d-flex">
                            <div class="align-self-end">
                                <button type="button" class="btn btn-sm btn-primary mr-2" id="savebtn">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {

            $('.clientactswt').change(function () {
                if ($(this).is(":checked")) {
                    $(this).parent().find('label').text('Yes');
                } else {
                    $(this).parent().find('label').text('No');
                }
            });

            $('.prevesess').change(function () {
                if ($(this).is(":checked")) {
                    $(this).parent().find('label').text('Yes');
                } else {
                    $(this).parent().find('label').text('No');
                }
            })


            $('#savebtn').click(function (e) {
                e.preventDefault();
                let ids = [];
                let actives = [];
                let prevents = [];


                $('.checked_dis').each(function () {
                    ids.push($(this).val());

                    if (jQuery(this).closest('tr').find("input[name='is_active']").prop('checked') === true) {
                        actives.push(1);
                    } else {
                        actives.push(0);
                    }

                    if (jQuery(this).closest('tr').find("input[name='prevent_session']").prop('checked') === true) {
                        prevents.push(1);
                    } else {
                        prevents.push(0);
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.setting.session.rule.update') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'ids': ids,
                        'actives': actives,
                        'prevents': prevents,

                    },
                    success: function (data) {
                        console.log(data)
                        if (data == 'done') {
                            toastr["success"]("Service Rules Updated Successfully", 'SUCCESS!');
                        } else {
                            toastr["error"]("Something Went Wrong", 'ALERT!');
                        }

                    }
                });


            })
        })
    </script>
@endsection
