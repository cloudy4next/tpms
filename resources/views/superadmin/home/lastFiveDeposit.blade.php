@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-flex justify-content-between">
                <div class="align-self-center mb-2">
                    <h2 class="common-title m-0">Last Five Deposits</h2>
                </div>
                <div class="align-self-center mb-2">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <div class="dropdown">
                                <button class="btn btn-sm p-0 dropdown-toggle" type="button"
                                    data-toggle="dropdown">
                                    <i class="ri-download-2-line"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right download-icon-show">

                                    <a class="dropdown-item" href="#" id="download_pdf"><i class="fa fa-file-pdf-o mr-2 text-danger"></i>Download PDF</a>
                                    <a class="dropdown-item" href="#" id="download_csv"><i class="fa fa-file-excel-o mr-2 text-success"></i>Download CSV</a>
                                </div>
                            </div>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{route('superadmin.dashboard')}}" class="btn btn-sm btn-primary"
                                            title="Back to dashboard"><i
                            class="ri-arrow-left-circle-line mr-1 align-middle"></i>Back</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered c_table" id="export_table">
                    <thead>
                    <tr>
                        <th>Deposit Date</th>
                        <th>Check No</th>
                        <th>Check Date</th>
                        <th>Payee Name</th>
                        <th>Payee Type</th>
                        <th>Allocated Check Amt.</th>
                        <th>Unallocated</th>
                        <th>Pay Type</th>
                        <th>Description</th>
                        <th>File</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($deposits as $depisit)
                        <tr>
                            <td>{{\Carbon\Carbon::parse($depisit->deposit_date)->format('m/d/Y')}}</td>
                            <td>{{$depisit->instrument}}</td>
                            <td>{{\Carbon\Carbon::parse($depisit->instrument_date)->format('m/d/Y')}}</td>
                            <td>
                                <?php
                                $payor_name = \App\Models\All_payor::where('id', $depisit->payor_id)->first();
                                $client_name = \App\Models\Client::where('id', $depisit->client_id)->first();
                                ?>
                                @if ($depisit->payor_type == 1)
                                    @if ($client_name)
                                        {{$client_name->client_full_name}}
                                    @endif
                                @elseif ($depisit->payor_type == 2)
                                    @if ($payor_name)
                                        {{$payor_name->payor_name}}
                                    @endif
                                @else

                                @endif

                            </td>
                            <td>
                                @if ($depisit->payor_type == 1)
                                    Client
                                @else
                                    Payor
                                @endif
                            </td>
                            <td>{{$depisit->amount}}</td>
                            <td>
                                <?php
                                $am = $depisit->amount;
                                $sm = \App\Models\deposit_apply::where('deopsit_id', $depisit->id)->sum('payment');
                                $un = ($depisit->amount - $sm)
                                ?>
                                {{$un}}
                            </td>
                            <td>
                                @if ($depisit->payment_method == 1)
                                    Check
                                @elseif($depisit->payment_method == 2)
                                    EFT
                                @elseif($depisit->payment_method == 3)
                                    Credit Card
                                @elseif($depisit->payment_method == 4)
                                    Cash
                                @elseif($depisit->payment_method == 5)
                                    Credit Memo
                                @else
                                    Not Set
                                @endif
                            </td>
                            <td title="792253152_ERA_835_5010_20210112.835">{!! substr($depisit->notes,0,30) !!}....
                            </td>

                            @if (!empty($depisit->file) && file_exists($depisit->file))
                                <?php
                                $get_name = substr($depisit->file, 25);
                                $ext = pathinfo($depisit->file, PATHINFO_EXTENSION);
                                $name = $get_name . $ext;
                                ?>
                                <td title="{{$get_name}}">
                                    <a href="{{asset($depisit->file)}}" download>{{$get_name}}</a>
                                </td>
                            @else
                                <td title="792253152_ERA_STATUS_5010_20210112-2021-01-12-09-37-23-474.txt">No File</td>
                            @endif


                        </tr>
                    @endforeach
                    </tbody>
                </table>
 
            </div>
        </div>
    </div>
    <input type="hidden" value="LastFiveDeposits_" id="fileName">

@endsection
@include('superadmin.home.include.export_include')
