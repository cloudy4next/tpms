<ul class="nav flex-column">
    <!-- Facility Setup  -->
    <li class="nav-item">
        <a href="javascript:void(0);" class="nav-link active">
            <i class="fa fa-medkit"></i>
            Facility Setup
        </a>
        <div id="facility">
            <a href="{{route('superadmin.setting.name.location')}}"
               class="{{ Request::path() == 'admin/settting/name-location' ? 'active' : '' }}"><i
                    class="ri-profile-line"></i>Name &amp;
                Location</a>
            <a href="{{route('superadmin.setting.addpayor')}}"
               class="{{ Request::path() == 'admin/settting/add-insurance' ? 'active' : '' }}"><i
                    class="ri-user-add-line"></i>Add Insurance</a>
            <a href="{{route('superadmin.setting.payorSetup')}}"
               class="{{ Request::path() == 'admin/settting/insurance-setup' ? 'active' : '' }}"><i
                    class="ri-settings-line"></i>Insurance Setup</a>
            <a href="{{route('superadmin.setting.add.treatment')}}"
               class="{{ Request::path() == 'admin/settting/add-treatment' ? 'active' : '' }}"><i
                    class="ri-hospital-line"></i>Add Treatments</a>
            <a href="{{route('superadmin.setting.services')}}"
               class="{{ Request::path() == 'admin/settting/services' ? 'active' : '' }}"><i class="ri-stack-line"></i>Add
                Services</a>
            <a href="{{route('superadmin.setting.cpt.code')}}"
               class="{{ Request::path() == 'admin/settting/cpt/code' ? 'active' : '' }}"><i class="ri-stack-line"></i>Add
                Cpt Code</a>
            <a href="{{route('superadmin.setting.cpt.code.exclusion')}}"
               class="{{ Request::path() == 'admin/settting/cpt/code/exclusion' ? 'active' : '' }}"><i class="ri-stack-line"></i>Cpt Code Exclusion(s)</a>
            <a href="{{route('superadmin.setting.sub.activity.setup')}}"
               class="{{ Request::path() == 'admin/settting/sub-activity-setup' ? 'active' : '' }}"><i
                    class="ri-navigation-line"></i>Add Service Sub-Type</a>
            <a href="{{route('superadmin.setting.add.employee')}}"
               class="{{ Request::path() == 'admin/settting/add-staff' ? 'active' : '' }}"><i
                    class="ri-user-add-line"></i>Add Staff Type</a>
            <a href="{{route('superadmin.setting.rendering.provider')}}"
               class="{{ Request::path() == 'admin/settting/rendering-provider' ? 'active' : '' }}"><i
                    class="ri-user-line"></i>Referring
                Provider</a>
            <a href="{{route('superadmin.setting.pos')}}"
               class="{{ Request::path() == 'admin/settting/pos' ? 'active' : '' }}"><i
                    class="ri-home-3-line"></i>Place of Service</a>
            <a href="{{route('superadmin.setting.vendor.number')}}"
               class="{{ Request::path() == 'admin/settting/vendor-number' ? 'active' : '' }}"><i
                    class="ri-notification-badge-line"></i>Vendor Number Setup</a>
            {{--            <a href="{{route('superadmin.setting.zone.setup')}}" class="{{ Request::path() == 'admin/settting/region-setup' ? 'active' : '' }}"><i class="ri-pin-distance-line"></i>Region Setup</a>--}}
            <a href="{{route('superadmin.setting.holiday.setup')}}"
               class="{{ Request::path() == 'admin/settting/holiday-setup' ? 'active' : '' }}"><i
                    class="ri-anchor-line"></i>Holiday Setup</a>
            <a href="{{route('superadmin.pay.period')}}"><i class="ri-bank-card-line"></i>Pay Period</a>

            <a href="{{route('superadmin.setting.logo')}}"
               class="{{ Request::path() == 'admin/settting/logo' ? 'active' : '' }}"><i class="ri-attachment-2"></i>Logo</a>
            <a href="{{route('superadmin.setting.unbillable.activity')}}"
               class="{{ Request::path() == 'admin/settting/unbillable-activity' ? 'active' : '' }}"><i
                    class="ri-folders-line"></i>Unbillable Activity</a>
            <a href="{{route('superadmin.unbillable.timesheet')}}"><i class="ri-folders-line"></i>Unbillable Timesheet</a>
            <a href="{{route('superadmin.setting.session.rule.setup')}}"
               class="{{ Request::path() == 'admin/settting/session-rule' ? 'active' : '' }}"><i class="ri-file-line"></i>Create Service Rules</a>
            <a href="{{route('superadmin.setting.file.manager')}}"
               class="{{ Request::path() == 'admin/settting/file-manager' ? 'active' : '' }}"><i
                    class="ri-folder-4-line"></i>OA Files</a>
            {{--            <a href="{{route('superadmin.setting.employee.setup')}}"--}}
            {{--               class="{{ Request::path() == 'admin/settting/staff-setup' ? 'active' : '' }}"><i--}}
            {{--                    class="ri-shield-user-line"></i>Staff Setup</a>--}}
            {{--            <a href="{{route('superadmin.setting.user.setup')}}"--}}
            {{--               class="{{ Request::path() == 'admin/settting/user-setup' ? 'active' : '' }}"><i--}}
            {{--                    class="ri-user-add-line"></i>Add/Edit User Setup</a>--}}
            {{--            <a href="{{route('superadmin.setting.documents')}}" class="{{ Request::path() == 'admin/settting/documents' ? 'active' : '' }}"><i class="fa fa-file-archive-o"></i>Documents</a>--}}
            <a href="{{route('superadmin.setting.forms.builder')}}"
               class="{{ Request::path() == 'admin/settting/froms-builder' ? 'active' : '' }}"><i
                    class="fa fa-file-text-o"></i>Forms Builder</a>
            <a href="{{route('superadmin.setting.notes.forms')}}"
               class="{{ Request::path() == 'admin/settting/notes-forms' ? 'active' : '' }}"><i
                    class="fa fa-file-text-o"></i>Forms & Library</a>
            <a href="{{route('superadmin.setting.bussiness.documents')}}"
               class="{{ Request::path() == 'admin/settting/bussiness-documents' ? 'active' : '' }}"><i
                    class="fa fa-file-o"></i>Business Files</a>
            {{--            <a href="{{route('superadmin.setting.subscription.information')}}"--}}
            {{--               class="{{ Request::path() == 'admin/settting/subscription-information' ? 'active' : '' }}"><i--}}
            {{--                    class="fa fa-info-circle"></i>Billing Invoice</a>--}}
            {{--            <a href="{{route('superadmin.setting.notification')}}"--}}
            {{--               class="{{ Request::path() == 'admin/settting/notification' ? 'active' : '' }}"><i--}}
            {{--                    class="fa fa-asterisk"></i>Sms/Email Settings </a>--}}
            {{--            <a href="{{route('superadmin.setting.demo.data')}}" class="{{ Request::path() == 'admin/settting/demo-data' ? 'active' : '' }}"><i class="fa fa-database"></i>Demo Data</a>--}}
            <a href="{{route('superadmin.setting.data.export')}}"
               class="{{ Request::path() == 'admin/settting/data-export' ? 'active' : '' }}"><i
                    class="fa fa-exchange"></i>Data Import</a>

            <a href="{{route('superadmin.meet.lists')}}"
               class="{{ Request::path() == 'admin/settting/data-export' ? 'active' : '' }}"><i
                    class="fa fa-exchange"></i>TPMS Meet</a>
        </div>
    </li>
</ul>
