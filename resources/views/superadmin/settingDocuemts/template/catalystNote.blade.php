<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOAP Notes</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0px;
            padding: 0px;
            font-family: 'Open Sans', sans-serif;
        }

        ::placeholder {
            font-size: 16px !important;
            font-family: 'Open Sans', sans-serif;
        }

        .mb_30 {
            margin-bottom: 20px;
        }

        .treatment-plan {
            width: 100%;
            max-width: 1280px;
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

        .treatment-plan .row1 {
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

        .treatment-plan input,
        .treatment-plan textarea {
            border: none;
            outline: none;
            font-size: 15px;
            color: #333;
        }

        .treatment-plan table {
            width: 100%;
            border-collapse: collapse;
        }

        .treatment-plan label,
        .treatment-plan h3 {
            font-size: 17px;
            margin: 0px;
            font-weight: bold;
            color: #000;
        }

        .treatment-plan table td {
            padding: 6px 10px;
            border: 2px solid #207ac7;
            border-collapse: collapse;
            vertical-align: top;
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

        .treatment-plan .flex-div > span:nth-child(2) input,
        .treatment-plan .flex-div > span:nth-child(2) textarea {
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

        .treatment-plan textarea {
            resize: vertical;
        }

        .treatment-plan table td .flex-div {
            flex-direction: column;
            justify-content: flex-start;
            width: 100%;
        }

        /*----------------bottom button css start................*/
        .treatment-plan label,
        .treatment-plan h3 {
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

        .treatment-plan .section_bottom .flex-div.button-row div a,
        .treatment-plan .section_bottom .flex-div.button-row div button {
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

        .treatment-plan .section_bottom .flex-div.button-row div a i.fas,
        .treatment-plan .section_bottom .flex-div.button-row div button i.fas {
            margin-right: 6px;
        }

        .treatment-plan .section_bottom .mark-sign a {
            background: #5cb85c;
            color: #fff !important;
        }

        .treatment-plan .section_bottom .flex-div.button-row div.cancel button {
            background: #d9534f;
            color: #fff;
        }

        .treatment-plan .section_bottom .flex-div:nth-child(1) .col-item:nth-last-child(1) {
            display: flex;
            flex-direction: column;
        }

        .logo {
            margin: 0;
            text-align: left;
            display: block;
            padding: 0px 0px 0px;
        }

        .logo img {
            width: 100%;
            max-width: 250px;
        }

        .info-details {
            text-align: left;
            float: right;
            width: 100%;
            max-width: 320px;
        }

        .info-details p {
            margin: 0;
            font-size: 17px;
            color: #000;
            line-height: 24px;
        }

        .info-details p {
            color: #d9534f !important;
            font-size: 17px !important;
        }

        .info-details ul {
            margin: 0px auto 0px;
            padding: 0;
            display: block;
        }

        .info-details ul li {
            list-style: none;
            font-size: 17px;
            color: #000;
            margin-bottom: 5px;
        }

        .info-details ul li span,
        .info-details ul li a span {
            font-weight: 700;
            color: #207ac7;
            margin-right: 5px;
        }

        .info-details ul li a {
            color: #000;
            text-decoration: none;
            transition: 0.5s all ease-in-out;
        }

        .page-title h1 {
            margin-top: 0px;
            text-align: center;
            color: #d9534f;
            font-size: 30px;
            text-transform: uppercase;
            max-width: max-content;
            margin: 0 auto;
            position: relative;
            padding: 0px 0px 15px;
            font-weight: bold;
        }

        /*----------------footer button css start................*/
        .section_bottom {
            margin: 60px auto 0px;
            width: 100%;
        }

        .section_bottom label,
        .section_bottom table tr td,
        .section_bottom h3 {
            font-size: 17px;
            margin: 0px;
            font-weight: bold;
        }

        .checkbox-area ul li label {
            font-weight: 600;
        }

        .section_bottom .flex-div.button-row {
            margin: 30px auto 0px;
            justify-content: space-between;
            display: flex;
            flex-wrap: wrap;
        }

        .section_bottom .flex-div.button-row div {
            flex: auto;
            max-width: max-content;
            width: auto;
        }

        .section_bottom .flex-div.button-row div a {
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

        .section_bottom .flex-div.button-row div a i.fas {
            margin-right: 6px;
        }

        .section_bottom .mark-sign a {
            background: #5cb85c;
            color: #fff !important;
        }

        .section_bottom .flex-div.button-row div.cancel a {
            background: #d9534f;
            color: #fff;
        }

        .section_bottom .flex-div:nth-child(1) .col-item:nth-last-child(1) {
            display: flex;
            flex-direction: column;
        }

        /*========================footer bottom===========================*/
        .footer-section {
            margin: 50px auto 0px;
            box-shadow: 0px -5px 6px -4px #ccc;
            padding: 20px 0px;
        }

        .footer-section .flex-div {
            display: flex;
            justify-content: space-between;
        }

        .footer-section .flex-div .col-item:nth-child(2) p {
            text-align: right;
        }

        .footer-section .flex-div .col-item {
            flex: auto;
            width: auto;
        }

        .footer-section .flex-div .col-item p {
            margin: 0;
            font-size: 14px;
        }

        .footer-section .flex-div .col-item p a {
            color: #207ac7;
            text-decoration: none;
            font-weight: 600;
        }

        .flex-div2.row-flex:nth-child(2) .col-item:nth-child(2) {
            width: 14%;
        }

        .section_bottom .flex-div span:nth-child(1) {
            width: auto;
        }

        .save-prog button {
            background: #483D8B;
            color: #fff !important;
        }

        .print button {
            background: #467fd0;
            color: #fff !important;
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

            .treatment-plan label,
            .treatment-plan h3 {
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

            .treatment-plan .flex-div > span:nth-child(2) input,
            .treatment-plan .flex-div > span:nth-child(2) textarea {
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

            .section_7 .table-box table td,
            .section_7 .table-box table th {
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

            .logo img {
                max-width: 250px;
            }

            .section_bottom {
                margin: 0px auto 0px;
            }

            .section_bottom .flex-div.button-row {
                flex-direction: row;
                justify-content: center;
                row-gap: 15px;
                column-gap: 15px;
            }

            .section_bottom .flex-div.button-row div a {
                padding: 10px 14px;
                font-size: 14px;
            }

            .footer-section .flex-div {
                display: flex;
                justify-content: space-between;
                flex-direction: column;
            }

            .footer-section .flex-div .col-item p {
                font-size: 14px;
                text-align: center;
            }

            .footer-section .flex-div .col-item:nth-child(2) p {
                text-align: center;
                font-size: 14px;
            }

            .footer-section .flex-div {
                flex-direction: column;
                row-gap: 10px;
            }

            .footer-section {
                margin: 40px auto 0px;
                box-shadow: 0px -5px 6px -4px #ccc;
                padding: 20px 0px 0px;
            }

            section .box.box-last_2 {
                margin-top: 10px;
            }

            section .box.box-last_2 .flex-div {
                column-gap: 0px;
            }

            /*------------------header responsive css ----------------*/
            .logo {
                text-align: center;
            }

            .flex-div {
                align-items: center;
                padding: 0px 15px 15px;
                box-sizing: border-box;
                justify-content: space-between;
                display: flex;
                flex-direction: column;
            }

            .flex-div .col-item {
                width: 100%;
                margin: 0px auto 20px;
            }

            .flex-div .info-details {
                text-align: center;
                float: none;
                width: 100%;
                max-width: 320px;
                margin: 0 auto;
            }

            .col-item:nth-child(2) {
                width: 100% !important;
            }

            .col-item .info-details ul li {
                font-size: 14px;
            }

            .page-title h1 {
                font-size: 17px;
                padding: 0px 0px 1
            }
        }

        @media only screen and (max-width: 580px) {

            .treatment-plan table tr:nth-child(1) td,
            .treatment-plan table tr:nth-child(2) td {
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

        .form-control:focus {
            box-shadow: none;
        }
    </style>
</head>

<body>
<div class="treatment-plan">
    <div class="content">
        <div class="flex-div">
            <div class="col-item">
                <div class="logo"><a href="#"><img
                            src="{{asset('assets/dashboard/template/')}}/logo4.png"
                            alt=""></a></div>
            </div>
            <div class="col-item">
              <div class="info-details">
                <ul>
                  <li> <span>Mail:</span>demo@example.com</li>
                  <li><a href="#"> <span>Email:</span>demo@example.com</a></li>
                  <li><span>Phone:</span> 000-000-0000</li>
                  <li><a href="#"><span>Fax:</span>000.000.0000</a></li>
                </ul>
              </div>
            </div>
        </div>
        <form action="#">
            <div class="page-title mb_40">
                <h1> SOAP Notes</h1>
            </div>
            <div class="top-part" style="margin-top:10px;">
                <div class="row1 flex-div mb_30">
                    <div class="client-name"><label>Client Name:</label> <input type="text"
                                                                                placeholder="Enter Your Name..."></div>
                    <div class="date"><label>DOS:</label> <input type="date"></div>
                </div>
                <div class="row1 flex-div mb_30">
                    <div class="client-name"><label>Therapist:</label> <input type="text"
                                                                              placeholder="Enter Your Name..."></div>
                    <div class="date"><label>Start Time:</label> <input type="time"></div>
                    <div class="date"><label>End Time:</label> <input type="time"></div>
                </div>
                <div class="mb_30">
                    <label class="d-block mb-2">Notes</label>
                    <textarea class="form-control border" rows="3" placeholder="Enter Notes..."></textarea>
                </div>
            </div>
            <section class="section_1">
                <table cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td><label>Question</label></td>
                        <td><label>Answer</label></td>
                    </tr>
                    <tr>
                        <td rowspan="3">
                            <div class="flex-div first"><span><label>Location:</label></span> <span>
											<textarea class="form-control"
                                                      placeholder="Enter Location..."></textarea></span>
                            </div>
                        </td>
                        <td><label>Date:</label><input type="date"></td>
                    </tr>
                    <tr>
                        <td><label>Start Time:</label> <input type="time"></td>
                    </tr>
                    <tr>
                        <td><label>End Time:</label> <input type="time"></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex-div">
										<span><label>Location of
												Service:</label></span> <span>
											<textarea class="form-control"
                                                      placeholder="Enter Location of Service..."></textarea></span>
                            </div>
                        </td>
                        <td>
                            <span><label class="d-block">Supervisor Present?</label></span>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="yn">Yes
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="yn">No
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span><label class="d-block">Caregiver Participated in Session?</label></span>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="yn2">Yes
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="yn2">No
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="flex-div"><span><label>Strategies used during session:
											</label></span> <span><textarea class="form-control"
                                                                            placeholder="Enter here..."></textarea></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex-div"><span><label>Targets worked on during session:
											</label></span> <span><textarea class="form-control"
                                                                            placeholder="Enter here..."></textarea></span>
                            </div>
                        </td>
                        <td>
                            <div class="flex-div"><span><label>What
												notable
												maladaptive
												behaviors
												were
												observed?
											</label></span> <span><textarea class="form-control"
                                                                            placeholder="Enter here..."></textarea></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex-div"><span><label>If "Other",
												please
												describe
												behaviors:
											</label></span> <span><textarea class="form-control"
                                                                            placeholder="Enter here..."></textarea></span>
                            </div>
                        </td>
                        <td>
                            <div class="flex-div"><span><label>Notes:
											</label></span> <span><textarea class="form-control"
                                                                            placeholder="Enter here..."></textarea></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="flex-div"><span><label>Location
												Address:
											</label></span> <span><textarea class="form-control"
                                                                            placeholder="Enter here..."></textarea></span>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <ul class="list-inline mt-3">
                    <li class="list-inline-item">
                      <a href="#" data-target="#signatureModal" data-toggle="modal">Provider Signature<i class="fa fa-signature"></i></a>
                    </li>
                    <li class="list-inline-item float-right">
                      <a href="#" data-target="#signatureModal2" data-toggle="modal">Caregiver Signature<i class="fa fa-signature"></i></a>
                    </li>
                  </ul>
            </section>
            <div class="section_bottom">
                <div class="button-row flex-div">
                    <div class="save-prog">
                        <button type="button"><span class="cloud-icon"><i
                                    class="fas fa-cloud"></i></span>
                            Save
                        </button>
                    </div>
                    <div class="print">
                        <button type="button"><span class="print-icon"><i
                                    class="fas fa-print"></i></span>Print
                        </button>
                    </div>
                    
                </div>
            </div>

                <!-- signature modal provider -->
        <div class="modal fade" id="signatureModal" data-backdrop="static">
          <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h4>Add signature</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#drawsig">Draw</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#uploadsig">Upload</a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane fade show active" id="drawsig">
                    <div class="row mb-2">
                      <div class="col-md-12">
                        <canvas id="sig-canvas" height="120" style="width: 100%;"></canvas>
                      </div>
                      <input type="hidden" class="form-control-file sing_draw"
                      name="sing_draw">
                    </div>
                    <button type="button" class="btn btn-danger p-2" id="sig-clearBtn">Clear</button>
                  </div>
                  <div class="tab-pane fade" id="uploadsig">
                    <label>Upload File</label>
                    <input type="file" class="form-control-file" name="updload_sign">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Add
                Signature
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>

        <!-- signature modal caregiver -->
        <div class="modal fade" id="signatureModal2" data-backdrop="static">
          <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h4>Add signature</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#drawsig2">Draw</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#uploadsig2">Upload</a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane fade show active" id="drawsig2">
                    <div class="row mb-2">
                      <div class="col-md-12">
                        <canvas id="sig-canvas2" height="120" style="width: 100%;"></canvas>
                      </div>
                      <input type="hidden" class="form-control-file sing_draw2"
                      name="sing_draw2">
                    </div>
                    <button type="button" class="btn btn-danger p-2" id="sig-clearBtn2">Clear</button>
                  </div>
                  <div class="tab-pane fade" id="uploadsig2">
                    <label>Upload File</label>
                    <input type="file" class="form-control-file" name="updload_sign2">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Add
                Signature
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>
        </form>
        <div class="footer-section">
        <div class="flex-div">
          <div class="col-item">
            <p><strong>Demo Institution</strong> somewhere in america</p>
          </div>
          <div class="col-item">
            <p> <a href="tel:000-000-0000">Phone: 000-000-0000,</a> &nbsp;<a href="mailto:">
                <span>Email:</span> demo@example.com,</a>&nbsp; <a href="fax:000.000.0000"> Fax:
                000.000.0000,</a>&nbsp; <a href="https://example.com/">example.com</a> </p>
          </div>
        </div>
      </div>
    </div>
</div>
<!-- Jq Files -->
<script src="{{asset('assets/dashboard/')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/js/popper.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/js/bootstrap.min.js"></script>
@include('superadmin.appoinment.include.forms_js_include')
</body>

</html>
