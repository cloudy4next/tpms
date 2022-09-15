<ul class="nav flex-column employee_menu">
    <!-- Profile Picture -->
    <li class="nav-item border-0 text-center">
        <div class="profile-pic-div">
            <img src="{{asset('assets/dashboard/')}}/images/man.jpg" class="img-fluid" id="photo"
                 alt="aba+">
            <input type="file" id="file" class="d-none" autocomplete="nope">
            <label for="file" id="uploadBtn">Upload Photo</label>
        </div>
    </li>
    <!--/ Profile Picture -->
    <?php
    $pram_id = $employee->id;
    ?>
    <li class="nav-item">
        <a class="{{ Request::path() == 'admin/staffs-biographic/{$employee->id}' ? 'active' : '' }}"
           href="{{route('superadmin.emaployee.biographic',$employee->id)}}">Bio’s</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('superadmin.emaployee.contact.details',$employee->id)}}">Contact Info</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('superadmin.emaployee.credentials',$employee->id)}}">Credentials</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('superadmin.emaployee.department',$employee->id)}}">Department
            Supervisor(s)</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('superadmin.emaployee.payroll',$employee->id)}}">Payroll Setup</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('superadmin.emaployee.other.setup',$employee->id)}}">Other Setup</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('superadmin.emaployee.leave.tracking',$employee->id)}}">Leave Tracking</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('superadmin.emaployee.payor.exclusion',$employee->id)}}">Insurance
            Exclusion(s)</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('superadmin.emaployee.subactivity.exclusion',$employee->id)}}">Service
            Sub-Type Exclusions</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('superadmin.emaployee.client.exclusion',$employee->id)}}">Patient
            Exclusion</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('superadmin.employee.portal',$employee->id)}}">Staff Portal</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="staff-activity.html">Staff Activity</a>
    </li>
</ul>
