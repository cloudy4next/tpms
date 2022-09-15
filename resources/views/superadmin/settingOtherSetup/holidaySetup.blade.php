@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-lg-flex">
                <!-- menu -->
                <div class="setting_menu">
                    @include('superadmin.include.settingMenu')
                </div>
                <!-- content -->
                <div class="all_content flex-fill">
                    <h6>Holiday Setup</h6>
                    <table class="table table-sm table-bordered c_table">
                        <thead>
                        <tr>
                            <th>Date of holiday</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($holiday_setups as $holi_set)
                            <tr>
                                <td>{{\Carbon\Carbon::parse($holi_set->holiday_date)->format('m/d/Y')}}</td>
                                <td>{!! $holi_set->description !!}</td>
                                <td><a href="{{route('superadmin.holiday.setup.delete',$holi_set->id)}}"><i
                                            class="ri-delete-bin-line text-danger"></i></a></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{$holiday_setups->links()}}
                    <div class="overflow-hidden">
                        <button type="button" class="btn btn-sm btn-primary float-left add_holiday" data-toggle="modal"
                                data-target="#add_holiday">Add Time Off
                        </button>
                        <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal"
                                data-target="#federal_holiday">Add Federal US
                            holidays
                        </button>
                        {{--                        <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#federal_holiday">Add Federal US holidays</button>--}}
                    </div>

                    <!-- add_holiday -->
                    <div class="modal fade" id="add_holiday" data-backdrop="static">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Create Holiday</h4>
                                    <button type="button" class="close"
                                            data-dismiss="modal">&times;
                                    </button>
                                </div>
                                <form action="{{route('superadmin.holiday.setup')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <label>Date</label>
                                                <input type="date" class="form-control form-control-sm"
                                                       name="holiday_date" required>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <label>Description</label>
                                                <textarea name="description"
                                                          class="form-control form-control-sm"></textarea>
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


                    <div class="modal fade" id="federal_holiday" data-backdrop="static">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Add Federal US holidays</h4>
                                    <button type="button" class="close"
                                            data-dismiss="modal">&times;
                                    </button>
                                </div>
                                <form action="{{route('superadmin.add.federal.holiday')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md mb-2">
                                                <div class="custom-control custom-switch">
                                                    @if($jan1)
                                                        <input type="checkbox" name="jan_1" value="1"
                                                               class="custom-control-input"
                                                               id="hol" checked>
                                                    @else
                                                        <input type="checkbox" name="jan_1" value="2"
                                                               class="custom-control-input"
                                                               id="hol">
                                                    @endif
                                                    <label class="custom-control-label" for="hol">New Year's
                                                        Day <span class="text-success">(January
                                                                        1)</span></label>
                                                </div>
                                                <div class="custom-control custom-switch">
                                                    @if($jan17)
                                                        <input type="checkbox" name="jan_17" value="1"
                                                               class="custom-control-input"
                                                               id="hol2" checked>
                                                    @else
                                                        <input type="checkbox" name="jan_17" value="2"
                                                               class="custom-control-input"
                                                               id="hol2">
                                                    @endif
                                                    <label class="custom-control-label" for="hol2">Martin
                                                        Luther King Jr. Day <span
                                                            class="text-success">(January 17)</span></label>
                                                </div>
                                                <div class="custom-control custom-switch">
                                                    @if($feb21)
                                                        <input type="checkbox" name="feb_21" value="1"
                                                               class="custom-control-input"
                                                               id="hol22" checked>
                                                    @else
                                                        <input type="checkbox" name="feb_21" value="2"
                                                               class="custom-control-input"
                                                               id="hol22">
                                                    @endif
                                                    <label class=" custom-control-label"
                                                           for="hol22">George
                                                        Washington's Birthday <span
                                                            class="text-success">(February
                                                                        21)</span></label>
                                                </div>
                                                <div class="custom-control custom-switch">
                                                    @if($may30)
                                                        <input type="checkbox" name="may_30" value="1"
                                                               class="custom-control-input"
                                                               id="hol3" checked>
                                                    @else
                                                        <input type="checkbox" name="may_30" value="2"
                                                               class="custom-control-input"
                                                               id="hol3">
                                                    @endif
                                                    <label class="custom-control-label" for="hol3">Memorial
                                                        Day <span class="text-success">(May
                                                                        30)</span></label>
                                                </div>
                                                <div class="custom-control custom-switch">
                                                    @if($jun20)
                                                        <input type="checkbox" name="jun_20" value="1"
                                                               class="custom-control-input"
                                                               id="hol33" checked>
                                                    @else
                                                        <input type="checkbox" name="jun_20" value="2"
                                                               class="custom-control-input"
                                                               id="hol33">
                                                    @endif
                                                    <label class="custom-control-label"
                                                           for="hol33">Juneteenth <span
                                                            class="text-success">(June 20)</span></label>
                                                </div>
                                                <div class="custom-control custom-switch">
                                                    @if($july4)
                                                        <input type="checkbox" name="july_4" value="1"
                                                               class="custom-control-input"
                                                               id="hol4" checked>
                                                    @else
                                                        <input type="checkbox" name="july_4" value="2"
                                                               class="custom-control-input"
                                                               id="hol4">
                                                    @endif
                                                    <label class="custom-control-label"
                                                           for="hol4">Independence Day <span
                                                            class="text-success">(July 4)</span></label>
                                                </div>
                                                <div class="custom-control custom-switch">
                                                    @if($sep5)
                                                        <input type="checkbox" name="sep_5" value="1"
                                                               class="custom-control-input"
                                                               id="hol5" checked>
                                                    @else
                                                        <input type="checkbox" name="sep_5" value="2"
                                                               class="custom-control-input"
                                                               id="hol5">
                                                    @endif
                                                    <label class="custom-control-label" for="hol5">Labor
                                                        Day <span class="text-success">(September
                                                                        5)</span></label>
                                                </div>
                                                <div class="custom-control custom-switch">
                                                    @if($oct10)
                                                        <input type="checkbox" name="oct_10" value="1"
                                                               class="custom-control-input"
                                                               id="cb" checked>
                                                    @else
                                                        <input type="checkbox" name="oct_10" value="2"
                                                               class="custom-control-input"
                                                               id="cb">
                                                    @endif
                                                    <label class="custom-control-label" for="cb">Columbus
                                                        Day <span class="text-success">(October
                                                                        10)</span></label>
                                                </div>
                                                <div class="custom-control custom-switch">
                                                    @if($nov11)
                                                        <input type="checkbox" name="nov_11" value="1"
                                                               class="custom-control-input"
                                                               id="hol6" checked>
                                                    @else
                                                        <input type="checkbox" name="nov_11" value="2"
                                                               class="custom-control-input"
                                                               id="hol6">
                                                    @endif
                                                    <label class="custom-control-label" for="hol6">Veterans
                                                        Day <span class="text-success">(November
                                                                        11)</span></label>
                                                </div>
                                                <div class="custom-control custom-switch">
                                                    @if($nov24)
                                                        <input type="checkbox" name="nov_24" value="1"
                                                               class="custom-control-input"
                                                               id="hol7" checked>
                                                    @else
                                                        <input type="checkbox" name="nov_24" value="2"
                                                               class="custom-control-input"
                                                               id="hol7">
                                                    @endif
                                                    <label class="custom-control-label"
                                                           for="hol7">Thanksgiving <span
                                                            class="text-success">(November
                                                                        24)</span></label>
                                                </div>
                                                <div class="custom-control custom-switch">
                                                    @if($dec25)
                                                        <input type="checkbox" name="dec_25" value="1"
                                                               class="custom-control-input"
                                                               id="hol8" checked>
                                                    @else
                                                        <input type="checkbox" name="dec_25" value="2"
                                                               class="custom-control-input"
                                                               id="hol8">
                                                    @endif
                                                    <label class="custom-control-label" for="hol8">Christmas
                                                        Day <span class="text-success">(December
                                                                        25)</span></label>
                                                </div>
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
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
