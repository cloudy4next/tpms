<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>Parent Training Session Note</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/tem12/')}}/css/custom-12.css">
</head>

<body>
<div class="parent-training">
    <header>
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
    </header>
    <div class="content">
      <div class="page-title mb_40">
        <h1>Parent Training Session Note</h1>
      </div>
      <form action="" method="post" id="form_12">
        <section class="section_1 mb_30">
          <h3 class="mb-3">Client Information:</h3>
          <table cellspacing="0" cellpadding="0">
            <tbody>
              <tr>
                <td>
                  <div class="flex-div"><span>
                      <label for="clname">Client Name:</label>
                    </span> <span>
                      <input type="text" id="clname" name="clname">
                    </span></div>
                </td>
                <td>
                  <div class="flex-div"><span>
                      <label for="dob">DOB:</label>
                    </span> <span>
                      <input type="date" id="dob" name="dob">
                    </span></div>
                </td>
                <td>
                  <div class="flex-div"><span>
                      <label for="age">Age:</label>
                    </span> <span>
                      <input type="text" id="age" name="age">
                    </span></div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="flex-div"><span>
                      <label for="diag">Diagnosis:</label>
                    </span> <span>
                      <input type="text" id="diag" name="diag">
                    </span></div>
                </td>
                <td colspan="2">
                  <div class="flex-div"><span>
                      <label for="insured">Insured Id:</label>
                    </span> <span>
                      <input type="text" id="insured" name="insured">
                    </span></div>
                </td>
              </tr>
            </tbody>
          </table>
        </section>
        <section class="section_1 mb_30">
          <h3 class="mb-3">Provider Information:</h3>
          <table cellspacing="0" cellpadding="0">
            <tbody>
              <tr>
                <td>
                  <div class="flex-div"><span>
                      <label for="p_name">Provider Name:</label>
                    </span> <span>
                      <input type="text" id="p_name" name="p_name">
                    </span></div>
                </td>
                <td>
                  <div class="flex-div"><span>
                      <label for="cred">Credentials :</label>
                    </span> <span>
                      <input type="text" id="cred" name="cred">
                    </span></div>
                </td>
              </tr>
            </tbody>
          </table>
        </section>
        <section class="section_1 mb_30">
          <h3 class="mb-3">Individual Present:</h3>
          <table cellspacing="0" cellpadding="0">
            <tbody>
              <tr>
                <td>
                  <div class="flex-div"><span>
                      <label>Caregiver:</label>
                    </span> <span>
                      <input type="text" name="caregiver">
                    </span></div>
                </td>
                <td>
                  <div class="flex-div"><span>
                      <label for="clname2">Client Name:</label>
                    </span> <span>
                      <input type="text" id="clname2" name="clname2">
                    </span></div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="bcba">BCBA
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="rbt">RBT
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="other">Other
                    </label>
                  </div>
                  <input type="text" class="border border-primary" placeholder="Explain..">
                </td>
              </tr>
            </tbody>
          </table>
        </section>
        <section class="section_1 mb_30">
          <h3 class="mb-3">Parent Training Session Date:</h3>
          <table cellspacing="0" cellpadding="0">
            <tbody>
              <tr>
                <td>
                  <div class="flex-div"><span>
                      <label for="sd">Service Date :</label>
                    </span> <span>
                      <input type="date" id="sd" name="sd">
                    </span></div>
                </td>
                <td>
                  <div class="flex-div"><span>
                      <label for="sst">Service Start Time:</label>
                    </span> <span>
                      <input type="time" id="sst" name="sst">
                    </span></div>
                </td>
                <td>
                  <div class="flex-div"><span>
                      <label for="set">Service End Time :</label>
                    </span> <span>
                      <input type="time" id="set" name="set">
                    </span></div>
                </td>
              </tr>
            </tbody>
          </table>
        </section>
        <section class="section_2 mb_30">
          <h3 class="mb-3">Parent Training Provided</h3>
          <ul class="list-inline">
            <li class="list-inline-item">
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="in_person">In Person
                </label>
              </div>
            </li>
            <li class="list-inline-item">
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="remote">Remote
                </label>
              </div>
            </li>
          </ul>
        </section>
        <section class="section_2 mb_30">
          <div class="box box1 mb_30">
            <div class="col-title mb_15">
              <h3>
                <label for="pto">Parent Training Overview:</label>
              </h3>
            </div>
            <div class="textarea">
              <textarea id="pto" rows="5" name="pto"></textarea>
            </div>
          </div>
          <div class="box box2">
            <div class="col-title mb_15">
              <h3>
                <label for="fd">Feedback to Parent:</label>
              </h3>
            </div>
            <div class="textarea">
              <textarea id="fd" rows="5" name="fd"></textarea>
            </div>
          </div>
        </section>
        <section class="section_2 mb_30">
          <table cellspacing="0" cellpadding="0">
            <tbody>
              <tr>
                <td>
                  <div class="flex-div"><span>
                      <label for="pfn">Provider Full Name:</label>
                    </span> <span>
                      <input type="text" id="pfn" name="pfn">
                    </span></div>
                </td>
                <td>
                  <div class="flex-div"><span>
                    <label for="pcred">Provider Credentials:</label>
                    </span> <span>
                      <input type="text" id="pcred" name="pcred">
                    </span></div>
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
        <section class="section_bottom">
          <div class="button-row flex-div">
            <div class="save-prog"><button type="button"><span class="cloud-icon"><i class="fas fa-cloud"></i></span>
                Save</button></div>
            <div class="print"><button type="button"><span class="print-icon"><i
                    class="fas fa-print"></i></span>Print</button></div>
            
          </div>
        </section>
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
      <section class="footer-section">
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
      </section>
    </div>
</div>
<!-- Jq Files -->
<script src="{{asset('assets/dashboard//')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/popper.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/bootstrap.min.js"></script>
<!-- Signature -->
<script>
    (function () {
        window.requestAnimFrame = (function (callback) {
            return window.requestAnimationFrame ||
                window.webkitRequestAnimationFrame ||
                window.mozRequestAnimationFrame ||
                window.oRequestAnimationFrame ||
                window.msRequestAnimaitonFrame ||
                function (callback) {
                    window.setTimeout(callback, 1000 / 60);
                };
        })();
        var canvas = document.getElementById("sig-canvas");
        var ctx = canvas.getContext("2d");
        ctx.strokeStyle = "#222222";
        ctx.lineWidth = 4;
        var drawing = false;
        var mousePos = {
            x: 0,
            y: 0
        };
        var lastPos = mousePos;
        canvas.addEventListener("mousedown", function (e) {
            drawing = true;
            lastPos = getMousePos(canvas, e);
        }, false);
        canvas.addEventListener("mouseup", function (e) {
            drawing = false;
        }, false);
        canvas.addEventListener("mousemove", function (e) {
            mousePos = getMousePos(canvas, e);
        }, false);
        // Add touch event support for mobile
        canvas.addEventListener("touchstart", function (e) {
        }, false);
        canvas.addEventListener("touchmove", function (e) {
            var touch = e.touches[0];
            var me = new MouseEvent("mousemove", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(me);
        }, false);
        canvas.addEventListener("touchstart", function (e) {
            mousePos = getTouchPos(canvas, e);
            var touch = e.touches[0];
            var me = new MouseEvent("mousedown", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(me);
        }, false);
        canvas.addEventListener("touchend", function (e) {
            var me = new MouseEvent("mouseup", {});
            canvas.dispatchEvent(me);
        }, false);

        function getMousePos(canvasDom, mouseEvent) {
            var rect = canvasDom.getBoundingClientRect();
            return {
                x: mouseEvent.clientX - rect.left,
                y: mouseEvent.clientY - rect.top
            }
        }

        function getTouchPos(canvasDom, touchEvent) {
            var rect = canvasDom.getBoundingClientRect();
            return {
                x: touchEvent.touches[0].clientX - rect.left,
                y: touchEvent.touches[0].clientY - rect.top
            }
        }

        function renderCanvas() {
            if (drawing) {
                ctx.moveTo(lastPos.x, lastPos.y);
                ctx.lineTo(mousePos.x, mousePos.y);
                ctx.stroke();
                lastPos = mousePos;
            }
        }

        // Prevent scrolling when touching the canvas
        document.body.addEventListener("touchstart", function (e) {
            if (e.target == canvas) {
                e.preventDefault();
            }
        }, false);
        document.body.addEventListener("touchend", function (e) {
            if (e.target == canvas) {
                e.preventDefault();
            }
        }, false);
        document.body.addEventListener("touchmove", function (e) {
            if (e.target == canvas) {
                e.preventDefault();
            }
        }, false);
        (function drawLoop() {
            requestAnimFrame(drawLoop);
            renderCanvas();
        })();

        function clearCanvas() {
            canvas.width = canvas.width;
        }

        // Set up the UI
        var sigText = document.getElementById("sig-dataUrl");
        var sigImage = document.getElementById("sig-image");
        var clearBtn = document.getElementById("sig-clearBtn");
        var submitBtn = document.getElementById("sig-submitBtn");
        clearBtn.addEventListener("click", function (e) {
            clearCanvas();
            sigText.innerHTML = "Data URL for your signature will go here!";
            sigImage.setAttribute("src", "");
        }, false);
    })();
</script>
</body>

</html>
