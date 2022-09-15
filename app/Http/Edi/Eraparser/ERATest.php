<?php

include "ERAParser.php";

//Creating the parsing object
$obj = new ERAParser();
//Calling the Main Parsing Method. Pass the valid file path here.
$obj->ParseERAFile('C:\Users\azizullah\Downloads\DrAutomatePayments\chargeFile.txt');

// $obj->ERAData contains the list of EraHeader Object.
// Era Header contains check information, payer information, payee inforamtion, provider amount
// and a list of ERAVisitPayment.

//list of ERAVisitPayment contains the payment information of all visits.
foreach ($obj->ERAData as $checkData) {

    echo "************ CHECK INFORMATION ************ " . "\n";
    echo "Check Date " . $checkData->__get('CheckDate') . "\n";
    echo "Check # " . $checkData->__get('CheckNumber') . "\n";
    echo "Check Amount " . $checkData->__get('CheckAmount') . "\n";


    foreach ($checkData->ERAVisitPayments as $visitData) {

        echo "************ VISIT INFORMATION ************ " . "\n";

        echo "Claim. Cntrl # " . $visitData->__get('PatientControlNumber') . "\n";
        echo "Payer Cntrl # " . $visitData->__get('PayerControlNumber') . "\n";

        echo "Submitted Amount " . $visitData->__get('SubmittedAmt') . "\n";
        echo "Paid Amount " . $visitData->__get('PaidAmt') . "\n";

        echo "Patient Responsibility " . $visitData->__get('PatResponsibilityAmt') . "\n";

        echo "Copay Amount " . $visitData->__get('CopayAmt') . "\n";
        echo "Deductible Amount " . $visitData->__get('DeductableAmt') . "\n";
        echo "CoIns. Amount " . $visitData->__get('CoInsuranceAmt') . "\n";

        foreach ($visitData->ERAChargePayments as $ChargeData) {

            echo "	************ CHARGE INFORMATION ************ " . "\n";

            echo "Service line #    " . $ChargeData->__get('ChargeControlNumber') . "\n";
            echo "Date of Service   " . $ChargeData->__get('ServiceDateFrom') . "\n";

            echo "CPT/HCPCS/Clde  " . $ChargeData->__get('CPTCode') . "\n";
            echo "Submitted Amount  " . $ChargeData->__get('SubmittedAmt') . "\n";
            echo "Paid Amount " . $ChargeData->__get('PaidAmt') . "\n";

            echo "Copay Amount " . $ChargeData->__get('CopayAmt') . "\n";
            echo "Deductible Amount " . $ChargeData->__get('DeductableAmt') . "\n";
            echo "CoIns. Amount " . $ChargeData->__get('CoInsuranceAmt') . "\n";


            echo "Adjustment Code 1        " . $ChargeData->__get('OtherAdjustmentCode1') . "\n";
            echo "Adjustment Amount 1       " . $ChargeData->__get('OtherAdjustmentAmt1') . "\n";


            echo "Adjustment Code 2         " . $ChargeData->__get('OtherAdjustmentCode2') . "\n";
            echo "Adjustment Amount 2       " . $ChargeData->__get('OtherAdjustmentAmt2') . "\n";


            echo "Remark Code 1      " . $ChargeData->__get('RemarkCode1') . "\n";
            echo "Remark Code 2      " . $ChargeData->__get('RemarkCode2') . "\n";


        }
    }
}
