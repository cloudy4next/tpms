@extends('layouts.superadmin')
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <h2 class="common-title"> Contract Rate</h2>
            <div class="d-flex mb-2 calendar_page">
                <div class="payor_filter">
                    <label>Select Insurace</label>
                    <select class="form-control form-control-sm payor_id">
                        <option value="0"></option>
                        @foreach($payors as $payo)
                            <option value="{{$payo->payor_id}}">{{$payo->payor_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="align-self-end ml-4 attachment show_file_div">
                    <a href="#" class="have_file">filenameeee.txt</a>
                    <button type="button" class="btn btn-sm text-primary"><i class="ri-close-circle-line"></i></button>
                </div>
                <div class="align-self-end ml-auto addrate_btn">
                    {{--                    <a href="{{route('superadmin.add.ratelist')}}" class="btn btn-sm btn-primary"><i--}}
                    {{--                            class="las la-plus"></i>Add Rate</a>--}}

                    <a href="#" class="btn btn-sm btn-primary addRateList"><i
                            class="las la-plus"></i>Add Rate</a>

                </div>
            </div>
            <div class="rate_table">
                <h6>Rate List</h6>
                <div class="table-responsive ratelist_tbl">

                </div>
            </div>
        </div>
    </div>
@endsection
@include('superadmin.ratelist.include.rateListInc')
