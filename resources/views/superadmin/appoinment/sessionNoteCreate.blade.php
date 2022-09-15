<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TREATMENT PLAN</title>

    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap');
        *{
            box-sizing:border-box;
        }

        body{
            margin:0px;
            padding:0px;
            font-family: 'Open Sans', sans-serif;
        }
        ::placeholder {
            font-size: 16px !important;
            font-family:'Open Sans', sans-serif;
        }
        .mb_30{
            margin-bottom:20px;
        }
        .treatment-plan {
            width: 100%;
            max-width: 1240px;
            display: block;
            margin: 0 auto;
            padding: 30px 20px;
            background: #207ac7;
        }
        .treatment-plan .flex-div {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .treatment-plan .flex-div.first {
            align-items: normal;
        }
        .treatment-plan .flex-div > div {
            width: 50%;
        }
        .treatment-plan .flex-div > div.client-name {
            text-align: left;
            width: 50%;
            display: flex;
        }
        .treatment-plan .flex-div > div.client-name label {
            width: 100%;
            max-width: max-content;
        }
        .treatment-plan .flex-div > div.date {
            text-align: right;
        }
        .treatment-plan .row1 .client-name input {
            width: 80%;
        }
        .treatment-plan .row1{
            text-align: center;
        }
        .treatment-plan .row2 label:nth-child(1) {
            font-size: 17px;
        }

        .treatment-plan .row2 input {
            margin-left: 15px;
        }
        .treatment-plan .row2 input + label {
            margin-left: 3px;
        }
        .treatment-plan .row2 label {
            font-size: 15px;
        }
        .treatment-plan .top-part {
            margin: 0 auto;
            display: block;
            width: 100%;
            max-width: 100%;
        }
        .treatment-plan .row2.mb_30 {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .treatment-plan .page-title h1 {
            margin-top: 0px;
            text-align: center;
            color: #fff;
            font-size: 35px;
        }
        .treatment-plan .row1 {
            display: flex;
            width: 100%;
        }
        .treatment-plan .row1 .date {
            width: 100%;
        }
        .treatment-plan .content {
            border: 3px solid #fff;
            padding: 20px;
            background: #fff;
        }
        .treatment-plan input, .treatment-plan textarea {
            border: none;
            outline: none;
            font-size: 15px;
            color: #333;
        }

        .treatment-plan table {
            width: 100%;
            border-collapse: collapse;
        }
        .treatment-plan label, .treatment-plan h3 {
            font-size: 17px;
            margin: 0px;
            font-weight: bold;
            color: #000;
        }
        .treatment-plan table td {
            padding: 6px 10px;
            border: 2px solid #207ac7;
            border-collapse: collapse;
            vertical-align:top;
        }

        .treatment-plan .flex-div > span {
            flex: auto;
        }
        .treatment-plan table td .flex-div span {
            width: 100%;
        }
        .treatment-plan .flex-div.first span:nth-child(1) label {
            font-weight: 700;
        }
        .treatment-plan .flex-div > span:nth-child(1) {
            width: 100%;
            max-width: 100%;
        }

        .treatment-plan .flex-div > span:nth-child(2) input, .treatment-plan .flex-div > span:nth-child(2) textarea {
            width: 100%;
            padding: 5px 0px;
        }
        .treatment-plan .flex-div > span:nth-child(1) label {
            font-weight: 700;
        }
        .treatment-plan .flex-div.first span:nth-child(1) label {
            font-weight: 700;
        }
        .treatment-plan section {
            margin-top: 50px;
            box-shadow: 0px 0px 11px 0px #ccc;
        }

        .treatment-plan textarea{
            resize: vertical;
        }
        .treatment-plan table td .flex-div {
            flex-direction: column;
            justify-content: flex-start;
            width: 100%;
        }

        /*----------------bottom button css start................*/
        .treatment-plan label, .treatment-plan h3 {
            font-size: 17px;
            margin: 0px;
            font-weight: bold;
        }

        .treatment-plan .section_bottom .flex-div.button-row {
            margin: 30px auto 0px;
            justify-content: space-between;
            display: flex;
            flex-wrap: wrap;
        }
        .treatment-plan .section_bottom .flex-div.button-row div {
            flex: auto;
            max-width: max-content;
            width: auto;
        }

        .treatment-plan .section_bottom .flex-div.button-row div a {
            padding: 11px 20px;
            font-size: 17px;
            display: block;
            text-align: center;
            border-radius: 10px;
            border: 2px solid #ddd;
            text-decoration: none;
            color: #000;
            font-weight: 600;
        }
        .treatment-plan .section_bottom .flex-div.button-row div a i.fas {
            margin-right: 6px;
        }
        .treatment-plan .section_bottom .mark-sign a {
            background: #5cb85c;
            color: #fff !important;
        }
        .treatment-plan .section_bottom .flex-div.button-row div.cancel a {
            background: #d9534f;
            color: #fff;
        }

        .treatment-plan .section_bottom .flex-div:nth-child(1) .col-item:nth-last-child(1) {
            display: flex;
            flex-direction: column;
        }

        @media only screen and (max-width: 768px) {
            ::placeholder {
                font-size: 14px !important;
            }
            .treatment-plan .page-title h1 {
                font-size: 20px;
            }
            .treatment-plan .row1.flex-div > div.client-name label {
                width: 100%;
                max-width: max-content;
            }
            .treatment-plan .flex-div > div.client-name {
                width: 100%;
            }
            .treatment-plan .row1 {
                text-align: left;
                row-gap: 10px;
            }
            .treatment-plan label, .treatment-plan h3 {
                font-size: 14px;
            }
            .treatment-plan .flex-div > div.date {
                text-align: left;
            }
            .treatment-plan .flex-div > div {
                width: 100%;
            }
            .treatment-plan .flex-div > div.client-name {
                text-align: left;
                display: flex;
            }
            .treatment-plan .flex-div > div.client-name label {
                width: 100%;
                max-width: max-content;
                max-width: -moz-max-content;
                margin-right: 10px;
            }
            .treatment-plan .row2 label:nth-child(1) {
                font-size: 14px;
            }
            .treatment-plan .row2.mb_30 {
                justify-content: flex-start;
            }

            .treatment-plan .flex-div > span:nth-child(2) input, .treatment-plan .flex-div > span:nth-child(2) textarea {
                padding: 0px 0px;
            }
            .treatment-plan section {
                margin-top: 30px;
            }
            .treatment-plan .row2.mb_30 span:nth-child(2) label:nth-child(2) {
                margin-right: 10px;
            }

            .treatment-plan .section_bottom > div {
                flex-direction: row !important;
                row-gap: 10px !important;
                column-gap: 10px;
            }
            .section_8 .table-box {
                margin: 0px auto 0px;
                width: 100%;
                overflow: auto;
            }
            .section_7 .table-box table td, .section_7 .table-box table th {
                font-size: 14px;
            }

            .treatment-plan .section_bottom .flex-div.button-row div a {
                padding: 8px 10px;
                font-size: 14px;
                border: 1px solid #ddd;
            }
            .treatment-plan .section_bottom .flex-div.button-row {
                justify-content: space-evenly;
            }
            .treatment-plan .section_bottom {
                margin: 50px auto 20px;
            }

        }
        @media only screen and (max-width: 580px) {
            .treatment-plan table tr:nth-child(1) td, .treatment-plan table tr:nth-child(2) td {
                display: block;
                width: 100.5%;
                border-bottom: none;
                margin: 0 auto 0px -1px;
            }
            .treatment-plan .row1 .date {
                column-gap: 1%;
                width: 100%;
            }
            .treatment-plan .flex-div {
                flex-direction: column;
            }
            .treatment-plan .row2.mb_30 {
                flex-direction: column;
            }
            .treatment-plan .row2 label:nth-child(1) {
                text-align: left;
                width: 100%;
            }
            .treatment-plan .row2.mb_30 span {
                width: 100%;
                text-align: center;
            }
            .treatment-plan .row2 input {
                margin-left: 0px;
            }
            section.section_bottom {
                border: none;
                box-shadow: none;
            }
        }

    </style>

    <link rel="stylesheet" type="text/css" href="{{asset('assets/')}}/toastr/build/toastr.min.css">

</head>
<body>
<form action="{{route('superadmin.create.note.save')}}" method="post">
    @csrf
    <div class="treatment-plan">
        <div class="page-title"><h1>TREATMENT PLAN</h1></div>
        <div class="content">
            <div class="top-part">
                <div class="row1 flex-div mb_30">
                    <div class="client-name"><label>Client Name:</label>
<!--                        --><?php
//                            $client_name = \App\Models\Client::select('client_full_name')->where('id',$exist_session_note->client_id)->first();
//                        ?>
                        <input type="text"  placeholder="Enter Your Name..." value="{{$exist_session_note->client_name}}" name="client_name">
                        <input type="hidden"  value="{{$exist_session_note->id}}" name="session_id">
                    </div> <div class="date"><label>Date:</label>
                        <input type="date" name="note_date" value="{{$exist_session_note->note_date}}"></div></div>
                <div class="row2 mb_30">
                    <span><label>Type of Treatment Plan:</label></span>
                    <span><input type="checkbox" id="initial" name="initial" value="1" {{$exist_session_note->initial == 1 ? 'checked' : ''}}>
                        <label for="initial">initial</label>
                        <input type="checkbox" id="ongoing" name="ongoing" value="1" {{$exist_session_note->ongoing == 1 ? 'checked' : ''}}>
                        <label for="ongoing">ongoing</label>
                    </span>
                </div>
            </div>
            <section class="section_1">
                <table cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td rowspan="2">
                            <div class="flex-div first"><span><label>Goal 1:</label></span>
                                <span> <textarea rows="1" placeholder="Enter Goal 1..." name="goal1" >{!! $exist_session_note->goal1 !!}</textarea></span>
                            </div></td>
                        <td> <label>Open Date:</label><input type="date" name="goal1_odate" value="{{$exist_session_note->goal1_odate}}"></td>
                    </tr>
                    <tr>
                        <td><label>Target Date:</label> <input type="date" name="goal1_tdate" value="{{$exist_session_note->goal1_tdate}}"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><div class="flex-div"><span><label>Objective 1:</label></span>  <span><textarea rows="1" placeholder="Enter Objective..." name="goal1_obj">{!! $exist_session_note->goal1_obj !!}</textarea></span></div></td>
                    </tr>
                    <tr>
                        <td colspan="2"><div class="flex-div"><span><label>Intervention 1:</label></span>  <span><textarea rows="1" placeholder="Enter Intervention" name="goal1_int">{!! $exist_session_note->goal1_int !!}</textarea></span></div></td>
                    </tr>
                    </tbody>
                </table>
            </section>

            <section class="section_2">
                <table cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td rowspan="2"><div class="flex-div first"><span><label>Goal 2:</label></span>  <span> <textarea rows="1" placeholder="Enter Goal 2..." name="goal2">{!! $exist_session_note->goal2 !!}</textarea></span></div></td>
                        <td> <label>Open Date:</label><input type="date" name="goal2_odate" value="{{$exist_session_note->goal2_odate}}"></td>
                    </tr>
                    <tr>
                        <td><label>Target Date:</label> <input type="date" name="goal2_tdate" value="{{$exist_session_note->goal2_tdate}}"> </td>
                    </tr>
                    <tr>
                        <td colspan="2"><div class="flex-div"><span><label>Objective 1:</label></span>  <span><textarea rows="1" placeholder="Enter Objective..." name="goal2_obj"></textarea>{!! $exist_session_note->goal2_obj !!}</span></div></td>
                    </tr>
                    <tr>
                        <td colspan="2"><div class="flex-div"><span><label>Intervention 1:</label></span>  <span><textarea rows="1" placeholder="Enter Intervention" name="goal2_int"></textarea>{!! $exist_session_note->goal2_int !!}</span></div></td>
                    </tr>
                    </tbody>
                </table>
            </section>
            <section class="section_3">
                <table cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td rowspan="2"><div class="flex-div first"><span><label>Goal 3:</label></span>  <span> <textarea rows="1" placeholder="Enter Goal 3..." name="goal3">{!! $exist_session_note->goal3 !!}</textarea></span></div></td>
                        <td> <label>Open Date:</label><input type="date" name="goal3_odate" value="{{$exist_session_note->goal3_odate}}"></td>
                    </tr>
                    <tr>
                        <td><label>Target Date:</label> <input type="date" name="goal3_tdate" value="{{$exist_session_note->goal3_tdate}}"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><div class="flex-div"><span><label>Objective 1:</label></span>  <span><textarea rows="1" placeholder="Enter Objective..." name="goal3_obj">{!! $exist_session_note->goal3_obj !!}</textarea></span></div></td>
                    </tr>
                    <tr>
                        <td colspan="2"><div class="flex-div"><span><label>Intervention 1:</label></span>  <span><textarea rows="1" placeholder="Enter Intervention" name="goal3_int">{!! $exist_session_note->goal3_int !!}</textarea></span></div></td>
                    </tr>
                    </tbody>
                </table>
            </section>
            <section class="section_4">
                <table cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td rowspan="2"><div class="flex-div first"><span><label>Goal 4:</label></span>  <span> <textarea rows="1" placeholder="Enter Goal 4..." name="goal4">{!! $exist_session_note->goal4 !!}</textarea></span></div></td>
                        <td> <label>Open Date:</label><input type="date" name="goal4_odate" value="{{$exist_session_note->goal4_odate}}"></td>
                    </tr>
                    <tr>
                        <td><label>Target Date:</label> <input type="date" name="goal4_tdate" value="{{$exist_session_note->goal4_tdate}}"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><div class="flex-div"><span><label>Objective 1:</label></span>  <span><textarea rows="1" placeholder="Enter Objective..." name="goal4_obj">{!! $exist_session_note->goal4_obj !!}</textarea></span></div></td>
                    </tr>
                    <tr>
                        <td colspan="2"><div class="flex-div"><span><label>Intervention 1:</label></span>  <span><textarea rows="1" placeholder="Enter Intervention" name="goal4_int">{!! $exist_session_note->goal4_int !!}</textarea></span></div></td>
                    </tr>
                    </tbody>
                </table>
            </section>

            <section class="section_bottom">
                <div class="button-row flex-div">
                    <div class="mark-sign"><a href="#"><span class="mark-icon"><i class="fas fa-check"></i></span> Mark Completed and Sign</a></div>
                    <div class="mark-sign">
                        <button class="btn btn-success" type="submit">Save</button>
                    </div>
                    <div class="expot-file"><a href="#"><span class="download-icon"><i class="fas fa-download"></i></span>Export to File</a></div>
                    <div class="print" id="submit"><a href="#"><span class="print-icon"><i class="fas fa-print"></i></span>Print</a></div>
                    <div class="cancel"><a href="#"><span class="cross-icon"><i class="fas fa-times"></i></span>Cancel</a></div>
                </div>
            </section>
        </div>
    </div>
</form>
<script type="text/javascript" src="{{asset('assets/dashboard/sessionnote/')}}//jquery.min.js"></script>
<script src="{{asset('assets/toastr/')}}/build/toastr.min.js"></script>

<!-- toastr init -->
<script src="{{asset('assets/toastr/')}}/toastr.init.js"></script>
<script type="text/javascript">
</script>
@include('layouts.message')










</body>
</html>



