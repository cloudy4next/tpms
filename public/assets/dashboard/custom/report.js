$('.specific-date').hide();
$('.date-range').hide();
$('.pw').hide();
hideAllField();
$('.filter-date').change(function (e) {
    let v = $(this).val();
    if (v == 1) {
        $('.date-range').hide();
        $('.specific-date').show();
    } else if (v == 2) {
        $('.date-range').show();
        $('.specific-date').hide();
    } else {
        $('.specific-date').hide();
    }
});

function hideAllField() {
    $('.fieldIc').hide();
    $('.fieldPd').hide();
    $('.fieldPdb').hide();
    $('.fieldBs').hide();
    $('.fieldSpb').hide();
    $('.fieldMtau').hide();
    $('.fieldAb').hide();
    $('.fieldPsn').hide();
    $('.fieldschedule').hide();
    $('.fieldcs').hide();
    $('.fieldss').hide();
    $('.fieldsb').hide();
    $('.fieldalwb').hide();
    $('.fieldabi').hide();
    $('.fieldpar').hide();
    $('.fieldprl').hide();
    $('.fieldcarl').hide();
    $('.fieldea').hide();
    $('.fieldexpiringauth').hide();
    $('.fieldpr').hide();
    $('.patient-list').hide();
    $('.staff-list').hide();
}

$('.reportFilter').change(function (event) {
    let v = $(this).val();
    if (v == 1) {
        hideAllField();
        $('.fieldIc').show();
    } else if (v == 2) {
        hideAllField();
        $('.fieldPd').show();
    } else if (v == 3) {
        hideAllField();
        $('.fieldPdb').show();
    } else if (v == 4) {
        hideAllField();
        $('.fieldBs').show();
    } else if (v == 5) {
        hideAllField();
        $('.fieldSpb').show();
    } else if (v == 6) {
        hideAllField();
        $('.fieldMtau').show();
    } else if (v == 7) {
        hideAllField();
        $('.fieldAb').show();
    } else if (v == 8) {
        hideAllField();
        $('.fieldPsn').show();
    } else if (v == 9) {
        hideAllField();
        $('.fieldschedule').show();
    } else if (v == 10) {
        hideAllField();
        $('.fieldcs').show();
        $('.patient-list').show();
    } else if (v == 11) {
        hideAllField();
        $('.fieldss').show();
        $('.staff-list').show();
    } else if (v == 12) {
        hideAllField();
        $('.fieldsb').show();
    } else if (v == 13) {
        hideAllField();
        $('.fieldalwb').show();
    } else if (v == 14) {
        hideAllField();
        $('.fieldabi').show();
    } else if (v == 15) {
        hideAllField();
        $('.fieldpar').show();
    } else if (v == 16) {
        hideAllField();
        $('.fieldprl').show();
    } else if (v == 17) {
        hideAllField();
        $('.fieldcarl').show();
        $('.patient-list').show();
    } else if (v == 18) {
        hideAllField();
        $('.fieldea').show();
    } else if (v == 19) {
        hideAllField();
        $('.fieldexpiringauth').show();
    } else if (v == 20) {
        hideAllField();
        $('.fieldpr').show();
    } else {
        hideAllField();
    }
});


$('#exportWithField').click(function (event) {
    let checkButtonOne = document.getElementById('exportWithField');
    let checkOneContent = document.querySelector('.exportContent');
    if (checkButtonOne.checked == true) {
        $('.exportContent').show();
        $('.pw').hide();
        $("#exportWithPassword").prop("checked", false);
    } else {
        $('.exportContent').hide();
    }
});

$('#exportWithPassword').click(function (event) {
    let checkButtonTwo = document.getElementById('exportWithPassword');
    let checkTwoContent = document.querySelector('.pw');
    if (checkButtonTwo.checked == true) {
        $('.pw').show();
        $('.exportContent').hide();
        $("#exportWithField").prop("checked", false);
    } else {
        $('.pw').hide();
    }
});
