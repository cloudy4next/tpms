<table class="table-bordered table table-sm c_table">
    <thead>
    <tr>
        <th>Tx Type</th>
        <th>Service</th>
        <th>Service Sub-Type</th>
        <th>CPT Code</th>
        <th>M1</th>
        <th>M2</th>
        <th>M3</th>
        <th>M4</th>
        <th>Rate Per</th>
        <th>Contracted Rate</th>
        <th>Billing Rate</th>
        <th>Inc Per</th>
        <th>Active</th>
        <th>Degree</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($rate_lists as $rlist)
        <?php
        $tx_name = \App\Models\Treatment_facility::where('id', $rlist->treatment_type)->first();
        $serv = \App\Models\setting_service::where('id', $rlist->activity_type)->first();
        ?>
        <tr>
            <td>
                @if($tx_name)
                    {{$tx_name->treatment_name}}
                @endif
            </td>
            <td>
                @if($serv)
                    {{$serv->description}}
                @elseif($rlist->activity_type == 0)
                    N/A
                @else
                    N/A
                @endif
            </td>
            <td>
                <?php
                $sub_act = \App\Models\all_sub_activity::where('id', $rlist->sub_activity)->first();
                $cpt_name = \App\Models\setting_cpt_code::where('id', $rlist->cpt_code)->first();
                ?>
                @if ($sub_act)
                    {{$sub_act->sub_activity}}
                @elseif($rlist->sub_activity == 0)
                    N/A
                @else
                    N/A
                @endif

            </td>
            <td>
                @if ($cpt_name)
                    {{$cpt_name->cpt_code}}
                @elseif($rlist->cpt_code == 0)
                    N/A
                @else
                    N/A
                @endif

            </td>
            <td>{{$rlist->m1}}</td>
            <td>{{$rlist->m2}}</td>
            <td>{{$rlist->m3}}</td>
            <td>{{$rlist->m4}}</td>
            <td>{{$rlist->rate_per}}</td>
            <td>{{$rlist->contracted_rate}}</td>
            <td>{{$rlist->billed_rate}}</td>
            <td>{{$rlist->increasing_percentage}}</td>
            <td>
                @if ($rlist->active == 1)
                    Yes
                @else
                    No
                @endif
            </td>
            <td>
                {{$rlist->degree_level}}
            </td>
            <td>
                <a href="{{route('superadmin.ratelist.edit',$rlist->id)}}" title="Edit"><i
                        class="ri-edit-line text-primary mr-2"></i></a>
                <a href="{{route('superadmin.ratelist.delete',$rlist->id)}}" title="Delete"><i
                        class="ri-close-circle-line text-danger"></i></a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>

{{$rate_lists->links()}}
