<ul id="iq-sidebar-toggle" class="iq-menu">
    <?php
    $array = [];
    $admin_access = \Illuminate\Support\Facades\DB::table('admin_page_accesses')->where('admin_id', Auth::user()->id)->get();
    foreach ($admin_access as $access) {
        array_push($array, $access->page_id);
    }
    ?>

    @if(in_array(1,$array))
        <li>
            <a href="{{route('superadmin.dashboard')}}" class="iq-waves-effect"><i class="ri-home-4-line"></i><span>Dashboard</span></a>
        </li>

    @elseif(in_array(2,$array))
        <li>
            <a href="{{route('superadmin.dashboard2')}}" class="iq-waves-effect"><i class="ri-home-4-line"></i><span>Dashboard</span></a>
        </li>

    @endif

    @if(in_array(2,$array))
        <li>
            <a href="#m1" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i
                    class="fa fa-calendar"></i><span>Appointment</span><i
                    class="ri-arrow-right-s-line iq-arrow-right"></i></a>
            <ul id="m1" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                <li><a href="{{route('superadmin.manage.session')}}" class="iq-waves-effect"><i
                            class="ri-grid-fill"></i><span>List View</span></a></li>
                <li><a href="{{route('superadmin.calender.view')}}" class="iq-waves-effect"><i
                            class="ri-calendar-line"></i><span>Calendar View</span></a>
                </li>
                <li><a href="{{route('superadmin.recurring.session')}}" class="iq-waves-effect"><i
                            class="ri-links-line"></i><span>Recurring Session </span></a></li>
            </ul>
        </li>
    @endif

    @if(in_array(3,$array))
        <li class="{{ Request::path() == 'super-admin/client-list' ? 'active' : '' }}">
            <a href="{{route('superadmin.client.list')}}" class="iq-waves-effect"><i
                    class="fa fa-user-plus"></i><span>Patient(S) </span></a>
        </li>
    @endif

    @if(in_array(4,$array))
        <li>
            <a href="{{route('superadmin.employee')}}" class="iq-waves-effect"><i
                    class="fa fa-user-md"></i><span>Staffs</span></a>
        </li>
    @endif

    @if(in_array(5,$array))
        <li>
            <a href="#mailbox" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i
                    class="ri-exchange-dollar-line"></i><span>Billing</span><i
                    class="ri-arrow-right-s-line iq-arrow-right"></i></a>
            <ul id="mailbox" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                <li><a href="{{route('superadmin.billing')}}"><i class="lab la-hornbill"></i>Billing Manager</a>
                </li>
                {{--            <li><a href="{{route('superadmin.billing.claim.management')}}"><i class="ri-bill-line"></i>Manage Claims</a>--}}
                {{--            </li>--}}
                <li><a href="{{route('superadmin.billing.ledger')}}"><i class="lab la-gg"></i>AR-Ledger</a></li>
                <li><a href="{{route('superadmin.billing.ratelist')}}"><i class="ri-shield-star-line"></i>Contract
                        Rate</a>
                </li>
                <li><a href="{{route('superadmin.billing.statement')}}"><i class="ri-file-text-fill"></i>Patient
                        Statement</a></li>
            </ul>
        </li>
    @endif

    @if(in_array(6,$array))
        <li>
            <a href="#mailboxa" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i
                    class="fa fa-credit-card"></i><span>Payments</span><i
                    class="ri-arrow-right-s-line iq-arrow-right"></i></a>
            <ul id="mailboxa" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                <li><a href="{{route('superadmin.era.remittance')}}"><i
                            class="ri-file-text-fill"></i>E-Remittance</a>
                </li>
                <li><a href="{{route('superadmin.billing.deposit')}}"><i class="las la-donate"></i>Cash-Posting</a>
                </li>
                {{-- <li><a href="{{route('superadmin.era.manager')}}"><i class="ri-bill-line"></i>ERA Manager</a>
                </li> --}}

            </ul>
        </li>
    @endif

    @if(in_array(7,$array))
        <li>
            <a href="#mailboxp" class="iq-waves-effect" data-toggle="collapse" aria-expanded="true"><i
                    class="ri-file-shred-line"></i><span>Payroll</span><i
                    class="ri-arrow-right-s-line iq-arrow-right"></i></a>
            <ul id="mailboxp" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle" style="">
                <li><a href="{{route('superadmin.process.payroll')}}" class="iq-waves-effect"><i
                            class="ri-refund-line"></i><span>Processing Payroll</span></a></li>
                <li><a href="{{route('superadmin.payroll.timesheet')}}"><i class="ri-file-list-line"></i>Timesheet(s)
                        Submission</a></li>
            </ul>
        </li>
    @endif

    @if(in_array(8,$array))

        <li><a href="{{route('superadmin.report')}}" class="iq-waves-effect"><i
                    class="las la-chart-bar"></i><span>Report</span></a></li>
    @endif
    @if(in_array(9,$array))
        <li><a href="{{route('superadmin.setting.name.location')}}" class="iq-waves-effect"><i
                    class="las la-cogs"></i><span>Settings</span></a></li>
    @endif


</ul>
