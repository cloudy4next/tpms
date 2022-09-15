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