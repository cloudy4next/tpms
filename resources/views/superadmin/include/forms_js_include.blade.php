<script src="{{ asset('assets/dashboard/vendor/') }}/signature/sketchpad.js"></script>
<style>
    .modal { 
        position: fixed; 
        top: 3%; 
        right: 3%; 
        left: 3%; 
        width: auto; 
        margin: 0; 
    }
    .modal-body { 
        height: 60%; 
        max-height: 350px; 
        padding: 15px; 
        overflow-y: auto; 
        -webkit-overflow-scrolling: touch; 
    }

    #sig-canvas , #sig-canvas2 {
        margin-top: 20px;
    }
    #signatureModal  .modal-content .modal-body ,#signatureModal2  .modal-content .modal-body {
        display: -webkit-box;
        display: -ms-flexbox;
        display: block;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        height: 50vh !important;
        width: 100%;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        margin: 0;
        padding: 32px 16px;
        font-family: Helvetica, Sans-Serif;
    }

</style>
<script>

    $('#signatureModal').on('shown.bs.modal', function () {
        var modalDialogHeight = $(this).find('.modal-body').outerHeight(true);
        var modalDialogWidth = $(this).find('.modal-body').outerWidth(true);

        var sketchpad = new Sketchpad({
            element: '#sig-canvas',
            height: modalDialogHeight-190,
            width: modalDialogWidth-35
        });

        sketchpad.penSize = 3;
        $('#sig-clearBtn').click(function(){
                sketchpad.clear();
        })
    });


    $('#signatureModal2').on('shown.bs.modal', function () {
        var modalDialogHeight = $(this).find('.modal-body').outerHeight(true);
        var modalDialogWidth = $(this).find('.modal-body').outerWidth(true);

        var sketchpad2 = new Sketchpad({
            element: '#sig-canvas2',
            height: modalDialogHeight-190,
            width: modalDialogWidth-35
        });

        sketchpad2.penSize = 3;
        $('#sig-clearBtn2').click(function(){
                sketchpad2.clear();
        })
    });



</script>






<!-- Providers Signature -->
{{-- <script>
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
</script> --}}

<!-- Caregiver Signature -->
{{-- <script>
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
        var canvas5 = document.getElementById("sig-canvas2");
        var ctx = canvas5.getContext("2d");
        ctx.strokeStyle = "#222222";
        ctx.lineWidth = 4;
        var drawing = false;
        var mousePos = {
            x: 0,
            y: 0
        };
        var lastPos = mousePos;
        canvas5.addEventListener("mousedown", function (e) {
            drawing = true;
            lastPos = getMousePos(canvas5, e);
        }, false);
        canvas5.addEventListener("mouseup", function (e) {
            drawing = false;
        }, false);
        canvas5.addEventListener("mousemove", function (e) {
            mousePos = getMousePos(canvas5, e);
        }, false);
        // Add touch event support for mobile
        canvas5.addEventListener("touchstart", function (e) {
        }, false);
        canvas5.addEventListener("touchmove", function (e) {
            var touch = e.touches[0];
            var me = new MouseEvent("mousemove", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas5.dispatchEvent(me);
        }, false);
        canvas5.addEventListener("touchstart", function (e) {
            mousePos = getTouchPos(canvas5, e);
            var touch = e.touches[0];
            var me = new MouseEvent("mousedown", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas5.dispatchEvent(me);
        }, false);
        canvas5.addEventListener("touchend", function (e) {
            var me = new MouseEvent("mouseup", {});
            canvas5.dispatchEvent(me);
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
            if (e.target == canvas5) {
                e.preventDefault();
            }
        }, false);
        document.body.addEventListener("touchend", function (e) {
            if (e.target == canvas5) {
                e.preventDefault();
            }
        }, false);
        document.body.addEventListener("touchmove", function (e) {
            if (e.target == canvas5) {
                e.preventDefault();
            }
        }, false);
        (function drawLoop() {
            requestAnimFrame(drawLoop);
            renderCanvas();
        })();

        function clearCanvas() {
            canvas5.width = canvas5.width;
        }
        // Set up the UI
        var sigText = document.getElementById("sig-dataUrl2");
        var sigImage = document.getElementById("sig-image2");
        var clearBtn = document.getElementById("sig-clearBtn2");
        var submitBtn = document.getElementById("sig-submitBtn2");
        clearBtn.addEventListener("click", function (e) {
            clearCanvas();
            sigText.innerHTML = "Data URL for your signature will go here!";
            sigImage.setAttribute("src", "");
        }, false);
    })();
</script> --}}