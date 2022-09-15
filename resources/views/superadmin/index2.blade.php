@php
if (\Auth::user()->is_up_admin == 1) {
    $admin_id = Auth::user()->id;
} else {
    $admin_id = Auth::user()->up_admin_id;
}

@endphp


@extends('layouts.superadmin')
@section('css')
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
@endsection
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <h2 class="common-title">Dashboard</h2>
            <!-- shortcut -->
            <div class="row">
                <!-- dashboard-summary -->
                <div class="col-md-3">
                    <div class="card dashboard-summary">
                        <div class="card-body iq-bg-primary">
                            <div class="d-flex justify-content-between">
                                <div class="rounded-circle iq-card-icon bg-primary align-self-center">
                                    <i class="ri-user-fill"></i>
                                </div>
                                <div class="text-right align-self-center">
                                    <h2 class="mb-0"><span class="counter">{{ $clients }}</span></h2>
                                    <h5 class="">Total No. of Patients</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- dashboard-summary -->
                <div class="col-md-3">
                    <div class="card dashboard-summary">
                        <div class="card-body iq-bg-danger">
                            <div class="d-flex justify-content-between">
                                <div class="rounded-circle iq-card-icon bg-danger align-self-center">
                                    <i class="ri-user-fill"></i>
                                </div>
                                <div class="text-right align-self-center">
                                    <h2 class="mb-0"><span class="counter">{{ $active_staffs }}</span></h2>
                                    <h5 class="">Total No. of Staffs</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- dashboard-summary -->
                <div class="col-md-3">
                    <div class="card dashboard-summary">
                        <div class="card-body iq-bg-info">
                            <div class="d-flex justify-content-between">
                                <div class="rounded-circle iq-card-icon bg-info align-self-center">
                                    <i class="ri-group-fill"></i>
                                </div>
                                <div class="text-right align-self-center">
                                    <h2 class="mb-0"><span class="counter">{{ $app_renders }}</span></h2>
                                    <h5 class="">Sessions Unrendered</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- dashboard-summary -->
                <div class="col-md-3">
                    <div class="card dashboard-summary">
                        <div class="card-body iq-bg-warning">
                            <div class="d-flex justify-content-between">
                                <div class="rounded-circle iq-card-icon bg-warning align-self-center">
                                    <i class="ri-hospital-line"></i>
                                </div>
                                <div class="text-right align-self-center">
                                    <h2 class="mb-0"><span class="counter">{{ count($count_bot_billed) }}</span></h2>
                                    <h5 class="">Unbilled Claims</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- dashboard-summary -->
            </div>

            <!-- <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="card pie-card">
                                                                            <div class="card-body">
                                                                                <div class="piechart piechart1"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <div class="piechart piechart2"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <div class="piechart piechart3"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> -->
            <!-- pie chart -->
            <div class="row">
                <!-- dashboard-card -->
                <div class="col-md-4">
                    <div class="card dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title">Patient</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2">Report</th>
                                        <th>Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2"><a href="{{ route('superadmin.auth.to.expire') }}">Expiring
                                                Authorization</a>
                                        </td>
                                        <?php
                                        $now_date = \Carbon\Carbon::now()->format('Y-m-d');
                                        $next_date = \Carbon\Carbon::now()
                                            ->addDays(60)
                                            ->format('Y-m-d');

                                        $client_auths_count = \App\Models\Client_authorization::where('admin_id', $admin_id)
                                            ->where('end_date', '<=', $next_date)
                                            ->where('end_date', '>=', $now_date)
                                            ->where('is_valid', 1)
                                            ->get();

                                        ?>
                                        <td class="count"><a
                                                href="{{ route('superadmin.auth.to.expire') }}">({{ count($client_auths_count) }}
                                                )</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><a
                                                href="{{ route('superadmin.non.payor.tag') }}">Patient/Guarantor pay
                                                Clients</a>
                                        </td>
                                        <?php
                                        if (Auth::user()->is_up_admin == 1) {
                                            $client_auths = \App\Models\Client_authorization::select('client_id')
                                                ->where('admin_id', Auth::user()->id)
                                                ->where('payor_id', 12)
                                                ->get();
                                        } else {
                                            $client_auths = \App\Models\Client_authorization::select('client_id')
                                                ->where('admin_id', Auth::user()->up_admin_id)
                                                ->where('payor_id', 12)
                                                ->get();
                                        }

                                        ?>
                                        <td class="count"><a
                                                href="{{ route('superadmin.non.payor.tag') }}">({{ count($client_auths) }}
                                                )</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><a
                                                href="{{ route('superadmin.no.authorization') }}">Authorization Missing</a>
                                        </td>
                                        <?php
                                        if (Auth::user()->is_up_admin == 1) {
                                            $client_auths = \App\Models\Client_authorization::select('client_id')
                                                ->where('admin_id', Auth::user()->id)
                                                ->get();
                                            $array = [];
                                            foreach ($client_auths as $clau_id) {
                                                array_push($array, $clau_id->client_id);
                                            }

                                            $clients = \App\Models\Client::select('id', 'admin_id')
                                                ->whereNotIn('id', $array)
                                                ->where('admin_id', Auth::user()->id)
                                                ->get();
                                        } else {
                                            $client_auths = \App\Models\Client_authorization::select('client_id')
                                                ->where('admin_id', Auth::user()->up_admin_id)
                                                ->get();
                                            $array = [];
                                            foreach ($client_auths as $clau_id) {
                                                array_push($array, $clau_id->client_id);
                                            }

                                            $clients = \App\Models\Client::select('id', 'admin_id')
                                                ->whereNotIn('id', $array)
                                                ->where('admin_id', Auth::user()->up_admin_id)
                                                ->get();
                                        }

                                        ?>
                                        <td class="count"><a
                                                href="{{ route('superadmin.no.authorization') }}">({{ count($clients) }}
                                                )</a></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><a href="{{ route('superadmin.todays.copay') }}"> Co-Pay For
                                                Today</a>
                                        </td>

                                        <?php
                                        if (Auth::user()->is_up_admin == 1) {
                                            $client_auths = \App\Models\Client_authorization::select('client_id', 'copay')
                                                ->where('admin_id', Auth::user()->id)
                                                ->where('copay', '!=', null)
                                                ->get();

                                            $array = [];
                                            foreach ($client_auths as $cl_au) {
                                                array_push($array, $cl_au->client_id);
                                            }

                                            $apps = \App\Models\Appoinment::select('client_id', 'schedule_date')
                                                ->whereIn('client_id', $array)
                                                ->where('admin_id', Auth::user()->id)
                                                ->where('schedule_date', \Carbon\Carbon::now()->format('Y-m-d'))
                                                ->get();
                                        } else {
                                            $client_auths = \App\Models\Client_authorization::select('client_id', 'copay')
                                                ->where('admin_id', Auth::user()->up_admin_id)
                                                ->where('copay', '!=', null)
                                                ->get();

                                            $array = [];
                                            foreach ($client_auths as $cl_au) {
                                                array_push($array, $cl_au->client_id);
                                            }

                                            $apps = \App\Models\Appoinment::select('client_id', 'schedule_date')
                                                ->whereIn('client_id', $array)
                                                ->where('admin_id', Auth::user()->up_admin_id)
                                                ->where('schedule_date', \Carbon\Carbon::now()->format('Y-m-d'))
                                                ->get();
                                        }

                                        ?>
                                        <td class="count"><a
                                                href="{{ route('superadmin.todays.copay') }}">({{ count($apps) }}
                                                )</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><a href="{{ route('superadmin.home.auth.placeholder') }}">Auth
                                                Place
                                                Holders</a>
                                        </td>
                                        <?php
                                        $client_auth_count = \App\Models\Client_authorization::where('is_placeholder', 1)
                                            ->where('admin_id', $admin_id)
                                            ->get();
                                        ?>
                                        <td class="count"><a
                                                href="{{ route('superadmin.home.auth.placeholder') }}">({{ count($client_auth_count) }}
                                                )</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- dashboard-card -->
                <div class="col-md-4">
                    <div class="card dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title">Staffs</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2">Report</th>
                                        <th>Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2"><a href="{{ route('superadmin.vacation.pending') }}">Vacation(s)
                                                Pending
                                                Approval</a></td>
                                        <td class="count"><a href="{{ route('superadmin.vacation.pending') }}">(0)</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <?php
                                        if (Auth::user()->is_up_admin == 1) {
                                            $get_empo = \App\Models\Employee::select('id', 'admin_id')
                                                ->where('admin_id', Auth::user()->id)
                                                ->get();
                                        } else {
                                            $get_empo = \App\Models\Employee::select('id', 'admin_id')
                                                ->where('admin_id', Auth::user()->up_admin_id)
                                                ->get();
                                        }

                                        $array_no_con = [];
                                        foreach ($get_empo as $gemn) {
                                            $check_cren = \App\Models\Employee_credential::where('employee_id', $gemn->id)->count();
                                            if ($check_cren <= 0) {
                                                array_push($array_no_con, $gemn->id);
                                            }
                                        }

                                        $count_not_cren = \App\Models\Employee::whereIn('id', $array_no_con)->get();
                                        ?>
                                        <td colspan="2"><a
                                                href="{{ route('superadmin.home.missing.credntials') }}">Missing
                                                Credentials</a>
                                        </td>
                                        <td class="count"><a
                                                href="{{ route('superadmin.home.missing.credntials') }}">({{ count($count_not_cren) }}
                                                )</a></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><a href="{{ route('superadmin.credntials.expire') }}">Expired
                                                Credentials</a></td>
                                        <?php
                                        $array = [];
                                        foreach ($get_empo as $gem) {
                                            array_push($array, $gem->id);
                                        }
                                        $cot_now_dt = \Carbon\Carbon::now()->format('Y-m-d');
                                        $count_exp_cren = \App\Models\Employee_credential::whereIn('employee_id', $array)
                                            ->where('credential_date_expired', '<', $cot_now_dt)
                                            ->get();

                                        ?>
                                        <td class="count"><a
                                                href="{{ route('superadmin.credntials.expire') }}">({{ count($count_exp_cren) }}
                                                )</a></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><a
                                                href="{{ route('superadmin.singature.not.upload') }}">Sessions missing
                                                Patient/Provider Signature</a></td>
                                        <td class="count"><a
                                                href="{{ route('superadmin.singature.not.upload') }}">(0)</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- dashboard-card -->
                <div class="col-md-4">
                    <div class="card dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title">Scheduler</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2">Report</th>
                                        <th>Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2"><a
                                                href="{{ route('superadmin.scheduled.not.renderes') }}">Scheduled
                                                Not
                                                Rendered</a></td>
                                        <?php
                                        if (Auth::user()->is_up_admin == 1) {
                                            $not_rendered_count = \App\Models\Appoinment::where('admin_id', Auth::user()->id)
                                                ->where('status', 'Scheduled')
                                                ->orderBy('schedule_date', 'desc')
                                                ->get();
                                        } else {
                                            $not_rendered_count = \App\Models\Appoinment::where('admin_id', Auth::user()->up_admin_id)
                                                ->where('status', 'Scheduled')
                                                ->orderBy('schedule_date', 'desc')
                                                ->get();
                                        }

                                        ?>
                                        <td class="count"><a
                                                href="{{ route('superadmin.scheduled.not.renderes') }}">({{ count($not_rendered_count) }}
                                                )</a></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><a
                                                href="{{ route('superadmin.scheduled.not.atten.lastweek') }}">Sessions
                                                Not Attended
                                                Last Week</a></td>
                                        <?php
                                        $now = \Carbon\Carbon::now()->format('Y-m-d');
                                        $lastsev_day = \Carbon\Carbon::now()
                                            ->subDays(7)
                                            ->format('Y-m-d');

                                        $not_attended_last_week = \App\Models\Appoinment::where('admin_id', $admin_id)
                                            ->where(function ($q) {
                                                $q->where('status', 'Cancelled by Client')
                                                    ->orWhere('status', 'Cancelled by Provider')
                                                    ->orWhere('status', 'CC more than 24 hrs')
                                                    ->orWhere('status', 'CC less than 24 hrs')
                                                    ->orWhere('status', 'No Show');
                                            })
                                            ->where('schedule_date', '>=', $lastsev_day)
                                            ->where('schedule_date', '<=', $now)
                                            ->get();

                                        ?>
                                        <td class="count"><a
                                                href="{{ route('superadmin.scheduled.not.atten.lastweek') }}">({{ count($not_attended_last_week) }}
                                                )</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><a
                                                href="{{ route('superadmin.home.provider.missing.sign') }}">Provider
                                                Signature Missing
                                                In
                                                Session</a></td>

                                        @php
                                            if (Auth::user()->is_up_admin == 1) {
                                                $sign = \App\Models\Appoinment_signature::where('admin_id', Auth::user()->id)
                                                    ->where('signature', '!=', null)
                                                    ->get();
                                            } else {
                                                $sign = \App\Models\Appoinment_signature::where('admin_id', Auth::user()->up_admin_id)
                                                    ->where('signature', '!=', null)
                                                    ->get();
                                            }

                                            $arr = [];

                                            if (count($sign) > 0) {
                                                foreach ($sign as $sig) {
                                                    array_push($arr, $sig->session_id);
                                                }
                                            }

                                            if (Auth::user()->is_up_admin == 1) {
                                                $counting = \App\Models\Appoinment::select('client_id', 'provider_id')
                                                    ->whereNotIn('id', $arr)
                                                    ->where('admin_id', Auth::user()->id)
                                                    ->get();
                                            } else {
                                                $counting = \App\Models\Appoinment::select('client_id', 'provider_id')
                                                    ->whereNotIn('id', $arr)
                                                    ->where('admin_id', Auth::user()->up_admin_id)
                                                    ->get();
                                            }

                                        @endphp


                                        <td class="count"><a
                                                href="{{ route('superadmin.home.provider.missing.sign') }}">({{ count($counting) }}
                                                )</a></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><a
                                                href="{{ route('superadmin.session.note.missing') }}">Session Note
                                                Missing</a>
                                        </td>
                                        <?php
                                        if (Auth::user()->is_up_admin == 1) {
                                            $notes_count = \App\Models\Appoinment_note::distinct()
                                                ->select('admin_id', 'appoinment_id')
                                                ->where('admin_id', Auth::user()->id)
                                                ->get();

                                            $array = [];
                                            foreach ($notes_count as $note) {
                                                array_push($array, $note->appoinment_id);
                                            }

                                            $apps_count = \App\Models\Appoinment::whereNotIn('id', $array)
                                                ->where('admin_id', Auth::user()->id)
                                                ->get();
                                        } else {
                                            $notes_count = \App\Models\Appoinment_note::select('admin_id', 'appoinment_id')
                                                ->where('admin_id', Auth::user()->up_admin_id)
                                                ->get();

                                            $array = [];
                                            foreach ($notes_count as $note) {
                                                array_push($array, $note->appoinment_id);
                                            }

                                            $apps_count = \App\Models\Appoinment::whereNotIn('id', $array)
                                                ->where('admin_id', Auth::user()->up_admin_id)
                                                ->get();
                                        }

                                        ?>
                                        <td class="count"><a
                                                href="{{ route('superadmin.session.note.missing') }}">({{ count($apps_count) }}
                                                )</a>
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                    <td colspan="2"><a href="{{route('superadmin.cancelled.session')}}">Cancelled
                                            Session This
                                            Month</a>
                                    </td>
                                    <?php
                                    $v1 = 'Cancelled by Client';
                                    $v2 = 'CC more than 24 hrs';
                                    $v3 = 'CC less than 24 hrs';
                                    $v4 = 'Cancelled by Provider';

                                    if (Auth::user()->is_up_admin == 1) {
                                        $apps_cancelled_count = \App\Models\Appoinment::where('admin_id', Auth::user()->id)
                                            ->where(function ($query) use ($v1, $v2, $v3, $v4) {
                                                $query->where('status', '=', $v1);
                                                $query->orWhere('status', '=', $v2);
                                                $query->orWhere('status', '=', $v3);
                                                $query->orWhere('status', '=', $v4);
                                            })
                                            ->get();
                                    } else {
                                        $apps_cancelled_count = \App\Models\Appoinment::where('admin_id', Auth::user()->up_admin_id)
                                            ->where(function ($query) use ($v1, $v2, $v3, $v4) {
                                                $query->where('status', '=', $v1);
                                                $query->orWhere('status', '=', $v2);
                                                $query->orWhere('status', '=', $v3);
                                                $query->orWhere('status', '=', $v4);
                                            })
                                            ->get();
                                    }

                                    ?>
                                    <td class="count"><a
                                            href="{{route('superadmin.cancelled.session')}}">({{count($apps_cancelled_count)}}
                                            )</a></td>
                                </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
