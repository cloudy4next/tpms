@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">

            <div class="tab-content">
                <h2 class="common-title">Manage Claim(s)</h2>
                <!-- Filters -->

                <!-- table -->
                <div class="claim_details">
                    <form action="{{ route('superadmin.claim.with.background') }}" method="post" id="claim_tran_submit"
                          target="_blank">
                        @csrf
                        <div class="d-flex justify-content-between">
                            <div class="align-self-center mb-2">

                            </div>
                            <div class="align-self-center mb-2">
                                <div class="dropdown">
                                    <button class="btn btn-sm p-0 dropdown-toggle" type="button"
                                            data-toggle="dropdown">
                                        <i class="ri-download-2-line"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right download-icon-show">
                                        <a class="dropdown-item" href="#" id="download_pdf">Download PDF</a>
                                        <a class="dropdown-item" href="#" id="download_csv">Download CSV</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive claimTable claimdatashow">
                            <div class="table_transaction mt-2 trasac_ac_div">
                                <div class="table-responsive sec_claim_transaction">


                                </div>
                                <!-- Filter -->
                                <div class="d-flex">
                                    <div class="align-self-end mr-2">
                                        <select class="form-control form-control-sm claim_transacton_action">
                                            {{--                                            <option value="1">HCFA with background</option>--}}
                                            {{--                                            <option value="2">HCFA without background</option>--}}
                                            {{--                                            <option value="3">Push OA SFTP</option>--}}
                                            <option value="4">Show Detail(s)</option>
                                            {{--                                            <option value="5">Create Secondary Claim</option>--}}
                                            <option value="6">Generate Secondary Claim</option>
                                        </select>
                                    </div>
                                    <div class="align-self-end">
                                        <button type="button" class="btn btn-sm btn-primary mr-2" id="cl_tran_ok_btn">OK
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger"
                                                onclick="window.location.reload();">Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- claim Option -->

                    </form>
                    <!-- transaction table -->
                    <div class="table_transaction mt-2 trasac_ac_div">
                        <div class="table-responsive secclaim_transaction">

                        </div>
                        <!-- Filter -->
                        {{--                        <div class="d-flex transac_table">--}}
                        {{--                            <div class="align-self-end mr-2">--}}
                        {{--                                <select class="form-control form-control-sm claim_transacton_action">--}}
                        {{--                                    <option value="1">Retract billed Session(s)</option>--}}
                        {{--                                    <option value="2">Split Session(s)</option>--}}
                        {{--                                </select>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="align-self-end">--}}
                        {{--                                <button type="button" class="btn btn-sm btn-primary mr-2" id="cl_tran_ok_btn">OK--}}
                        {{--                                </button>--}}
                        {{--                                <button type="button" class="btn btn-sm btn-danger"--}}
                        {{--                                        onclick="window.location.reload();">Cancel--}}
                        {{--                                </button>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@include('superadmin.secondaryClaim.include.sec_claim_include_js')
