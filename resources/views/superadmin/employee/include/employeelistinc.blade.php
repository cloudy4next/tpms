<table class="table table-bordered table-sm c_table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Credential Type</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Language</th>
            <th>Schedule</th>
            <th>Status</th>
            {{-- <th>Edit</th> --}}
        </tr>
        <tr class="bg-white">
            <th>
                <input type="search" class="form-control form-control-sm search_name common_selector" placeholder="Name">
            </th>
            <th>
                <input type="search" class="form-control form-control-sm search_crentype " placeholder="Credential Type">
            </th>
            <th>
                <input type="search" class="form-control form-control-sm search_phone common_selecto"
                    placeholder="Phone">
            </th>
            <th>
                <input type="search" class="form-control form-control-sm search_email common_selecto"
                    placeholder="Email">
            </th>
            <th>
                <input type="search" class="form-control form-control-sm search_language common_selecto"
                    placeholder="Language">
            </th>
            <th></th>
            <th>
                <select class="form-control form-control-sm active_status">
                    <option value="1">All</option>
                    <option value="2">Active</option>
                    <option value="3">In-Active</option>
                </select>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employee_lists as $employee)
            <tr>
                <td>
                    <a href="{{ route('superadmin.emaployee.biographic', $employee->id) }}"
                        class="mr-2">{{ $employee->first_name }} {{ $employee->middle_name }}
                        {{ $employee->last_name }}</a>
                </td>
                <td>
                    <?php
                    $staff_type = \App\Models\Employee_type_assign::where('id', $employee->credential_type)->first();
                    ?>

                    @if ($staff_type)
                        {{ $staff_type->type_name }}
                    @else
                    @endif

                </td>
                <td>{{ $employee->office_phone }}</td>
                <td>{{ $employee->office_email }}</td>
                <td>{{ $employee->language }}</td>
                <td><a href="{{ route('superadmin.employee.schedule', $employee->id) }}">View</a></td>
                <td>
                    @if ($employee->is_active == 1)
                        <div class="custom-control custom-switch active-switch">
                            <input type="checkbox" class="custom-control-input employeeswt" value="{{ $employee->id }}"
                                id="ac2{{ $employee->id }}" checked>
                            <label class="custom-control-label" for="ac2{{ $employee->id }}">Active</label>
                        </div>
                    @else
                        <div class="custom-control custom-switch active-switch">
                            <input type="checkbox" class="custom-control-input employeeswt" value="{{ $employee->id }}"
                                id="ac2{{ $employee->id }}">
                            <label class="custom-control-label" for="ac2{{ $employee->id }}">In-Active</label>
                        </div>
                    @endif

                </td>
                {{-- <td><a href="{{ route('superadmin.emaployee.biographic', $employee->id) }}"><i
                            class="las la-edit"></i></a></td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
