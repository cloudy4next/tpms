<?php
    if(\Auth::user()->is_up_admin==1){
        $admin_id=\Auth::user()->id;
    }
    else{
        $admin_id=\Auth::user()->up_admin_id;
    }
?>

@foreach($statements as $period)

<?php

    $check=\App\Models\timesheet::select('id')->where('admin_id',$admin_id)->where('schedule_date','>=',$period->start_date)->where('schedule_date','<=',$period->end_date)->where('submitted',1)->where('status','Completed')->first();


?>

<tr>
    <td>
        @if($check)
            <input type="checkbox" class="check_box" id="{{$period->id}}" disabled>
        @else
            <input type="checkbox" class="in_check" id="{{$period->id}}">
        @endif
        <label></label>
    </td>
    <td>
        @if($period->start_date)
        {{\Carbon\Carbon::parse($period->start_date)->format('m/d/Y')}}
        @endif
    </td>
    <td>
        @if($period->end_date)
        {{\Carbon\Carbon::parse($period->end_date)->format('m/d/Y')}}
        @endif
    </td>
    <td>
        @if($period->time_sheet_date)
        {{\Carbon\Carbon::parse($period->time_sheet_date)->format('m/d/Y')}}
        @endif
    </td>
    <td>
        @if($period->check_date)
        {{\Carbon\Carbon::parse($period->check_date)->format('m/d/Y')}}
        @endif
    </td>
    <td>{{$period->week_day_name}}</td>
    <td>
        @if($check)
        <ul class="list-inline m-0">
            <li class="list-inline-item">
                <a href="javascript:void(0);" title="Edit" class="text-light"><i class="ri-edit-box-line"></i></a>
            </li>
            {{-- <li class="list-inline-item">
                <a href="{{route('superadmin.pay.period.delete',$period->id)}}"
                    title="Delete" class="text-danger"><i
                class="ri-delete-bin-6-line"></i></a>
            </li> --}}
        </ul>
        @else
        <ul class="list-inline m-0">
            <li class="list-inline-item">
                <a href="#payperiodedit{{$period->id}}" title="Edit"
                    class="text-primary" data-toggle="modal"><i class="ri-edit-box-line"></i></a>
            </li>
            {{-- <li class="list-inline-item">
                <a href="{{route('superadmin.pay.period.delete',$period->id)}}"
                    title="Delete" class="text-danger"><i
                class="ri-delete-bin-6-line"></i></a>
            </li> --}}
        </ul>
        @endif
        <div class="modal fade" id="payperiodedit{{$period->id}}" data-backdrop="static">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Create/Edit Pay Period</h4>
                        <button type="button" class="close"
                        data-dismiss="modal">&times;
                        </button>
                    </div>
                    <form action="{{route('superadmin.pay.period.update')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label>From Date</label>
                                    <input type="date" class="form-control form-control-sm"
                                    name="start_date" value="{{$period->start_date}}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>End Date</label>
                                    <input type="date" class="form-control form-control-sm"
                                    name="end_date" value="{{$period->end_date}}" required>
                                    <input type="hidden" class="form-control form-control-sm"
                                    name="period_edit" value="{{$period->id}}">
                                </div>
                                <div class="col-md-4 align-self-end mb-3">
                                    <label>Check Date</label>
                                    <input type="date" class="form-control form-control-sm"
                                    name="check_date" value="{{$period->check_date}}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>After how many days staff can't submit time
                                    sheet?</label>
                                    <input type="number" class="form-control form-control-sm"
                                    name="time_sheet" value="{{$period->time_sheet}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-danger"
                            data-dismiss="modal">Close
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </td>
</tr>
@endforeach