@extends('layouts.MainAdmin')
@section('mainadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="overflow-hidden mb-3">
                <div class="float-left">
                    <h5>Add/Edit Payor</h5>
                </div>
                <div class="float-right"><a href="payor.html" class="btn btn-primary">+ Add New Payor</a></div>
            </div>
            <!-- Form -->
            <form action="{{route('mainadmin.payor.save')}}" method="post" class="needs-validation mt-2" novalidate>
                @csrf
                <div class="row no-gutters">
                    <div class="col-md-3 col-lg-2 mb-2 pr-2">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control form-control-sm" required>
                        <div class="invalid-feedback">Enter Name</div>
                    </div>
                    <div class="col-md-2 col-lg-2 mb-2 pr-2">
                        <label>Payor ID</label>
                        <input type="text" name="payor_id" class="form-control form-control-sm"
                               placeholder="Epayorid" required>
                        <div class="invalid-feedback">Enter Payor ID</div>
                    </div>
                    <div class="col-md-7 col-lg-8 mb-2">
                        <div class="row no-gutters">
                            <div class="col-md-4 pr-2">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control form-control-sm"
                                       placeholder="Street" required>
                                <div class="invalid-feedback">Enter Address</div>
                            </div>
                            <div class="col-md-4 pr-2">
                                <label>City</label>
                                <input type="text" name="city" class="form-control form-control-sm" placeholder="City"
                                       required>
                                <div class="invalid-feedback">Enter City</div>
                            </div>
                            <div class="col-md-2 pr-2">
                                <label>State</label>
                                <input type="text" name="state" class="form-control form-control-sm" placeholder="State"
                                       required>
                                <div class="invalid-feedback">Enter State</div>
                            </div>
                            <div class="col-md-2">
                                <label>Zip</label>
                                <input type="text" name="zip" class="form-control form-control-sm" placeholder="Zip"
                                       required>
                                <div class="invalid-feedback">Enter Zip</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Is Plan Medicare
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Is Plan MedicaId
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Is Plan Champus
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Is Plan ChampVA
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Is Plan Group Health Plan
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Plan FECA
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">Plan Other
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Save Payor Info</button>
                    </div>
                </div>
            </form>
            <!-- Existing Payor -->
            <hr>
            <div class="form-inline">
                <label>Existing Payor</label>
                <select class="form-control mx-2">
                    <option>Lorem, ipsum, dolor.</option>
                </select>
                <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#payor_table">
                    Show/Hide Payors
                </button>
            </div>
            <!-- Payor Table -->
            <div class="table-responsive mt-2 collapse" id="payor_table">
                <table class="table table-sm table-bordered c_table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Epayorid</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zip</th>
                        <th style="max-width: 50px; overflow: hidden;" title="PlanMedicare">PlanMedicare</th>
                        <th style="max-width: 50px; overflow: hidden;" title="PlanMedicaid">PlanMedicaid</th>
                        <th style="max-width: 50px; overflow: hidden;" title="PlanChampus">PlanChampus</th>
                        <th style="max-width: 50px; overflow: hidden;" title="PlanChampVA">PlanChampVA</th>
                        <th style="max-width: 50px; overflow: hidden;" title="PlanGroupHealthPlan">PlanGroupHealthPlan
                        </th>
                        <th style="max-width: 50px; overflow: hidden;" title="PlanFECA">PlanFECA</th>
                        <th style="max-width: 50px; overflow: hidden;" title="PlanOther">PlanOther</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>UHC (AT&T CarePlus)</td>
                        <td>2</td>
                        <td>PO Box 30886</td>
                        <td>Salt Lake</td>
                        <td>UT</td>
                        <td>84130</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>UHC (AT&T CarePlus)</td>
                        <td>2</td>
                        <td>PO Box 30886</td>
                        <td>Salt Lake</td>
                        <td>UT</td>
                        <td>84130</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>UHC (AT&T CarePlus)</td>
                        <td>2</td>
                        <td>PO Box 30886</td>
                        <td>Salt Lake</td>
                        <td>UT</td>
                        <td>84130</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>UHC (AT&T CarePlus)</td>
                        <td>2</td>
                        <td>PO Box 30886</td>
                        <td>Salt Lake</td>
                        <td>UT</td>
                        <td>84130</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>UHC (AT&T CarePlus)</td>
                        <td>2</td>
                        <td>PO Box 30886</td>
                        <td>Salt Lake</td>
                        <td>UT</td>
                        <td>84130</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
