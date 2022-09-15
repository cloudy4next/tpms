jQuery(document).ready(function($) {
    // filter 1
    $('.filter2').hide();
    $('.batch1').hide();
    $('.claim1').hide();
    $('.payor1').hide();
    $('.client1').hide();
    $('.tt1').hide();
    $('.cms1').hide();
    $('.activity1').hide();
    $('.soc1').hide();
    $('.dateRange1').hide();
    $('.subDate1').hide();
    $('.submission1').hide();
    $('.claimTotal1').hide();
    $('.batch2').hide();
    $('.claim2').hide();
    $('.payor2').hide();
    $('.client2').hide();
    $('.tt2').hide();
    $('.cms2').hide();
    $('.activity2').hide();
    $('.soc2').hide();
    $('.dateRange2').hide();
    $('.subDate2').hide();
    $('.submission2').hide();
    $('.claimTotal2').hide();
    // warning div
    $('.filter1_warning').hide();
    $('.batch_warning').hide();
    $('.claim_warning').hide();
    $('.payor_warning').hide();
    $('.client_warning').hide();
    $('.tt_warning').hide();
    $('.cms_warning').hide();
    $('.activity_warning').hide();
    $('.soc_warning').hide();
    $('.dateRange_warning').hide();
    $('.subDate_warning').hide();
    $('.submission_warning').hide();
    $('.claimTotal_warning').hide();
    // claim details
    $('.claim_details').hide();
    // Filter-1 Activity
    $('.filter1 select').change(function(event) {
        var v = $(this).val();
        if (v == 1) {
            $('.filter2 select').val(0);
            $('.filter2').show();
            $('.batch1').show();
            $('.claim1').hide();
            $('.payor1').hide();
            $('.client1').hide();
            $('.tt1').hide();
            $('.cms1').hide();
            $('.activity1').hide();
            $('.soc1').hide();
            $('.dateRange1').hide();
            $('.subDate1').hide();
            $('.submission1').hide();
            $('.claimTotal1').hide();
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        } else if (v == 2) {
            $('.filter2 select').val(0);
            $('.filter2').show();
            $('.batch1').hide();
            $('.claim1').show();
            $('.payor1').hide();
            $('.client1').hide();
            $('.tt1').hide();
            $('.cms1').hide();
            $('.activity1').hide();
            $('.soc1').hide();
            $('.dateRange1').hide();
            $('.subDate1').hide();
            $('.submission1').hide();
            $('.claimTotal1').hide();
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        } else if (v == 3) {
            $('.filter2 select').val(0);
            $('.filter2').show();
            $('.batch1').hide();
            $('.claim1').hide();
            $('.payor1').show();
            $('.client1').hide();
            $('.tt1').hide();
            $('.cms1').hide();
            $('.activity1').hide();
            $('.soc1').hide();
            $('.dateRange1').hide();
            $('.subDate1').hide();
            $('.submission1').hide();
            $('.claimTotal1').hide();
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        } else if (v == 4) {
            $('.filter2 select').val(0);
            $('.filter2').show();
            $('.batch1').hide();
            $('.claim1').hide();
            $('.payor1').hide();
            $('.client1').show();
            $('.tt1').hide();
            $('.cms1').hide();
            $('.activity1').hide();
            $('.soc1').hide();
            $('.dateRange1').hide();
            $('.subDate1').hide();
            $('.submission1').hide();
            $('.claimTotal1').hide();
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        } else if (v == 5) {
            $('.filter2 select').val(0);
            $('.filter2').show();
            $('.batch1').hide();
            $('.claim1').hide();
            $('.payor1').hide();
            $('.client1').hide();
            $('.tt1').show();
            $('.cms1').hide();
            $('.activity1').hide();
            $('.soc1').hide();
            $('.dateRange1').hide();
            $('.subDate1').hide();
            $('.submission1').hide();
            $('.claimTotal1').hide();
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        } else if (v == 6) {
            $('.filter2 select').val(0);
            $('.filter2').show();
            $('.batch1').hide();
            $('.claim1').hide();
            $('.payor1').hide();
            $('.client1').hide();
            $('.tt1').hide();
            $('.cms1').show();
            $('.activity1').hide();
            $('.soc1').hide();
            $('.dateRange1').hide();
            $('.subDate1').hide();
            $('.submission1').hide();
            $('.claimTotal1').hide();
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        } else if (v == 7) {
            $('.filter2 select').val(0);
            $('.filter2').show();
            $('.batch1').hide();
            $('.claim1').hide();
            $('.payor1').hide();
            $('.client1').hide();
            $('.tt1').hide();
            $('.cms1').hide();
            $('.activity1').show();
            $('.soc1').hide();
            $('.dateRange1').hide();
            $('.subDate1').hide();
            $('.submission1').hide();
            $('.claimTotal1').hide();
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        } else if (v == 8) {
            $('.filter2 select').val(0);
            $('.filter2').show();
            $('.batch1').hide();
            $('.claim1').hide();
            $('.payor1').hide();
            $('.client1').hide();
            $('.tt1').hide();
            $('.cms1').hide();
            $('.activity1').hide();
            $('.soc1').show();
            $('.dateRange1').hide();
            $('.subDate1').hide();
            $('.submission1').hide();
            $('.claimTotal1').hide();
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        } else if (v == 9) {
            $('.filter2 select').val(0);
            $('.filter2').show();
            $('.batch1').hide();
            $('.claim1').hide();
            $('.payor1').hide();
            $('.client1').hide();
            $('.tt1').hide();
            $('.cms1').hide();
            $('.activity1').hide();
            $('.soc1').hide();
            $('.dateRange1').show();
            $('.subDate1').hide();
            $('.submission1').hide();
            $('.claimTotal1').hide();
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        } else if (v == 10) {
            $('.filter2 select').val(0);
            $('.filter2').show();
            $('.batch1').hide();
            $('.claim1').hide();
            $('.payor1').hide();
            $('.client1').hide();
            $('.tt1').hide();
            $('.cms1').hide();
            $('.activity1').hide();
            $('.soc1').hide();
            $('.dateRange1').hide();
            $('.subDate1').show();
            $('.submission1').hide();
            $('.claimTotal1').hide();
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        } else if (v == 11) {
            $('.filter2 select').val(0);
            $('.filter2').show();
            $('.batch1').hide();
            $('.claim1').hide();
            $('.payor1').hide();
            $('.client1').hide();
            $('.tt1').hide();
            $('.cms1').hide();
            $('.activity1').hide();
            $('.soc1').hide();
            $('.dateRange1').hide();
            $('.subDate1').hide();
            $('.submission1').show();
            $('.claimTotal1').hide();
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        } else if (v == 12) {
            $('.filter2 select').val(0);
            $('.filter2').show();
            $('.batch1').hide();
            $('.claim1').hide();
            $('.payor1').hide();
            $('.client1').hide();
            $('.tt1').hide();
            $('.cms1').hide();
            $('.activity1').hide();
            $('.soc1').hide();
            $('.dateRange1').hide();
            $('.subDate1').hide();
            $('.submission1').hide();
            $('.claimTotal1').show();
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        } else {
            $('.filter2').hide();
            $('.batch1').hide();
            $('.claim1').hide();
            $('.payor1').hide();
            $('.client1').hide();
            $('.tt1').hide();
            $('.cms1').hide();
            $('.activity1').hide();
            $('.soc1').hide();
            $('.dateRange1').hide();
            $('.subDate1').hide();
            $('.submission1').hide();
            $('.claimTotal1').hide();
        }
    });
    // Claim Button
    $('.claim_btn').click(function(event) {
        var filterValue = $('.filter1 select').val();
        if (filterValue == 0 || filterValue == "") {
            $('.filter1_warning').show();
            $('.claim_details').hide();
            $('.filter_btn').addClass("align-self-center");
        }
        // Batch Select
        else if (filterValue == 1) {
            $('.filter1_warning').hide();
            $('.filter_btn').removeClass("align-self-center");
            var batchValue = $('.batch1 select').val();
            if (batchValue == 0 || batchValue == "") {
                $('.claim_details').hide();
                $('.batch_warning').show();
                $('.filter_btn').addClass("align-self-center");
            } else {
                $('.claim_details').show();
                $('.batch_warning').hide();
                $('.filter_btn').removeClass("align-self-center");
            }
        }
        // Claim Select
        else if (filterValue == 2) {
            $('.filter1_warning').hide();
            $('.filter_btn').removeClass("align-self-center");
            var claimValue = $('.claim1 input').val();
            if (claimValue == 0 || claimValue == "") {
                $('.claim_details').hide();
                $('.claim_warning').show();
                $('.filter_btn').addClass("align-self-center");
            } else {
                $('.claim_details').show();
                $('.claim_warning').hide();
                $('.filter_btn').removeClass("align-self-center");
            }
        }
        // Payor Select
        else if (filterValue == 3) {
            $('.filter1_warning').hide();
            $('.filter_btn').removeClass("align-self-center");
            var payorValue = $('.payor1 select').val();
            if (payorValue == 0 || payorValue == "") {
                $('.claim_details').hide();
                $('.payor_warning').show();
                $('.filter_btn').addClass("align-self-center");
            } else {
                $('.claim_details').show();
                $('.payor_warning').hide();
                $('.filter_btn').removeClass("align-self-center");
            }
        }
        // Client Select
        else if (filterValue == 4) {
            $('.filter1_warning').hide();
            $('.filter_btn').removeClass("align-self-center");
            var clientValue = $('.client1 select').val();
            if (clientValue == 0 || clientValue == "") {
                $('.claim_details').hide();
                $('.client_warning').show();
                $('.filter_btn').addClass("align-self-center");
            } else {
                $('.claim_details').show();
                $('.client_warning').hide();
                $('.filter_btn').removeClass("align-self-center");
            }
        }
        // Therapist Select
        else if (filterValue == 5) {
            $('.filter1_warning').hide();
            $('.filter_btn').removeClass("align-self-center");
            var ttValue = $('.tt1 select').val();
            if (ttValue == 0 || ttValue == "") {
                $('.claim_details').hide();
                $('.tt_warning').show();
                $('.filter_btn').addClass("align-self-center");
            } else {
                $('.claim_details').show();
                $('.tt_warning').hide();
                $('.filter_btn').removeClass("align-self-center");
            }
        }
        // CMS Select
        else if (filterValue == 6) {
            $('.filter1_warning').hide();
            $('.filter_btn').removeClass("align-self-center");
            var cmsValue = $('.cms1 select').val();
            if (cmsValue == 0 || cmsValue == "") {
                $('.claim_details').hide();
                $('.cms_warning').show();
                $('.filter_btn').addClass("align-self-center");
            } else {
                $('.claim_details').show();
                $('.cms_warning').hide();
                $('.filter_btn').removeClass("align-self-center");
            }
        }
        // Activity Select
        else if (filterValue == 7) {
            $('.filter1_warning').hide();
            $('.filter_btn').removeClass("align-self-center");
            var activityValue = $('.activity1 select').val();
            if (activityValue == 0 || activityValue == "") {
                $('.claim_details').hide();
                $('.activity_warning').show();
                $('.filter_btn').addClass("align-self-center");
            } else {
                $('.claim_details').show();
                $('.activity_warning').hide();
                $('.filter_btn').removeClass("align-self-center");
            }
        }
        // SOC Select
        else if (filterValue == 8) {
            $('.filter1_warning').hide();
            $('.filter_btn').removeClass("align-self-center");
            var socValue = $('.soc1 select').val();
            if (socValue == 0 || socValue == "") {
                $('.claim_details').hide();
                $('.soc_warning').show();
                $('.filter_btn').addClass("align-self-center");
            } else {
                $('.claim_details').show();
                $('.soc_warning').hide();
                $('.filter_btn').removeClass("align-self-center");
            }
        }
        // DateRange Select
        else if (filterValue == 9) {
            $('.filter1_warning').hide();
            $('.filter_btn').removeClass("align-self-center");
            var dateRangeValue = $('.dateRange1 input').val();
            if (dateRangeValue == 0 || dateRangeValue == "") {
                $('.claim_details').hide();
                $('.dateRange_warning').show();
                $('.filter_btn').addClass("align-self-center");
            } else {
                $('.claim_details').show();
                $('.dateRange_warning').hide();
                $('.filter_btn').removeClass("align-self-center");
            }
        }
        // SubDate Select
        else if (filterValue == 10) {
            $('.filter1_warning').hide();
            $('.filter_btn').removeClass("align-self-center");
            var subDateValue = $('.subDate1 input').val();
            if (subDateValue == 0 || subDateValue == "") {
                $('.claim_details').hide();
                $('.subDate_warning').show();
                $('.filter_btn').addClass("align-self-center");
            } else {
                $('.claim_details').show();
                $('.subDate_warning').hide();
                $('.filter_btn').removeClass("align-self-center");
            }
        }
        // Submission Select
        else if (filterValue == 11) {
            $('.filter1_warning').hide();
            $('.filter_btn').removeClass("align-self-center");
            var submissionValue = $('.submission1 select').val();
            if (submissionValue == 0 || submissionValue == "") {
                $('.claim_details').hide();
                $('.submission_warning').show();
                $('.filter_btn').addClass("align-self-center");
            } else {
                $('.claim_details').show();
                $('.submission_warning').hide();
                $('.filter_btn').removeClass("align-self-center");
            }
        }
        // ClaimTotal Select
        else if (filterValue == 12) {
            $('.filter1_warning').hide();
            $('.filter_btn').removeClass("align-self-center");
            var claimTotalValue = $('.claimTotal1 input').val();
            if (claimTotalValue == 0 || claimTotalValue == "") {
                $('.claim_details').hide();
                $('.claimTotal_warning').show();
                $('.filter_btn').addClass("align-self-center");
            } else {
                $('.claim_details').show();
                $('.claimTotal_warning').hide();
                $('.filter_btn').removeClass("align-self-center");
            }
        } else {
            $('.filter1_warning').hide();
            $('.claim_details').hide();
            $('.filter_btn').removeClass("align-self-center");
        }
    });
    // Filter-2 Activity
    $('.filter2 select').change(function(event) {
        var value = $(this).val();
        if (value == 1) {
            $('.batch2').show();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        } else if (value == 2) {
            $('.batch2').hide();
            $('.claim2').show();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        } else if (value == 3) {
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').show();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        } else if (value == 4) {
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').show();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        } else if (value == 5) {
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').show();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        } else if (value == 6) {
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').show();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        } else if (value == 7) {
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').show();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        } else if (value == 8) {
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').show();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        } else if (value == 9) {
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').show();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        } else if (value == 10) {
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').show();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        } else if (value == 11) {
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').show();
            $('.claimTotal2').hide();
        } else if (value == 12) {
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').show();
        } else {
            $('.batch2').hide();
            $('.claim2').hide();
            $('.payor2').hide();
            $('.client2').hide();
            $('.tt2').hide();
            $('.cms2').hide();
            $('.activity2').hide();
            $('.soc2').hide();
            $('.dateRange2').hide();
            $('.subDate2').hide();
            $('.submission2').hide();
            $('.claimTotal2').hide();
        }
    });
});
