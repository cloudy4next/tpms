<table class="table table-sm table-bordered c_table">
    <thead>
    <tr>
        <th>Patient</th>
        <th>contact info</th>
        <th>DOB</th>
        <th>gender</th>
        <th>SUPV. Provider</th>
        <th>POS</th>
        <th>Insurance</th>
        <th>auth</th>
        <th>Status</th>
    </tr>
    <tr class="bg-white">
        <th>
            <input class="form-control form-control-sm common_selector search_name" type="search"
                   placeholder="Search Patient">
        </th>
        <th>
            <input class="form-control form-control-sm common_selector search_contact" type="search"
                   placeholder="Search Contact">
        </th>
        <th>
            <input class="form-control form-control-sm common_selector2 search_dob" type="date"
                   placeholder="Search Dob">
        </th>
        <th>

            <input class="form-control form-control-sm search_gender" type="search"
                   placeholder="Search Here">
        </th>
        <th>
            <input class="form-control form-control-sm" type="search" placeholder="Search SUPV. Provider">
        </th>
        <th>
            <input class="form-control form-control-sm search_gender" type="search"
                   placeholder="Search Here">
        </th>
        <th>
            <input class="form-control form-control-sm" type="search" placeholder="search">
        </th>
        <th></th>

    </tr>
    </thead>
    <tbody class="text-center">
    @foreach($clients as $client)
        <tr>
            <td class="text-left">
                <a href="{{route('provider.client.info',$client->id)}}"
                   class="mr-2">{{$client->client_first_name}} {{$client->client_middle}} {{$client->client_last_name}}</a><span
                    class="badge badge-pill badge-light">Patient</span>
            </td>
            <td>
                <p>{{$client->phone_number}}</p>
            </td>
            <td>{{\Carbon\Carbon::parse($client->client_dob)->format('m/d/Y')}}</td>
            <td>{{$client->client_gender}}</td>
            <td>
                <?php
                $client_auth = \App\Models\Client_authorization::where('admin_id', Auth::user()->id)
                    ->orWhere('admin_id', Auth::user()->up_admin_id)
                    ->where('client_id', $client->id)
                    ->where('is_primary', 1)
                    ->first();
                if ($client_auth) {
                    $em_name = \App\Models\Employee::where('id', $client_auth->supervisor_id)->first();
                }

                ?>
                @if ($client_auth && $em_name)
                    {{$em_name->first_name}}  {{$em_name->middle_name}}  {{$em_name->last_name}}
                @endif
            </td>

            <td>{{$client->location}}</td>
            <td>
                <?php
                $client_autho = \App\Models\Client_authorization::where('client_id', $client->id)
                    ->where('is_primary', 1)
                    ->orderBy('id', 'asc')
                    ->first();
                ?>
                @if ($client_autho)
                    <?php
                    $show_payor = \App\Models\All_payor::where('id', $client_autho->payor_id)->first();
                    ?>

                    @if ($show_payor)
                        {{$show_payor->payor_name}}
                    @endif
                @endif
            </td>
            <td>
                <a href="#myauth{{$client->id}}" data-toggle="modal"><i class="fa fa-id-card-o" aria-hidden="true"></i></a>
                <div class="modal fade" id="myauth{{$client->id}}" data-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>All Authorizations</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <h5 class="mb-1">Auth List</h5>
                                <table class="table table-sm c_table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Onset Date</th>
                                        <th>End Date</th>
                                        <th>Primary Insurance</th>
                                        <th>Treatment Type</th>
                                        <th>UCI</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $all_authorizations = \App\Models\Client_authorization::where('client_id', $client->id)->get();
                                    ?>
                                    @foreach($all_authorizations as $authorization)
                                        <?php
                                        //                                                        $payor_name = \App\Models\payor_csv_data::where('id',$authorization->payor_id)->first();
                                        ?>
                                        <tr>
                                            <td>{{$authorization->treatment_type}} {{\Carbon\Carbon::parse($authorization->start_date)->format('m/d/Y')}}
                                                -{{\Carbon\Carbon::parse($authorization->end_date)->format('m/d/Y')}}</td>
                                            <td>{{\Carbon\Carbon::parse($authorization->start_date)->format('m/d/Y')}}</td>
                                            <td>{{\Carbon\Carbon::parse($authorization->end_date)->format('m/d/Y')}}</td>
                                            <td>
                                                {{--                                                                {{$payor_name->payor_name}}--}}
                                            </td>
                                            <td>{{$authorization->treatment_type}}</td>
                                            <td>{{$authorization->uci_id}}</td>
                                            <td><a href="{{route('superadmin.client.authorization',$client->id)}}">Go To
                                                    Auth</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <a href="{{route('superadmin.client.authorization',$client->id)}}"
                                   class="btn btn-primary border-white">Add New Auth</a>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td>

                {{--                @if ($client->is_active_client == 1)--}}
                {{--                    <i class="ri-checkbox-blank-circle-fill text-success" title="Active"></i>--}}
                {{--                @else--}}
                {{--                    <i class="ri-checkbox-blank-circle-fill text-danger" title="In-Active"></i>--}}
                {{--                @endif--}}

                <div class="custom-control custom-switch active-switch">
                    @if ($client->is_active_client == 1)
                        <input type="checkbox" class="custom-control-input clientactswt" value="{{$client->id}}"
                               name="activeswitch"
                               id="ac{{$client->id}}" checked>
                        <label class="custom-control-label lblenameac" for="ac{{$client->id}}">Active</label>
                    @else
                        <input type="checkbox" class="custom-control-input clientactswt" value="{{$client->id}}"
                               name="activeswitch"
                               id="ac{{$client->id}}">
                        <label class="custom-control-label lblenameac" for="ac{{$client->id}}">In-Active</label>
                    @endif

                </div>


            </td>

        </tr>
    @endforeach
    </tbody>
</table>
<!-- pagination -->
<nav class="overflow-hidden">
    {{$clients->links()}}
</nav>
