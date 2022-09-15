@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="overflow-hidden mb-3">
                <div class="float-left">
                    <h2 class="common-title">Download History</h2>
                </div>
                <div class="float-right">

                </div>
            </div>
            <div class="table-responsive">
                <table class="table c_table table-sm table-bordered">
                    <thead>
                    <tr>
                        <th style="width:20px;">Sl No.</th>
                        <th>File Name</th>
                        <th>Download Time</th>
                        <th>Downloaded By</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    ?>
                    @foreach($all_report_export as $report_exp)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>
                                @if($report_exp->report_name=="kpi")
                                {{$report_exp->file_name}}.pdf
                                @else
                                {{$report_exp->file_name}}.csv
                                @endif
                            </td>
                            <td>{{\Carbon\Carbon::parse($report_exp->notification_date)->format('m/d/Y')}}
                                at {{\Carbon\Carbon::parse($report_exp->notification_date)->format('g:i:a')}}</td>
                            <td>{{$report_exp->name}}</td>
                            <td class="text-primary">{{$report_exp->status}}</td>
                            <td class="text-primary">
                                @if ($report_exp->status == "Pending")

                                @elseif($report_exp->status == "Complete")
                                    {{--                                    <a href="{{route('superadmin.report.export.download',$report_exp->id)}}"--}}
                                    {{--                                       data-toggle="modal" data-target="#export{{$report_exp->id}}">Export</a>--}}

                                    <a href="{{$report_exp->file_name}}"
                                       data-toggle="modal" data-target="#export{{$report_exp->id}}">Export</a>

                                    <div class="modal fade" id="export{{$report_exp->id}}" data-backdrop="static">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4>Export Report</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                </div>
                                                <form action="{{route('superadmin.report.export.download')}}"
                                                      method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <h6>You can encrypt your file with password to prevent
                                                            unauthorized access to your data.</h6>
                                                        <!-- Export with additional fields -->

                                                        <!-- Export with password -->
                                                        <div class="encryption">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input"
                                                                           id="exportWithPassword">Encrypt with password<i
                                                                        class="ri-question-line"
                                                                        title="This password isn't saved anywhere. Hence the file can't be recovered if the password is forgotten. The password is case sensitive"></i>
                                                                </label>
                                                            </div>
                                                            <div class="row mt-2 pw">
                                                                <div class="col-md">
                                                                    <input type="password" name="password"
                                                                           class="form-control"
                                                                           placeholder="Enter password to encrypt with">
                                                                    <input type="hidden" name="report_id"
                                                                           value="{{$report_exp->id}}"
                                                                           class="form-control"
                                                                           placeholder="Enter password to encrypt with">
                                                                    <div class="invalid-feedback">Enter Password</div>
                                                                </div>
                                                                <div class="col-md">
                                                                    <input type="password" name="confirm_password"
                                                                           class="form-control"
                                                                           placeholder="Confirmed password">
                                                                    <div class="invalid-feedback">Enter Confirm
                                                                        Password
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Continue</button>
                                                        <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    Not Set
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$all_report_export->links()}}
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script>
        $('.fields').hide();
        $('.pw').hide();
        $('#exportWithField').click(function (event) {
            if ($(this).is(':checked')) {
                $("#exportWithPassword").prop("checked", false);
                $('.pw').hide();
                $('.fields').show(200);
            } else {
                $('.fields').hide(200);
            }
        });
        $('#exportWithPassword').click(function (event) {
            if ($(this).is(':checked')) {
                $("#exportWithField").prop("checked", false);
                $('.fields').hide();
                $('.pw').show(200);
            } else {
                $('.pw').hide(200);
            }
        });
        $(".c_table").tablesorter();
    </script>
@endsection
