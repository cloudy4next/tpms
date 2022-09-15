@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="text-right mb-2"><a href="{{route('superadmin.billing.statement')}}" class="btn btn-sm btn-primary" title="Back To Authorization"><i class="ri-arrow-left-circle-line"></i>Back</a></div>
            <!-- statement -->
            <div class="border">
                <!-- export bar -->
                <div class="bg-light py-2 px-3">
                    <div class="d-flex">
                        <div class="bar-icon">
                            <a href="#" title="Navigate back" class="mr-1"><img src="{{asset('assets/dashboard/')}}/images/statement/back-button.png" class="img-fluid" alt="back"></a>
                            <a href="#" title="Navigate forward"><img src="{{asset('assets/dashboard/')}}/images/statement/next-button.png" class="img-fluid" alt="forward"></a>
                        </div>
                        <div class="bar-pagination mx-2">
                            <a href="#" title="First page"><img src="{{asset('assets/dashboard/')}}/images/statement/rewind-double-arrows-angles.png" alt="back"></a>
                            <a href="#" title="Previous page"><img src="{{asset('assets/dashboard/')}}/images/statement/previous.png" alt="back"></a>
                            <input type="text" value="1" title="Current page">
                            <span>of</span>
                            <span>100</span>
                            <a href="#" title="Next page"><img src="{{asset('assets/dashboard/')}}/images/statement/skip-track.png" alt="forward"></a>
                            <a href="#" title="Last page"><img src="{{asset('assets/dashboard/')}}/images/statement/fast-forward.png" alt="forward"></a>
                        </div>
                        <div class="bar-pagination">
                            <select>
                                <option>Export to the selected format</option>
                                <option>Acrobat (PDF) file</option>
                                <option>Excel 97-2003</option>
                                <option>Rich Text Format</option>
                                <option>TIFF file</option>
                                <option>Web Archive</option>
                                <option>Word Document</option>
                            </select>
                            <span class="mx-2">Export</span>
                            <span></span>
                            <a href="#" title="Refresh"><img src="{{asset('assets/dashboard/')}}/images/statement/refresh.png" class="img-fluid" alt="refresh"></a>
                            <a href="#" class="mx-2" title="Switch to interactive view"><img src="{{asset('assets/dashboard/')}}/images/statement/capture.png" class="img-fluid" alt="capture"></a>
                            <a href="#" title="Print"><img src="{{asset('assets/dashboard/')}}/images/statement/print.png" class="img-fluid" alt="print"></a>
                        </div>
                    </div>
                </div>
                <!-- table -->
                <div class="p-3">
                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                        <tbody>
                        <tr>
                            <td>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody>
                                    <tr>
                                        <td style="margin-bottom: 0; font-style: normal; line-height: inherit; font-family: 'Roboto', sans-serif; font-size: 18px; letter-spacing: 0.5px; color: #000; font-weight: bold;">
                                            Progressive Behavioral Science<br>
                                            3520 Oaks Way #904<br>
                                            Pompano Beach FL 33069<br>
                                            Phone: 305-807-1909
                                        </td>
                                        <td style="text-align:right;"><img src="{{asset('assets/dashboard/')}}/images/client/statement.png" alt="statement"></td>
                                    </tr>
                                    <tr>
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                            <tr>
                                                <td style="margin-top:0px; margin-bottom:0px; font-style: normal; line-height: inherit; font-family: 'Roboto', sans-serif; font-size: 18px; letter-spacing: 0.5px; color: #000; font-weight: bold;">Bill To<br>
                                                    M. Duran
                                                    <br>
                                                    <br>
                                                    Palmetto Bay FL 33157
                                                </td>
                                                <td align="right" width="295">
                                                    <p align="left" style="margin-bottom: 0; font-style: normal; line-height: inherit; font-family: 'Roboto', sans-serif; font-size: 18px; letter-spacing: 0.5px; color: #000; font-weight: bold;">Invoice #<br />
                                                        Client Account #3197</p>
                                                    <table style="border-collapse: collapse;">
                                                        <tbody>
                                                        <tr>
                                                            <td style="margin-bottom:0; font-style: normal; line-height: inherit; font-family: 'Roboto', sans-serif; font-size: 18px; letter-spacing: 0.5px; color: #000; font-weight: bold; text-align: left; border: 1px solid #333; padding: 5px 10px; background: #cccccc;">Date</td>
                                                            <td style="margin-bottom:0; font-style: normal; line-height: inherit; font-family: 'Roboto', sans-serif; font-size: 18px; letter-spacing: 0.5px; color: #000; font-weight: bold; text-align: left; border: 1px solid #333; padding: 5px 10px; background: #cccccc;">8/13/2020</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="margin-bottom: 0; font-style: normal; line-height: inherit; font-family: 'Roboto', sans-serif; font-size: 18px; letter-spacing: 0.5px; color: #000; font-weight: bold; text-align: left; border: 1px solid #333; padding: 5px 10px; background: #cccccc;">Due Date</td>
                                                            <td style="margin-bottom: 0; font-style: normal; line-height: inherit; font-family: 'Roboto', sans-serif; font-size: 18px; letter-spacing: 0.5px; color: #000; font-weight: bold; text-align: left; border: 1px solid #333; padding: 5px 10px; background: #cccccc;">8/21/2020</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="margin-bottom: 0; font-style: normal; line-height: inherit; font-family: 'Roboto', sans-serif; font-size: 18px; letter-spacing: 0.5px; color: #000; font-weight: bold; text-align: left; border: 1px solid #333; padding: 5px 10px; background: #cccccc;">Last Payment Date</td>
                                                            <td style="margin-bottom: 0; font-style: normal; line-height: inherit; font-family: 'Roboto', sans-serif; font-size: 18px; letter-spacing: 0.5px; color: #000; font-weight: bold; text-align: left; border: 1px solid #333; padding: 5px 10px; background: #cccccc;">9/21/2020</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="margin-bottom: 0; font-style: normal; line-height: inherit; font-family: 'Roboto', sans-serif; font-size: 18px; letter-spacing: 0.5px; color: #000; font-weight: bold; text-align: left; border: 1px solid #333; padding: 5px 10px; background: #cccccc;">Last Payment</td>
                                                            <td style="margin-bottom: 0; font-style: normal; line-height: inherit; font-family: 'Roboto', sans-serif; font-size: 18px; letter-spacing: 0.5px; font-weight: bold; text-align: left; border: 1px solid #333; padding: 5px 10px; background: #d0154e; color: #fff; ">$3,250.00</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table class="service-detals-list mt-2" style="border-collapse: collapse; width: 100%;">
                                                <thead>
                                                <tr style="background:#cccccc;">
                                                    <th rowspan="2" style="text-transform: uppercase; font-weight: bold; color: #000; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; max-width: 70px;">Service Date</th>
                                                    <th rowspan="2" style="text-transform: uppercase; font-weight: bold; color: #000; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px;">Description</th>
                                                    <th colspan="3" style="text-transform: uppercase; font-weight: bold; color: #000; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px;">Balance</th>
                                                </tr>
                                                <tr style="background:#cccccc;">
                                                    <th style="text-transform: uppercase; font-weight: bold; color: #000; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px;">Copay</th>
                                                    <th style="text-transform: uppercase; font-weight: bold; color: #000; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px;">Coins</th>
                                                    <th style="text-transform: uppercase; font-weight: bold; color: #000; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; max-width: 60px;">Deductible</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 70px;">08/16/2019</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 290px;">Direct Behavior Therapy By Para</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">20.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">0.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 60px;">0.00</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 70px;">08/16/2019</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 290px;">Direct Behavior Therapy By Para</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">20.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">0.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 60px;">0.00</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 70px;">08/16/2019</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 290px;">Direct Behavior Therapy By Para</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">20.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">0.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 60px;">0.00</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 70px;">08/16/2019</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 290px;">Direct Behavior Therapy By Para</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">20.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">0.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 60px;">0.00</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 70px;">08/16/2019</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 290px;">Direct Behavior Therapy By Para</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">20.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">0.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 60px;">0.00</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 70px;">08/16/2019</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 290px;">Direct Behavior Therapy By Para</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">20.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">0.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 60px;">0.00</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 70px;">08/16/2019</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 290px;">Direct Behavior Therapy By Para</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">20.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">0.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 60px;">0.00</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 70px;">08/16/2019</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 290px;">Direct Behavior Therapy By Para</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">20.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">0.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 60px;">0.00</td>
                                                </tr>
                                                <tr>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 70px;">08/16/2019</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 290px;">Direct Behavior Therapy By Para</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">20.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">0.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 60px;">0.00</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 70px;">08/16/2019</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 290px;">Direct Behavior Therapy By Para</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">20.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">0.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 60px;">0.00</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 70px;">08/16/2019</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 290px;">Direct Behavior Therapy By Para</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">20.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">0.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 60px;">0.00</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 70px;">08/16/2019</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 290px;">Direct Behavior Therapy By Para</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">20.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif;">0.00</td>
                                                    <td style="font-weight: normal; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; color: #000; letter-spacing: 0.5px; font-family: 'Roboto', sans-serif; max-width: 60px;">0.00</td>
                                                </tr>
                                                <tr style="background:#cccccc;">
                                                    <th colspan="2" style="text-transform: uppercase; font-weight: bold; color: #000; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px;">Total</th>
                                                    <td style="text-transform: uppercase; font-weight: bold; color: #000; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px;">60</td>
                                                    <td style="text-transform: uppercase; font-weight: bold; color: #000; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px;">0</td>
                                                    <td style="text-transform: uppercase; font-weight: bold; color: #000; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px; max-width: 60px;">0</td>
                                                </tr>
                                                <tr style="background:#cccccc;">
                                                    <th colspan="3" style="text-transform: uppercase; font-weight: bold; color: #000; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px;">TOTAL BALANCE DUE From 01/01/2019 to 05/06/2020</th>
                                                    <th colspan="2" style="text-transform: uppercase; font-weight: bold; color: #000; font-size: 16px; border: 2px solid #333; text-align: center; padding: 5px 5px;">Grand Total: $60</th>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tbody>
                                                <tr>
                                                    <br />
                                                    <br /><br />
                                                    <td width="460" align="left" style="vertical-align:top; padding-top:0px;">
                                                        <p style="font-style: normal; line-height: inherit; font-family: 'Roboto', sans-serif; font-size: 18px; letter-spacing: 0.5px; color: #000; font-weight: bold; margin-bottom: 0px;">Payment Coupon</p>
                                                        <span style="font-size: 16px; color: #000; font-family: 'Roboto', sans-serif; margin: 0; display: block">
                                                                                    Please return this coupon with your payment.<br />
                                                                                    Make your checks payable to :
                                                                                </span>
                                                        <p style="margin-bottom: 8px; font-style: normal; line-height: inherit; font-family: 'Roboto', sans-serif; font-size: 18px; letter-spacing: 0.5px; color: #000; font-weight: bold;">Progressive Behavioral Science </p>
                                                        <span style="font-family: 'Roboto', sans-serif; font-size: 18px; letter-spacing: 0.5px; color: #000; font-weight: bold;">Invoice #</span> <input style="border: none; border-bottom: 2px solid; width: 100%; max-width: 195px; position: relative; top: -5px; font-size:16px;" type="text">
                                                        <p style="font-style: normal; line-height: inherit; font-family: 'Roboto', sans-serif; font-size: 18px; letter-spacing: 0.5px; color: #000; font-weight: bold; margin-bottom: 0px !important;"><strong>Date:</strong> &nbsp; &nbsp; <span>08/13/2020</span></p>
                                                    </td>
                                                    <td width="600" align="right" style="width: 100%; max-width: 600px; float: right; border: 1px solid #000; padding: 10px 5px 15px;">
                                                        <p style="text-align: center; margin-bottom: 0px; font-style: normal; line-height: inherit; font-family: 'Roboto', sans-serif; font-size: 18px; letter-spacing: 0.5px; color: #000; font-weight: bold; margin-top: 0px; margin-bottom: 5px;">Credit Card Authorization</p>
                                                        <table style="border-collapse: collapse; border:0; margin: 0 auto;">
                                                            <tbody>
                                                            <tr>
                                                                <td style="width: 28px; border: 2px solid #000; height: 28px;"><input style="width: 28px; border: none; text-align: center;" type="tel" name="num1" maxlength="1"></td>
                                                                <td style="width: 28px; border: 2px solid #000; height: 28px;"><input style="width: 28px; border: none; text-align: center;" type="tel" name="num2" maxlength="1"></td>
                                                                <td style="width: 28px; border: 2px solid #000; height: 28px;"><input style="width: 28px; border: none; text-align: center;" type="tel" name="num3" maxlength="1"></td>
                                                                <td style="width: 28px; border: 2px solid #000; height: 28px;"><input style="width: 28px; border: none; text-align: center;" type="tel" name="num4" maxlength="1"></td>
                                                                <td style="width: 28px; border: 2px solid #000; height: 28px;"><input style="width: 28px; border: none; text-align: center;" type="tel" name="num5" maxlength="1"></td>
                                                                <td style="width: 28px; border: 2px solid #000; height: 28px;"><input style="width: 28px; border: none; text-align: center;" type="tel" name="num6" maxlength="1"></td>
                                                                <td style="width: 28px; border: 2px solid #000; height: 28px;"><input style="width: 28px; border: none; text-align: center;" type="tel" name="num7" maxlength="1"></td>
                                                                <td style="width: 28px; border: 2px solid #000; height: 28px;"><input style="width: 28px; border: none; text-align: center;" type="tel" name="num8" maxlength="1"></td>
                                                                <td style="width: 28px; border: 2px solid #000; height: 28px;"><input style="width: 28px; border: none; text-align: center;" type="tel" name="num9" maxlength="1"></td>
                                                                <td style="width: 28px; border: 2px solid #000; height: 28px;"><input style="width: 28px; border: none; text-align: center;" type="tel" name="num10" maxlength="1"></td>
                                                                <td style="width: 28px; border: 2px solid #000; height: 28px;"><input style="width: 28px; border: none; text-align: center;" type="tel" name="num11" maxlength="1"></td>
                                                                <td style="width: 28px; border: 2px solid #000; height: 28px;"><input style="width: 28px; border: none; text-align: center;" type="tel" name="num12" maxlength="1"></td>
                                                                <td style="width: 28px; border: 2px solid #000; height: 28px;"><input style="width: 28px; border: none; text-align: center;" type="tel" name="num13" maxlength="1"></td>
                                                                <td style="width: 28px; border: 2px solid #000; height: 28px;"><input style="width: 28px; border: none; text-align: center;" type="tel" name="num14" maxlength="1"></td>
                                                                <td style="width: 28px; border: 2px solid #000; height: 28px;"><input style="width: 28px; border: none; text-align: center;" type="tel" name="num15" maxlength="1"></td>
                                                                <td style="width: 28px; border: 2px solid #000; height: 28px;"><input style="width: 28px; border: none; text-align: center;" type="tel" name="num16" maxlength="1"></td>
                                                            </tr>
                                                            </tbody>
                                                        </table><br />
                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td align="left"><span style="font-size: 16px; color: #000;">Type of Card :</span> <input style="width: 67%; border: none; border-bottom: 1px solid;" type="text"></td>
                                                                            <td><span style="font-size: 16px; color: #000;">CVV :</span> <input style="width: 81%; border: none; border-bottom: 1px solid;" type="text"></td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table><br />
                                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td align="left"><span style="font-size: 16px; color: #000;">Exp. Date :</span> <input style="width: 67%; border: none; border-bottom: 1px solid;" type="text"></td>
                                                                            <td><span style="font-size: 16px; color: #000;">Amount : $ </span> <input style="width: 70%; border: none; border-bottom: 1px solid;" type="text"></td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table><br />
                                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td colspan="2" align="left"><span style="font-size: 16px; color: #000;">Account Holder Name :</span> <input style="width: 70%; border: none; border-bottom: 1px solid;" type="text"></td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table><br />
                                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td align="left">
                                                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                    <tbody>
                                                                                    <tr>
                                                                                        <td align="left" style="width: 100px; vertical-align: top;"><span style="font-size: 16px; color: #000;">Bill Address :</span></td>
                                                                                        <td align="left">
                                                                                            <input style="width: 98.9%; border: none; border-bottom: 1px solid; padding-top:10px; font-size: 16px;" type="text" name="address1">
                                                                                            <br>
                                                                                            <input style="width: 98.9%; border: none; border-bottom: 1px solid; padding-top:10px; font-size: 16px;" type="text" name="address2"><br>
                                                                                            <input style="width: 98.9%; border: none; border-bottom: 1px solid; padding-top:10px; font-size: 16px;" type="text" name="address3">
                                                                                        </td>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table><br />
                                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td align="left"><span style="font-size: 16px; color: #000;">Signature :</span> <input style="width: 67%; border: none; border-bottom: 1px solid;" type="text"></td>
                                                                            <td><span style="font-size: 16px; color: #000;">Date :</span> <input style="width: 81%; border: none; border-bottom: 1px solid;" type="text"></td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <br />
                                            <br />
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
