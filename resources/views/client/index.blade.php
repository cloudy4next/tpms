@extends('layouts.client')
@section('client')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <!-- title -->
            <div class="overflow-hidden">
                <div class="float-left">
                    <h5 class="common-title">Manage Sessions</h5>
                </div>
                <div class="float-right"><a href="{{route('client.mycallender')}}"
                                            class="btn btn-sm btn-primary mb-3"><i
                            class="fa fa-calendar" aria-hidden="true"></i> Calender View</a></div>
            </div>
            <!-- filter -->
            <div class="d-flex">
                <div class="mr-2 mb-2 schedule-filter">
                    <label>Search By</label>
                    <select class="form-control form-control-sm search_by">
                        <option value="1">Today</option>
                        <option value="2">Tomorrow</option>
                        <option value="3">Yesterday</option>
                        <option value="4">Next 7 days</option>
                        <option value="5">Date Range</option>
                        <option value="7">Last 15 days</option>
                        <option value="8">Next 15 days</option>
                        <option value="9">Last 30 days</option>
                        <option value="10">Next 30 days</option>
                    </select>
                </div>
                <div class="mb-2 mr-2 daterange-filter">
                    <label>Date Range</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input class="form-control form-control-sm reportrange" readonly>
                    </div>
                </div>

                <div class="align-self-end mb-2">
                    <button type="button" class="btn btn-sm btn-primary goBtn" id="goBtn">Go</button>
                </div>
            </div>
            <!-- table -->
            <div class="providerScheduler-table">
                <div class="table-responsive all_secction">

                </div>
            </div>
        </div>
    </div>
@endsection
@include('client.include.clientHomeIncJs')

